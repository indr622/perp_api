<!DOCTYPE html>
<html>

<head>
    <title> Shipping Intruction - {{ $data['shp_number'] }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @include('pdf.style')
</head>

<body>
    <div class="header-container">
        <table width="100%">
            <tr>
                <td width="60%" class="header-section-left" style="padding-top: 0px">
                    <div class="image" style="margin-top: 24px"></div>
                </td>
                <td width="40%" class="header-section-right estimate-details-container">
                    <h1>PT. GMK MAKMUR INDONESIA</h1>
                    <h4>Jalan Raya Bogor KM.28
                        Pekayon, Pasar Rebo
                        Jakarta Timur 13710
                        Indonesia</h4>
                    <h4>Tel: +62 (21) 8773-4786 / 87</h4>
                    <h4>Fax: +62 (21) 8773-5066</h4>
                </td>
            </tr>
        </table>
    </div>
    <hr style="border: none" />
    <div class="content-wrapper">
        <div class="title-container" style="margin-top: 50px">
            <h2>SHIPPING INTRUCTION CONFIRMATION</h2>
        </div>
        <div>
            <table class="order-detail-container align-text-center">
                <tr>
                    <th class="table-head-border" style="font-size: 12px">BY</th>
                    <th class="table-head-border" style="font-size: 12px">SO (Supplier)</th>
                    <th style="font-size: 12px">PO (GMK)</th>
                    <th style="font-size: 12px">DELIVERY DATE</th>
                </tr>
                <tr>
                    <td style="font-size: 12px">BY</td>
                    <td style="font-size: 12px">{{ $data['po_number'] }}</td>
                    <td style="font-size: 12px">{{ $data['purchase_order']->po_number }}</td>
                    <td style="font-size: 12px">{{ date('Y-m-d') }}</td>
                </tr>
            </table>
        </div>
        <div class="address-container">
            <div class="company-address-container company-address">
                <strong class="address-label">BUYER</strong>
                <span>Name : {{ $data['purchase_order']->supplier->name }}</span><br>
                <span>Email : {{ $data['purchase_order']->supplier->email }}</span><br>
                <span>Phone : {{ $data['purchase_order']->supplier->phone }}</span><br>
                <span>Address : {{ $data['purchase_order']->supplier->address }}</span>
            </div>
            <div class="billing-address-container company-address">
                <strong class="address-label">DELIVERY TO</strong>
                <span>Name : {{ $data['purchase_order']->shipping_name }}</span><br>
                <span>Email : {{ $data['purchase_order']->shipping_email }}</span><br>
                <span>Phone : {{ $data['purchase_order']->shipping_phone }}</span><br>
                <span>Address : {{ $data['purchase_order']->shipping_address }}</span>
            </div>
        </div>

        @if ($data['purchase_order']->po_type == 'MATERIAL')
            <table width="100%" class="items-table" cellspacing="0" border="0" style="margin-top: 160px">
                <tr class="item-table-heading-row">
                    <th class=" item-table-heading" style="font-size: 10px">RETAILER</th>
                    <th class=" item-table-heading" style="font-size: 10px">PRODUCT/DESCRIPTION</th>
                    <th class=" item-table-heading" style="font-size: 10px">ESTIMATED DATE</th>
                    <th class=" item-table-heading" style="font-size: 10px">QUANTITY</th>
                    <th class=" item-table-heading" style="font-size: 10px">UNIT</th>
                    <th class=" item-table-heading" style="font-size: 10px">PRICE/100</th>
                    <th class=" item-table-heading" style="font-size: 10px">AMOUNT</th>
                </tr>
                @foreach ($data['purchase_shipping_details'] as $i)
                    <tr class="item-row">
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $loop->iteration }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            <span>{{ $i['item']->name }}</span>
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $data['shp_request_date'] }}

                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            <strong>{{ $i['qty_delivery'] }}</strong>
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            <span>{{ $i['item']->unit->name }}</span>
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ number_format($i['price_buy'], 0, ',', ',') }}
                        </td>
                        <td class="text-left item-cell" style="vertical-align: top;">
                            {{ number_format(($i['price_buy'] * $i['qty_delivery']) / 100, 0, ',', ',') }}
                        </td>
                    </tr>
                @endforeach

            </table>
        @endif

        @if ($data['purchase_order']->po_type == 'PRODUCT')
            <table width="100%" class="items-table" cellspacing="0" border="0" style="margin-top: 160px">
                <tr class="item-table-heading-row">
                    <th class=" item-table-heading" style="font-size: 10px">#</th>
                    <th class=" item-table-heading" style="font-size: 10px">PRODUCT/DESCRIPTION</th>
                    <th class=" item-table-heading" style="font-size: 10px">ESTIMATED DATE</th>
                    <th class=" item-table-heading" style="font-size: 10px">QUANTITY</th>
                    <th class=" item-table-heading" style="font-size: 10px">UNIT</th>
                    <th class=" item-table-heading" style="font-size: 10px">PRICE /100</th>
                    <th class=" item-table-heading" style="font-size: 10px">AMOUNT</th>
                </tr>
                @foreach ($data['purchase_shipping_details'] as $i)
                    <tr class="item-row">
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $loop->iteration }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $i['product']->name }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $data['shp_request_date'] }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            <strong>{{ $i['qty_delivery'] }}</strong>
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $i['product']->unit->name }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ number_format($i['price'], 0, ',', ',') }}
                        </td>

                        <td class="text-left item-cell" style="vertical-align: top;">
                            {{ number_format(($i['price'] * $i['qty_delivery']) / 100, 0, ',', ',') }}
                        </td>
                    </tr>
                @endforeach

            </table>
        @endif

        <hr class="item-cell-table-hr">

        <div class="total-display-container">
            <table width="100%" cellspacing="0px" border="0" class="total-display-table  page-break ">
                <tr>
                    <td class="border-0 total-border-left total-table-attribute-label">Total</td>
                    <td>
                        {{ $data['purchase_order']->currency->name }}
                    </td>
                    <td class="py-8 border-0 total-border-right item-cell total-table-attribute-value"
                        style="color: #5851D8">
                        {{ number_format($data['shp_total'], 0, ',', ',') }}
                    </td>
                </tr>
            </table>
        </div>


        <div class="notes">
            <h4 style="color: #040405">SHIPPING MARK: {{ $data['purchase_order']->term_shipping->name }}</h4>
            <h4 style="color: #040405">SHIPPING TERM : {{ $data['purchase_order']->shipping_mark ?? '-' }} </h4>
            <h4 style="color: #040405">FORWADER DETAIL : {{ $data['note'] ?? '-' }}</h4>
        </div>

        <div class="footer">

        </div>
    </div>
</body>

</html>
