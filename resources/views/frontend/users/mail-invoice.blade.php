<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ sprintf('%06d', $order->id) }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: montserrat, verdana, sans-serif;
        }
        img {
            height: 60px;
            padding: 1px;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: montserrat, verdana, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 20px;
            text-align: left;
            font-size: 12px;
            font-family: montserrat, verdana, sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        .heading {
            font-size: 16px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: montserrat, verdana, sans-serif;
        }
        .small-heading {
            font-size: 12px;
            font-family: montserrat, verdana, sans-serif;
        }
        .total-heading {
            font-size: 12px;
            font-weight: 700;
            font-family: montserrat, verdana, sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }
        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: montserrat, verdana, sans-serif;
            font-size: 12px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
        .bg-secondary {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h2>Thank You for Your Order</h2>
        <p>
            We sincerely appreciate your recent purchase from {{ $appSetting->company_name }}.
            <br />
            Below, you'll find the details of your order and the items you've selected.
        </p>
    </div>
    
    <table class="order-details">
        <thead>
            <tr>
                <th width="25%" style="border-right: none;">
                    <img src="{{ asset($appSetting->logotipo) }}" style="height: 90px;" alt="logo"/>
                </th>
                <th width="25%"  class="company-data" style="border-left: none; border-right: none;">
                    {{ $appSetting->company_name }}<br />
                    <span>
                        {{ $appSetting->address1 }}<br />
                        {{ $appSetting->address2 }}<br />
                        Zip code: {{ $appSetting->zip_code }} - {{ $appSetting->country }}<br />
                        {{ $appSetting->phone1 }} - {{ $appSetting->contact_email }}<br />
                        {{ $appSetting->website_url }}
                    </span>
                </th>
                <th width="50%" colspan="2" class="text-end company-data" style="border-left: none;">
                    <span>Invoice#: {{ sprintf('%06d', $order->id) }}</span> <br />
                    <span>Date: {{ date($appSetting->format_date) }}</span> <br />
                    <span>{{ $appSetting->tax_code_name1 }} - {{ $appSetting->tax_code_value1 }}</span><br />
                    <span>{{ $appSetting->tax_code_name2 }} - {{ $appSetting->tax_code_value2 }}</span><br />
                </th>
            </tr>
            <tr class="bg-blue">
                <th class="no-border text-start bg-blue heading" colspan="2">Order Details</th>
                <th class="no-border text-start bg-blue heading" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order No.:</td>
                <td>{{ sprintf('%06d', $order->id) }}</td>

                <td>Name:</td>
                <td>{{ $order->fullname }}</td>
            </tr>
            <tr>
                <td>Tracking No.:</td>
                <td>{{ $order->tracking_no }}</td>

                <td>E-mail:</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ $order->created_at->format($appSetting->format_date .' \a\t ' . $appSetting->format_hour) }}</td>

                <td>Phone:</td>
                <td>{{ $order->phone }}</td>

            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>{{ $order->payment_mode }}</td>

                <td>Address:</td>
                <td>{{ $order->address }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td class="text-uppercase text-success">{{ $order->status_message }}</td>

                <td>Zip code:</td>
                <td>{{ $order->pincode }}</td>
            </tr>
        </tbody>
    </table>
    <br />
    <table>
        <thead>
            <tr>
                <th class="no-border text-start bg-blue heading" colspan="6">
                    Order Items
                </th>
            </tr>
            <tr class="bg-secondary">
                <th  scope="col" class="text-center">Product ID</th>
                <th  scope="col">Product</th>
                <th  scope="col">Price</th>
                <th  scope="col" class="text-center">Quant</th>
                <th  scope="col" class="text-center">Unit</th>
                <th  scope="col">Total</th></tr>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
                $subtotalPrice = 0;
            @endphp
            @foreach($order->orderItems as $orderItem)
                <tr>
                    <td width="12%"  class="text-center" scope="row">{{ sprintf('%06d', $orderItem->id) }}</td>
                    <td>
                        {{ $orderItem->product->name }}
                        @if($orderItem->productColor)
                            @if($orderItem->productColor->color)
                                - Color: {{ $orderItem->productColor->color->name  }}
                            @endif
                        @endif
                    </td>
                    <td width="10%">{{ $appSetting->currency_type }} {{ $settings->formatNumber($orderItem->price, 2) }}</td>
                    <td width="10%" class="text-center">{{ $settings->formatNumber($orderItem->quantity, 4) }}</td>
                    <td width="5%" class="text-center">{{ $orderItem->quantity_unit }}</td>
                    <td width="10%" class="fw-bold">{{ $appSetting->currency_type }} {{ $settings->formatNumber($orderItem->quantity * $orderItem->price, 2) }}</td>
                    @php
                        $subtotalPrice += $orderItem->quantity * $orderItem->price
                    @endphp
                </tr>
            @endforeach
        </table>
    <br />
    <table>
        <thead>
            <tr class="bg-secondary">
                <th colspan="5">Payment details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="85%">Subtotal:</td>
                <td width="15%" class="fw-bold">{{ $appSetting->currency_type }} {{ $settings->formatNumber($subtotalPrice, 2) }}</td>
            </tr>
            <tr>
                <td width="85%">{{ $appSetting->tax_code_name3 }} ({{ $settings->formatNumber($appSetting->tax_code_value3, 4) }}%)</td>
                <td width="15%">{{ $appSetting->currency_type }} {{ $settings->formatNumber(($subtotalPrice * $appSetting->tax_code_value3) / 100, 2) }}</td>


            </tr>
            <tr>
                <td width="85%">Shipping (Delivery Cost): </td>
                <td width="15%">{{ $appSetting->currency_type }} {{ $settings->formatNumber($order->deliveryCost, 2) }}</td>
            </tr>
            <tr>
                <td width="85%">Paypal Fees:</td>
                <td width="15%">{{ $appSetting->currency_type }} {{ $settings->formatNumber($order->paypal_fees, 2) }}</td>
            </tr>
            <tr>
                @php
                    $totalPrice = $subtotalPrice + 0 + 0;
                @endphp
                <td width="85%" class="total-heading">Total Amount:</td>
                <td width="15%" class="total-heading">{{ $appSetting->currency_type }} {{ $settings->formatNumber($totalPrice, 2) }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
