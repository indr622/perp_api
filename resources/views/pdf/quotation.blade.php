<!DOCTYPE html>
<html>

<head>
    <title>Quotation - {{ $data['quo_number'] }}</title>
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
                    <h1>PT.GMK MAKMUR </h1>
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
            <h2>QUOTATION</h2>
        </div>

        <div style="margin-top: 25px">
            <table class="order-detail-container align-text-center">
                <tr>
                    <th class="table-head-border">Quotation No.</th>
                    <th>Customer Po</th>
                    <th>Order Date</th>
                </tr>
                <tr>
                    <td>{{ $data['quo_number'] }}</td>
                    <td>{{ $data['customer_po'] }}</td>
                    <td>{{ date('Y-m-d') }}</td>
                </tr>
            </table>
        </div>

        <div class="address-container">
            <div class="company-address-container company-address">
                <strong class="address-label">{{ $data['customer']->name }}</strong>
                {{ $data['customer']->email }}
                <br />
                {{ $data['customer']->phone }}
                <br />
                {{ $data['customer']->address }}
            </div>

            <div class="billing-address-container company-address">
                <strong class="address-label">{{ $data['quo_shipping_name'] }}</strong>

                {{ $data['quo_shipping_email'] }}
                <br />
                {{ $data['quo_shipping_phone'] }}
                <br />
                {{ $data['so_shipping_address'] }}
            </div>
        </div>
        <table width="100%" class="items-table" cellspacing="0" border="0" style="margin-top: 160px">
            <tr class="item-table-heading-row">
                <th width="2%" class="pr-20 text-right item-table-heading">
                    #
                </th>
                <th class="pr-20 text-left item-table-heading">
                    Item Code
                </th>
                <th class="pr-20 text-left item-table-heading">Description</th>
                <th class="pr-20 text-left item-table-heading">Unit</th>
                <th class="pl-10 text-left item-table-heading">Price /100</th>
                <th class="text-left item-table-heading">Qty</th>
                <th class="text-left item-table-heading">Amount</th>
                <th class="text-left item-table-heading">Remark</th>

            </tr>
            @foreach ($data['quotation_details'] as $item)
                <tr class="item-row">
                    <td class="pr-20 text-left item-cell" style="vertical-align: top;">
                        {{ $loop->iteration }}
                    </td>

                    <td class="pl-0 text-left item-cell">
                        <span>{{ $item->product->name }}</span><br />
                    </td>
                    <td class="pr-20 text-left item-cell" style="vertical-align: top; font-size: 8px">

                        {{ $item->product->description }}

                    </td>
                    <td class="pr-20 text-left item-cell" style="vertical-align: top;">
                        {{ $item->product->unit->name }}
                    </td>
                    <td class="pr-20 text-left item-cell" style="vertical-align: top;">
                        {{ number_format($item->price_sell, 0, ',', ',') }}
                    </td>
                    <td class="pl-10 text-left item-cell" style="vertical-align: top;">
                        <strong>{{ $item->qty }}</strong>
                    </td>
                    <td class="text-left item-cell" style="vertical-align: top;">
                        {{ number_format(($item->price_sell * $item->qty) / 100, 0, ',', ',') }}
                    </td>
                    <td class="text-left item-cell" style="vertical-align: top;">
                        <span class="item-description">{{ $item->remark }}</span>
                    </td>
                </tr>
            @endforeach
        </table>
        <hr class="item-cell-table-hr" />
        <div class="total-display-container">
            <table style="width: fit-content" cellspacing="0px" border="0" class="total-display-table page-break">
                <tr>
                    <td class="border-0 total-table-attribute-label">Subtotal</td>
                    <td class="border-0 item-cell total-table-attribute-value">
                        {{ number_format($data['quo_subtotal'], 0, ',', ',') }}
                    </td>
                </tr>

                <tr>
                    <td class="border-0 total-table-attribute-label">PPH</td>
                    <td class="border-0 item-cell total-table-attribute-value">
                        {{ number_format($data['quo_pph'], 0, ',', ',') }}
                    </td>
                </tr>

                <tr>
                    <td style="color: black; background-color: rgb(216, 216, 216)"
                        class="border-0 total-border-left total-table-attribute-label">
                        Total
                    </td>
                    <td class="py-8 border-0 total-border-right item-cell total-table-attribute-value"
                        style="color: black; background-color: rgb(216, 216, 216)">
                        {{ number_format($data['quo_total'], 0, ',', ',') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="notes_container">
            <div class="notes">
                <h4 style="color: #040405">
                    PAYMENT TERMS :{{ $data['quo_term_payment'] }}
                </h4>
                <h4 style="color: #040405">
                    SHIPPING TERMS :{{ $data['term_shipping']->name }}
                </h4>
                <h4 style="color: #040405">TERM AND CONDITION : {{ $data['quo_term_and_condition'] }}</h4>
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
