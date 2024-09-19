<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\User\RegisterRequest;
use App\Http\Resources\v1\User\AuthResource;
use App\Jobs\CreateCouponsJob;
use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use App\Models\v1\Coupon;
use App\Models\v1\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('throttle:1,1')->only(['requestOtp']);
    }
    public function register(RegisterRequest $request)
    {
        $input = $request->validated();
        if ($request->hasFile('avatar')) {
            $input['avatar'] = $request->file('avatar')->store('images/user', 'public');
        }

        if ($request->has('referral_code')) {

            $referral = Referral::where('referral_code', $request->referral_code)->first();

            if ($referral) {
                $input['onboard_by'] = $referral->referrer;
                $referral->increment('used');
                $ref = $referral->referrer;
            }
        }
        $input['otp'] = $request->otp_no;

        $user = User::create($input);

        Auth::login($user);
        if (!config('app.debug')) {
            dispatch(new SendWelcomeEmail($request->email));
        }
        if ($request->has('referral_code')) {
            $referral = Referral::where('referral_code', $request->referral_code)->first();
            if ($referral) {
                $ref = $referral->referrer;
                dispatch(new CreateCouponsJob($ref, $user->id));
            }
        }
        return response()->json(
            [
                'message' => 'user registration successful',
                'id' => $user->id,
                'name' => $user->name,
                'token' => $user->createToken('customer')->plainTextToken
            ],
            201
        );
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_no';

        if (Auth::attempt([$fieldType => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            if ($user->role == 1 && Route::currentRouteName() == 'customer_login') {
                return AuthResource::make($user);
            } else {
                return response()->json(
                    ['error' => 'You do not have access to this portal'],
                    401
                );
            }
        } else {
            return response()->json(['error' => 'Email or password incorrect'], 401);
        }
    }

    public function logout()
    {

        auth()->user()->currentAccessToken()->delete();
        return [
            'message' => 'user logged out successful'
        ];
    }

    public function myReferralCode()
    {
        $user = auth()->user();
        $referral = Referral::where('referrer', $user->id)->first();
        if ($referral) {
            return response()->json(
                [
                    'message' => 'referral code found',
                    'referral_code' => $referral->referral_code
                ],
                200
            );
        } else {

            $referral_code = strtoupper('KP') . '-' . rand(1000, 9999);
            $referral = Referral::create([
                'referrer' => $user->id,
                'referral_code' => $referral_code
            ]);
            return response()->json(
                [
                    'message' => 'referral code generated',
                    'referral_code' => $referral->referral_code
                ],
                200
            );
        }
    }

    public function checkEmailAndPhoneNoExistOrNot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|unique:users,phone_no'
        ]);
        if ($validator->fails()) {
            return
                [
                    'message' => 'user already exist'
                ];
        } else {
            return ['message' => 'user not found'];
        }
    }

    public function requestOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|exists:users,phone_no'

        ]);
        if ($validator->fails()) {
            $otp = rand(100000, 999999);
            $url = 'http://bulksmsbd.net/api/smsapi?api_key=r8YHEDHLddKtxsLlziw1&type=text&number=' . $request->phone_no . '&senderid=8809617615316&message=' . 'Your S&f shop login OTP is ' . $otp . ' Please do not share this with anyone. Thank you.';
            if (!config('app.debug')) {
                $response =  Http::get($url);
            } else {
                $otp = 123456;
            }

            $user = User::create([
                'phone_no' => $request->phone_no,
                'otp' => $otp,
                'name' => 'customer',
                'email' =>  $request->phone_no . '@kpc.com',
                // 'email_verified_at' => now(),
                'password' => bcrypt($otp),


            ]);
            return response()->json(
                [
                    'message' => 'new user',
                    'otp_status' => 'otp sent to your phone no'
                ],
                200
            );
        } else {
            $otp = rand(100000, 999999);
            $url = 'http://bulksmsbd.net/api/smsapi?api_key=r8YHEDHLddKtxsLlziw1&type=text&number=' . $request->phone_no . '&senderid=8809617615316&message=' . 'Your S&f shop login OTP is ' . $otp . ' Please do not share this with anyone. Thank you.';
            if (!config('app.debug')) {
                $response =  Http::get($url);
                //dd($response->status());
                if ($response->status() == 202 || $response->status() == 200) {
                    $user = User::where('phone_no', $request->phone_no)->update(['otp' => $otp, "password" => bcrypt($otp)]);
                    return response()->json(
                        [
                            'message' => 'old user',
                            'otp_status' => 'otp sent to your phone no'
                        ],
                        200
                    );
                } else {
                    return response()->json(
                        [
                            'message' => 'old user',
                            'otp_status' => 'otp can not be sent to your phone no',
                        ],
                        400
                    );
                }
            } else {
                $otp = 123456;
            }

            return response()->json(
                [
                    'message' => 'otp sent to your phone no',
                ],
                200
            );
        }
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|exists:users,phone_no',
            'otp' => 'required'
        ]);
        if ($validator->fails()) {
            return
                [
                    'message' => 'user not found'
                ];
        } else {
            $user = User::where('phone_no', $request->phone_no)->first();
            if ($user && $user->email_verified_at != null && $user->otp == $request->otp) {
                return response()->json(
                    [
                        'message' => 'old user',
                        'otp_status' => 'otp verified successfully'
                    ],
                    200
                );
            } elseif ($user && $user->email_verified_at == null && $user->otp == $request->otp) {
                return response()->json(
                    [
                        'message' => 'new user',
                        'otp_status' => 'otp verified successfully'

                    ],
                    200
                );
            }
        }
    }

    public function loginWithOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|exists:users,phone_no',
            'otp' => 'required'
        ]);
        if ($validator->fails()) {
            return
                [
                    'message' => 'user not found'
                ];
        } else {
            if ($request->has('referral_code')) {

                $referral = Referral::where('referral_code', $request->referral_code)->first();

                if ($referral) {
                    $onboard_by = $referral->referrer;
                    $referral->increment('used');
                    $ref = $referral->referrer;
                }

                $user = User::where('phone_no', $request->phone_no)->where('otp', $request->otp)->first();
                $user->update([
                    'onboard_by' => $onboard_by,
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                if ($referral) {
                    dispatch(new CreateCouponsJob($ref, $user->id));
                }
            }


            $user = User::where('phone_no', $request->phone_no)->where('otp', $request->otp)->first();


            $user->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->email ?? $user->email,
                'email_verified_at' => now(),
            ]);
            $credentials = $request->only('phone_no', 'otp');
            if (Auth::attempt(['phone_no' => $credentials['phone_no'], 'password' => $credentials['otp']])) {
                $user = Auth::user();
                if ($user->role == 1 && Route::currentRouteName() == 'customer_login_otp') {
                    return AuthResource::make($user);
                } else {
                    return response()->json(
                        ['error' => 'You do not have access to this portal'],
                        401
                    );
                }
            } else {
                return response()->json(['error' => 'Email or password incorrect'], 401);
            }
        }
    }
}
