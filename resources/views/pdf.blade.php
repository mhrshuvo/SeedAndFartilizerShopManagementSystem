{{-- {{$order}} --}}
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Ord-{{ $order->tracking_id }} </title>
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;" />
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

    body {
        margin: 0;
        padding: 0;
        background: #ffffff;
    }

    div,
    p,
    a,
    li,
    td {
        -webkit-text-size-adjust: none;
    }

    body {
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
    }

    html {
        width: 100%;
    }

    p {
        padding: 0 !important;
        margin-top: 0 !important;
        margin-right: 0 !important;
        margin-bottom: 0 !important;
        margin-left: 0 !important;
    }


    @media only screen and (max-width: 600px) {
        body {
            width: auto !important;
        }

        table[class=fullTable] {
            width: 96% !important;
            clear: both;
        }

        table[class=fullPadding] {
            width: 85% !important;
            clear: both;
        }

        table[class=col] {
            width: 45% !important;
        }

        .erase {
            display: none;
        }
    }

    @media only screen and (max-width: 420px) {
        table[class=fullTable] {
            width: 100% !important;
            clear: both;
        }

        table[class=fullPadding] {
            width: 85% !important;
            clear: both;
        }

        table[class=col] {
            width: 100% !important;
            clear: both;
        }

        table[class=col] td {
            text-align: left !important;
        }

        .erase {
            display: none;
            font-size: 0;
            max-height: 0;
            line-height: 0;
            padding: 0;
        }

    }
</style>

<body onclick="window.print()">


    <!-- Header -->

    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#fff">
        <tr>
            <td height="20"></td>
        </tr>
        <tr>
            <td>
                <table width="1400" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
                    bgcolor="#ffffff" style="border-radius: 10px 10px 0 0;">
                    <tr class="hiddenMobile">
                        <td height="40"></td>
                    </tr>
                    <tr class="visibleMobile">
                        <td height="30"></td>
                    </tr>

                    <tr>
                        <td>
                            <table width="1380" border="0" cellpadding="0" cellspacing="0" align="center"
                                class="fullPadding">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="0" cellspacing="0" align="left"
                                                class="col">
                                                <tbody>
                                                    <tr>
                                                        {{-- <td align="left"> <img
                                                                src="{{ asset('asset/image/ki-porbo-logo_Black_Final.png') }}"
                                                                width="180" height="80" alt="logo"
                                                                border="0" /></td> --}}
                                                    </tr>
                                                    <tr class="hiddenMobile">
                                                        <td height="40"></td>
                                                    </tr>
                                                    <tr class="visibleMobile">
                                                        <td height="20"></td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 22px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 28px; vertical-align: top; text-align: left;">
                                                            Hello, <strong>{{ $order->user->name }}</strong>.
                                                            <br> Thank you for shopping from our store and for your
                                                            order.
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table width="220" border="0" cellpadding="0" cellspacing="0"
                                                align="right" class="col">
                                                <tbody>
                                                    <tr class="visibleMobile">
                                                        <td height="20"></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="5"></td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 21px; color: #ff0000; letter-spacing: -1px; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top; text-align: right;">
                                                            Invoice
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <tr class="hiddenMobile">
                                                        <td height="40"></td>
                                                    </tr>
                                                    <tr class="visibleMobile">
                                                        <td height="20"></td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 22px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 32px; vertical-align: top; text-align: right; ">
                                                            #{{ $order->tracking_id }}<br />

                                                            <small> {{ $order->created_at->format('d-M-Y') }}</small>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- /Header -->
    <!-- Order Details -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
        bgcolor="#fff">
        <tbody>
            <tr>
                <td>
                    <table width="1400" border="0" cellpadding="0" cellspacing="0" align="center"
                        class="fullTable" bgcolor="#ffffff">
                        <tbody>
                            <tr>
                            <tr class="hiddenMobile">
                                <td height="60"></td>
                            </tr>
                            <tr class="visibleMobile">
                                <td height="40"></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="1380" border="0" cellpadding="0" cellspacing="0" align="center"
                                        class="fullPadding">
                                        <tbody>
                                            <tr>
                                                <th style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                    width="52%" align="left">
                                                    Item
                                                </th>
                                                <th style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"
                                                    align="left">
                                                    sku
                                                </th>
                                                <th style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"
                                                    align="left">
                                                    Size
                                                </th>
                                                {{-- <th style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"
                                                    align="left">
                                                    Color
                                                </th> --}}
                                                <th style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"
                                                    align="center">
                                                    Quantity
                                                </th>
                                                <th style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #1e2b33; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"
                                                    align="right">
                                                    Subtotal
                                                </th>
                                            </tr>
                                            <tr>
                                                <td height="1" style="background: #bebebe;" colspan="6"></td>
                                            </tr>
                                            <tr>
                                                <td height="10" colspan="6"></td>
                                            </tr>

                                            @foreach ($order->order_products as $product)
                                                <tr>
                                                    <td
                                                        style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                        {{ $product->product_name }}</td>
                                                    <td <td
                                                        style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;"
                                                        class="article">
                                                        <small>{{ $product->product->sku }}</small>
                                                    </td>
                                                    <td
                                                        style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                        {{ $product->size }}</td>
                                                    {{-- <td
                                                        style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                        {{ $product->color }}</td> --}}
                                                    <td style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;"
                                                        align="center">{{ $product->qty }}</td>
                                                    <td style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #1e2b33;  line-height: 18px;  vertical-align: top; padding:10px 0;"
                                                        align="right">&#2547;{{ $product->price }}</td>
                                                </tr>
                                                <tr>
                                                    <td height="1" colspan="6"
                                                        style="border-bottom:1px solid #e4e4e4"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="20"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- /Order Details -->
    <!-- Total -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
        bgcolor="#fff">
        <tbody>
            <tr>
                <td>
                    <table width="1400" border="0" cellpadding="0" cellspacing="0" align="center"
                        class="fullTable" bgcolor="#ffffff">
                        <tbody>
                            <tr>
                                <td>

                                    <!-- Table Total -->
                                    <table width="1380" border="0" cellpadding="0" cellspacing="0"
                                        align="center" class="fullPadding">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 32px; vertical-align: top; text-align:right; width:85%">
                                                    Subtotal
                                                </td>
                                                <td style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 32px; vertical-align: top; text-align:right; white-space:nowrap;"
                                                    width="80">
                                                    &#2547; {{ $order->sub_total }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 32px; vertical-align: top; text-align:right;  width:85%">
                                                    Shipping &amp; Handling
                                                </td>
                                                <td
                                                    style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 32px; vertical-align: top; text-align:right; ">
                                                    &#2547; {{ $order->delivery_charge }}
                                                </td>
                                            </tr +>
                                            @if ($order->coupon_code)
                                                <td
                                                    style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #3db73f; line-height: 32px; vertical-align: top; text-align:right;  width:85%">
                                                    <strong>Coupon Doiscount</strong>
                                                </td>
                                                <td
                                                    style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #3db73f; line-height: 32px; vertical-align: top; text-align:right; ">
                                                    <strong>&#2547; {{ $order->coupon_discount }}</strong>
                                                </td>
                                            @endif
                                            <tr>
                                                <td
                                                    style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 32px; vertical-align: top; text-align:right;  width:85%">
                                                    <strong>Grand Total</strong>
                                                </td>
                                                <td
                                                    style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 32px; vertical-align: top; text-align:right; ">
                                                    <strong>&#2547; {{ $order->total_price }}</strong>
                                                </td>
                                            </tr>


                                            {{-- <tr>
                                            <td
                                                style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #b0b0b0; line-height: 32px; vertical-align: top; text-align:right; ">
                                                <small>TAX</small></td>
                                            <td
                                                style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #b0b0b0; line-height: 32px; vertical-align: top; text-align:right; ">
                                                <small>&#2547;72.40</small>
                                            </td>
                                        </tr> --}}
                                        </tbody>
                                    </table>
                                    <!-- /Table Total -->

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- /Total -->
    <!-- Information -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
        bgcolor="#fff">
        <tbody>
            <tr>
                <td>
                    <table width="1400" border="0" cellpadding="0" cellspacing="0" align="center"
                        class="fullTable" bgcolor="#ffffff">
                        <tbody>
                            <tr>
                            <tr class="hiddenMobile">
                                <td height="60"></td>
                            </tr>
                            <tr class="visibleMobile">
                                <td height="40"></td>
                            </tr>
                            {{-- <tr>
                            <td>
                                <table width="1380" border="0" cellpadding="0" cellspacing="0" align="center"
                                    class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table width="220" border="0" cellpadding="0" cellspacing="0"
                                                    align="left" class="col">

                                                    <tbody>
                                                        <tr>
                                                            <td
                                                                style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                                                <strong>BILLING INFORMATION</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                                                Philip Brooks<br> Public Wales, Somewhere<br> New York
                                                                NY<br> 4468, United States<br> T: 202-555-0133
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>


                                                <table width="220" border="0" cellpadding="0" cellspacing="0"
                                                    align="right" class="col">
                                                    <tbody>
                                                        <tr class="visibleMobile">
                                                            <td height="20"></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                                                <strong>PAYMENT METHOD</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                                                Credit Card<br> Credit Card Type: Visa<br> Worldpay
                                                                Transaction ID: <a href="#"
                                                                    style="color: #ff0000; text-decoration:underline;">4185939336</a><br>
                                                                <a href="#" style="color:#b0b0b0;">Right of
                                                                    Withdrawal</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr> --}}
                            <tr>
                                <td>
                                    <table width="1380" border="0" cellpadding="0" cellspacing="0"
                                        align="center" class="fullPadding">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        align="left" class="col">
                                                        <tbody>
                                                            <tr class="hiddenMobile">
                                                                <td height="35"></td>
                                                            </tr>
                                                            <tr class="visibleMobile">
                                                                <td height="20"></td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                                                    <strong>SHIPPING INFORMATION</strong>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="100%" height="10"></td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 32px; vertical-align: top; ">
                                                                    <strong>Name :</strong> {{ $order->user->name }}
                                                                    <br>
                                                                    <strong>Phone :</strong> {{ $order->contact_no }}
                                                                    <br>
                                                                    <strong>Division
                                                                        : </strong>{{ $order->division->name }}
                                                                    <br>
                                                                    <strong>District
                                                                        : </strong>{{ $order->district->name }}
                                                                    <br>
                                                                    <strong>Address :</strong> {{ $order->address }}
                                                                    <br>
                                                                    <strong>contact :</strong> {{ $order->contact_no }}
                                                                    <br>
                                                                    @if ($order->note)
                                                                        Note : {{ $order->note }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>


                                                    {{-- <table width="220" border="0" cellpadding="0" cellspacing="0"
                                                    align="right" class="col">
                                                    <tbody>
                                                        <tr class="hiddenMobile">
                                                            <td height="35"></td>
                                                        </tr>
                                                        <tr class="visibleMobile">
                                                            <td height="20"></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                                                <strong>SHIPPING METHOD</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 22px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                                                UPS: U.S. Shipping Services
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr class="hiddenMobile">
                                <td height="60"></td>
                            </tr>
                            <tr class="visibleMobile">
                                <td height="30"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- /Information -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
        bgcolor="#fff">

        <tr>
            <td>
                <table width="1400" border="0" cellpadding="0" cellspacing="0" align="center"
                    class="fullTable" bgcolor="#ffffff" style="border-radius: 0 0 10px 10px;">
                    <tr>
                        <td>
                            <table width="1380" border="0" cellpadding="0" cellspacing="0" align="center"
                                class="fullPadding">
                                <tbody>
                                    <tr>
                                        <td
                                            style="font-size: 22px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                                            Have a nice day.
                                        </td>
                                        <td
                                            style="font-size: 22px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr class="spacer">
                        <td height="50"></td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td height="20"></td>
        </tr>
    </table>
</body>
