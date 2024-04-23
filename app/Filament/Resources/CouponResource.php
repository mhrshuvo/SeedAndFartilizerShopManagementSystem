<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\v1\Coupon;
use Dompdf\FrameDecorator\Text;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                    ->options([
                        'flat' => 'Flat',
                        'percent' => 'Percent',
                        'referral' => 'Referral',
                        'custom' => 'Custom',
                    ])
                    ->default('flat')
                    ->native(false)
                    ->required()
                    ->reactive(),
                TextInput::make('coupon_code')
                    ->required()
                    ->unique(ignorable: fn ($record) => $record),
                TextInput::make('min_spend')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                TextInput::make('discount_limit')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                DateTimePicker::make('expired_at')
                    ->required(),
                TextInput::make('discount_percent')
                    ->hidden(function (callable $get) {
                        if ($get('type') == 'percent') {
                            return false;
                        } else {
                            return true;
                        }
                    })
                    ->numeric()
                    ->minValue(1),
                TextInput::make('discount')
                    ->hidden(function (callable $get) {
                        if ($get('type') == 'flat' || $get('type') == 'referral' || $get('type') == 'custom') {
                            return false;
                        } else {
                            return true;
                        }
                    })
                    ->numeric()
                    ->minValue(1),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('active')
                    ->native(false)
                    ->required(),
                Select::make('owned_by')
                    ->label('User')
                    ->options(

                        \App\Models\User::all()->pluck('name', 'id'),
                    )
                    ->default(null),

                MarkdownEditor::make('t_and_c'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('coupon_code'),
                TextColumn::make('type'),
                TextColumn::make('used'),
                TextColumn::make('expired_at')
                    ->dateTime(),
                TextColumn::make('status'),
                TextColumn::make('used')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
