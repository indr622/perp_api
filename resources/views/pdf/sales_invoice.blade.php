<!DOCTYPE html>
<html>

<head>
    <title>Sales Invoice - {{ $data['inv_number'] }}</title>
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
            <h2>INVOICE</h2>
        </div>
        <div>
            <table class="order-detail-container align-text-center" style="font-size: 11px">
                <tr>
                    <th>Customer Order No.</th>
                    <th>SO no.</th>
                    <th>Invoice No.</th>
                    <th>Invoice Date</th>
                    <th>Document No</th>
                    <th>Delivery Note No.</th>
                    <th>Delivery Date</th>
                </tr>
                <tr>
                    <td>{{ $data['sales_order']->customer_po ?? 'N/A' }}</td>
                    <td>{{ $data['sales_order']->so_number ?? 'N/A' }}</td>
                    <td>{{ $data['inv_number'] }}</td>
                    <td>{{ $data['inv_date'] }}</td>
                    <td>{{ $data['document_no'] }}</td>
                    <td>{{ $data['purchase_shipping'] ?? 'N/A' }}</td>
                    <td>{{ $data['inv_delivery_date'] }}</td>
                </tr>
            </table>
        </div>
        <div class="address-container">
            <div class="company-address-container company-address">
                <strong class="address-label">INVOICE TO</strong>
                <span style="padding-left: 4px">Name : {{ $data['customer']->name }}</span><br>
                <span style="padding-left: 4px">Email : {{ $data['customer']->email }}</span><br>
                <span style="padding-left: 4px">Phone : {{ $data['customer']->phone }}</span><br>
                <span style="padding-left: 4px">Address : {{ $data['customer']->address }}</span>
            </div>

            <div class="billing-address-container company-address">
                <strong class="address-label">DELIVERY TO</strong>
                <span style="padding-left: 4px"> Name :{{ $data['shipping_name'] }} </span><br>
                <span style="padding-left: 4px">Email : {{ $data['shipping_email'] }}</span><br>
                <span style="padding-left: 4px">Phone : {{ $data['shipping_phone'] }}</span><br>
                <span style="padding-left: 4px">Address :{{ $data['shipping_address'] }} </span>
            </div>
        </div>

        <table width="100%" class="items-table" cellspacing="0" border="0" style="margin-top: 160px">
            <tr class="item-table-heading-row">
                <th class=" item-table-heading" style="font-size: 10px">#</th>
                <th class=" item-table-heading" style="font-size: 10px">PRODUCT</th>
                <th class=" item-table-heading" style="font-size: 10px">QUANTITY</th>
                <th class=" item-table-heading" style="font-size: 10px">UNIT</th>
                <th class=" item-table-heading" style="font-size: 10px">PRICE/100</th>
                <th class=" item-table-heading" style="font-size: 10px">AMOUNT</th>
                <th class=" item-table-heading" style="font-size: 10px">AMOUNT</th>

            </tr>
            @foreach ($data['sales_invoice_details'] as $item)
                <tr class="item-row">
                    <td class="text-center item-cell" style="vertical-align: top;">
                        {{ $loop->iteration }}
                    </td>

                    <td class=" text-center item-cell">
                        <span>{{ $item->product->name }}</span><br />
                    </td>
                    <td class="text-center item-cell" style="vertical-align: top;">
                        <strong>{{ $item->qty }}</strong>
                    </td>
                    <td class="text-center item-cell" style="vertical-align: top;">
                        {{ $item->product->unit->name }}
                    </td>
                    <td class="text-center item-cell" style="vertical-align: top;">
                        {{ number_format($item->price_sell, 0, ',', ',') }}
                    </td>

                    <td class="text-center item-cell" style="vertical-align: top;">
                        {{ number_format(($item->price_sell * $item->qty) / 100, 0, ',', ',') }}
                    </td>
                    <td class="text-center item-cell" style="vertical-align: top;">
                        <span class="item-description">{{ $item->remark }}</span>
                    </td>
                </tr>
            @endforeach
        </table>

        <hr class="item-cell-table-hr" />
        <div class="total-display-container">
            <table style="width: fit-content" cellspacing="0px" border="0" class="total-display-table page-break">
                <tr>
                    <td class="border-0 total-table-attribute-label">SUBTOTAL</td>
                    <td class="border-0 item-cell total-table-attribute-value">
                        {{ number_format($data['inv_subtotal'], 0, ',', ',') }}
                    </td>
                </tr>
                <tr>
                    <td class="border-0 total-table-attribute-label">Additional Charge</td>
                    <td class="border-0 item-cell total-table-attribute-value">
                        {{ $data['inv_additional_cost'] }}
                    </td>
                </tr>

                <tr>
                    <td class="border-0 total-table-attribute-label">VAT (11%)</td>
                    <td class="border-0 item-cell total-table-attribute-value">
                        {{ $data['inv_vat'] }}
                    </td>
                </tr>
                <tr>
                    <td class="border-0 total-table-attribute-label">Prepaid</td>

                </tr>

                <tr>
                    <td style="color: black; background-color: rgb(216, 216, 216)"
                        class="border-0 total-border-left total-table-attribute-label">
                        TOTAL
                    </td>
                    <td style="color: black; background-color: rgb(216, 216, 216)"
                        class="border-0 item-cell total-table-attribute-value">
                        {{ number_format($data['inv_total'], 0, ',', ',') }}
                    </td>

                </tr>
                <tr>
                    <td class="border-0 total-table-attribute-label">Payment Due</td>

                </tr>
            </table>
        </div>
        <div class="notes_container">
            <div class="notes">
                <h3 style="color: #040405">
                    BANK INFORMATION
                </h3>

                <table>
                    <tr>
                        <td>BANK NAME</td>
                        <td>:</td>
                        <td> Bank Mandiri (Cabang Fatmawati)</td>
                    </tr>
                    <tr>
                        <td>BANK ADDRESS</td>
                        <td>:</td>
                        <td> PT. GMK MAKMUR INDONESIA</td>
                    </tr>
                    <tr>
                        <td>BANK ACC NAME</td>
                        <td>:</td>
                        <td> PT. GMK MAKMUR INDONESIA</td>
                    </tr>
                    <tr>
                        <td>BANK ACC NUMBER</td>
                        <td>:</td>
                        <td> <span>120000000</span>

                        </td>
                    </tr>
                    <tr>
                        <td>BANK SWIFT CODE</td>
                        <td>:</td>
                        <td> BMIRIIDJA</td>
                    </tr>
                </table>


            </div>

            <div class="notes">
                <div class="author">
                    <p>Authorized By :</p>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
