<!DOCTYPE html>
<html>

<head>
    <title>Purchase Order - {{ $data['po_number'] }}</title>
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
            <h2>PURCHASE ORDER CONFIRMATION</h2>
        </div>
        <div>
            <table class="order-detail-container align-text-center">
                <tr>
                    <th class="table-head-border">CUSTOMER ORDER No.</th>
                    <th>ORDER CONFIRMATION No.</th>
                    <th>ORDER DATE</th>
                </tr>
                <tr>
                    <td>{{ $data['po_number'] }}</td>
                    <td>{{ $data['po_number'] }}</td>
                    <td>{{ date('Y-m-d') }}</td>
                </tr>
            </table>
        </div>
        <div class="address-container">
            <div class="company-address-container company-address">
                <strong class="address-label">NAME OF SUPPLIER</strong>
                <span style="padding-left: 4px">Name : {{ $data['supplier']->name }}</span><br>
                <span style="padding-left: 4px">Email : {{ $data['supplier']->email }}</span><br>
                <span style="padding-left: 4px">Phone : {{ $data['supplier']->phone }}</span><br>
                <span style="padding-left: 4px">Address : {{ $data['supplier']->address }}</span>
            </div>

            <div class="billing-address-container company-address">
                <strong class="address-label">DELIVERY TO</strong>
                <span style="padding-left: 4px"> Name : {{ $data['shipping_name'] }}</span><br>
                <span style="padding-left: 4px">Email : {{ $data['shipping_email'] }}</span><br>
                <span style="padding-left: 4px">Phone : {{ $data['shipping_phone'] }}</span><br>
                <span style="padding-left: 4px">Address : {{ $data['shipping_address'] }}</span>
            </div>
        </div>
        @if ($data['po_type'] == 'PRODUCT')
            <table width="100%" class="items-table" cellspacing="0" border="0" style="margin-top: 160px">
                <tr class="item-table-heading-row">
                    <th class=" item-table-heading" style="font-size: 10px">#</th>
                    <th class=" item-table-heading" style="font-size: 10px">PRODUCT/DESCRIPTION</th>
                    <th class=" item-table-heading" style="font-size: 10px">ESTIMATED COMPLETION DATE</th>
                    <th class=" item-table-heading" style="font-size: 10px">QUANTITY</th>
                    <th class=" item-table-heading" style="font-size: 10px">UNIT</th>
                    <th class=" item-table-heading" style="font-size: 10px">PRICE/100</th>
                    <th class=" item-table-heading" style="font-size: 10px">AMOUNT</th>
                </tr>
                @foreach ($data['purchase_order_details'] as $item)
                    <tr class="item-row">
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $loop->iteration }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $item->product['name'] }} | <span
                                style="font-size: 8px">{{ $item->product['description'] }}</span>
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $data['po_request_date'] }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $item->qty }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $item->product['unit']->name }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ number_format($item->price_buy, 0, ',', ',') }}
                        </td>
                        <td class="text-left item-cell" style="vertical-align: top;">
                            {{ number_format(($item->price_buy * $item->qty) / 100, 0, ',', ',') }}
                        </td>
                    </tr>
                @endforeach

            </table>
        @endif

        @if ($data['po_type'] == 'MATERIAL')
            <table width="100%" class="items-table" cellspacing="0" border="0" style="margin-top: 160px">
                <tr class="item-table-heading-row">
                    <th class=" item-table-heading" style="font-size: 10px">#</th>
                    <th class=" item-table-heading" style="font-size: 10px">PRODUCT/DESCRIPTION</th>
                    <th class=" item-table-heading" style="font-size: 10px">ESTIMATED COMPLETION DATE</th>
                    <th class=" item-table-heading" style="font-size: 10px">QUANTITY</th>
                    <th class=" item-table-heading" style="font-size: 10px">UNIT</th>
                    <th class=" item-table-heading" style="font-size: 10px">PRICE/100</th>
                    <th class=" item-table-heading" style="font-size: 10px">AMOUNT</th>
                </tr>
                @foreach ($data['purchase_order_details'] as $item)
                    <tr class="item-row">
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $loop->iteration }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $item->item['name'] }} | <span
                                style="font-size: 8px">{{ $item->item['description'] }}</span>
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $data['po_request_date'] }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $item->qty }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ $item->item['unit']->name }}
                        </td>
                        <td class="item-cell" style="vertical-align: top;">
                            {{ number_format($item->price_buy, 0, ',', ',') }}
                        </td>
                        <td class="text-left item-cell" style="vertical-align: top;">
                            {{ number_format(($item->price_buy * $item->qty) / 100, 0, ',', ',') }}
                        </td>
                    </tr>
                @endforeach

            </table>
        @endif



        <hr class="item-cell-table-hr" />
        <div class="total-display-container">
            <table style="width: fit-content" cellspacing="0px" border="0"
                class="total-display-table page-break">
                <tr>
                    <td class="border-0 total-table-attribute-label">GOOD VALUE</td>
                    <td>{{ $data['currency']->name }} </td>
                    <td class="border-0 item-cell total-table-attribute-value">
                        {{ number_format($data['po_subtotal'], 0, ',', ',') }}
                    </td>
                </tr>

                <tr>
                    <td class="border-0 total-table-attribute-label">11% VAT</td>
                    <td>{{ $data['currency']->name }} </td>
                    <td class="border-0 item-cell total-table-attribute-value">
                        {{ number_format($data['po_vat'], 0, ',', ',') }}
                    </td>
                </tr>
                <tr>
                    <td class="border-0 total-table-attribute-label">PPH</td>
                    <td>{{ $data['currency']->name }} </td>
                    <td class="border-0 item-cell total-table-attribute-value">
                        {{ number_format($data['po_pph'], 0, ',', ',') }}
                    </td>
                </tr>

                <tr>
                    <td style="color: black; background-color: rgb(216, 216, 216)"
                        class="border-0 total-border-left total-table-attribute-label">
                        TOTAL VALUE
                    </td>
                    <td style="color: black; background-color: rgb(216, 216, 216)">{{ $data['currency']->name }} </td>
                    <td class="py-8 border-0 total-border-right item-cell total-table-attribute-value"
                        style="color: black; background-color: rgb(216, 216, 216)">
                        {{ number_format($data['po_total'], 0, ',', ',') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="notes_container">
            <div class="notes">
                <h4 style="color: #040405">
                    PAYMENT TERMS :{{ $data['term_payment'] }}
                </h4>
                <h4 style="color: #040405">
                    SHIPPING MARKS : {{ $data['shipping_mark'] }}
                </h4>
                <h4 style="color: #040405">
                    SHIPPING TERMS: {{ $data['term_shipping']->name }}
                </h4>

            </div>
            <div class="notes">
                <h4 style="color: #040405; text-align: center; min-width: 200px">
                    Received By :
                </h4>
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <div class="author">
                    <p>Authorized signature and company chop</p>
                    <p>Name :</p>
                    <p>Date :</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
