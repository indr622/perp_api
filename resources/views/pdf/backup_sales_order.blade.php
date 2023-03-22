<!DOCTYPE html>
<html>

<head>
    <title> Sales Order - {{ $data['number'] }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @include('pdf.style')
</head>

<body>
    <div class="header-container">
        <table width="100%">
            <tr>

                <td width="60%" class="header-section-left" style="padding-top: 0px;">
                    <div class="image" style="margin-top: 24px"></div>

                </td>

                <td width="40%" class="header-section-right estimate-details-container">
                    <h1># Sales Order</h1>
                    <h4>{{ $data['number'] }}</h4>
                    <h4>{{ date('Y-m-d') }}</h4>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="content-wrapper">
        <div class="address-container">
            <div class="company-address-container company-address">
                <strong>{{ $data['customer']->name }}</strong>
                <br>
                {{ $data['customer']->email }}
                <br>
                {{ $data['customer']->phone }}
                <br>

            </div>



            <div class="billing-address-container billing-address">
                {{-- <strong>{{ $data['customer']->name }}</strong>
                <br>
                {{ $data['customer']->email }}
                <br>
                {{ $data['customer']->phone }}
                <br>
                {{ $data['customer']->billing_address }} --}}
            </div>
            <div style="clear: both;"></div>
        </div>

        <table width="100%" class="items-table" cellspacing="0" border="0">
            <tr class="item-table-heading-row">
                <th width="2%" class="pr-20 text-right item-table-heading">#</th>
                <th width="20%" class="pl-0 text-left item-table-heading">Item Code</th>
                <th class="pr-20 text-left item-table-heading">Description</th>
                <th class="pr-20 text-left item-table-heading">Unit</th>
                <th class="pr-20 text-left item-table-heading">Price</th>
                <th class="pl-10 text-left item-table-heading">Qty</th>
                <th class="text-left item-table-heading">Amount</th>
                <th class="text-left item-table-heading">Remark</th>
            </tr>

            @foreach ($data['sales_order_details'] as $item)
                <tr class="item-row">
                    <td class="pr-20 text-left item-cell" style="vertical-align: top;">
                        {{ $loop->iteration }}
                    </td>
                    <td class="pl-0 text-left item-cell">
                        <span>{{ $item->product->name }} </span><br>
                        <span> {{ $item->product->item->name }}</span><br>
                        <span class="item-description">
                            thick:{{ $item->product->thick }},width:{{ $item->product->width }},length:{{ $item->product->length }}
                            <br>
                            air
                            hole:{{ $item->product->airhole }},width:{{ $item->product->sealtype_type }},length:{{ $item->product->perforation ? 'YES' : 'NO' }}
                        </span>
                    </td>
                    <td class="pr-20 text-left item-cell" style="vertical-align: top;">

                        {{ $item->product->description }}
                        <br>
                        <span class="item-description">

                        </span>
                    </td>
                    <td class="pr-20 text-left item-cell" style="vertical-align: top;">
                        DUS
                        <br>
                        <span class="item-description">
                            Color:{{ $item->product->color }}
                        </span>
                    </td>
                    <td class="pr-20 text-left item-cell" style="vertical-align: top;">
                        {{ number_format($item->price_sell, 0, ',', ',') }}
                    </td>
                    <td class="pl-10 text-left item-cell" style="vertical-align: top;">
                        <strong>{{ $item->qty }}</strong>
                    </td>
                    <td class="text-left item-cell" style="vertical-align: top;">
                        {{ number_format($item->price_sell * $item->qty, 0, ',', ',') }}
                    </td>
                    <td class="text-left item-cell" style="vertical-align: top;">
                        <span class="item-description">{{ $item->remark }}</span>
                    </td>

                </tr>
            @endforeach
        </table>

        <hr class="item-cell-table-hr">

        <div class="total-display-container">
            <table width="100%" cellspacing="0px" border="0" class="total-display-table  page-break ">
                <tr>
                    <td class="border-0 total-table-attribute-label">Subtotal</td>
                    <td class="border-0 item-cell total-table-attribute-value ">
                        {{ number_format($data['so_subtotal'], 0, ',', ',') }}</td>
                </tr>
                <tr>
                    <td class="border-0 total-table-attribute-label">Discount</td>
                    <td class="border-0 item-cell total-table-attribute-value ">
                        {{ number_format($data['so_discount'], 0, ',', ',') }}</td>
                </tr>
                <tr>
                    <td class="border-0 total-table-attribute-label">PPH</td>
                    <td class="border-0 item-cell total-table-attribute-value ">
                        {{ number_format($data['pph23'], 0, ',', ',') }}</td>
                </tr>
                <tr>
                    <td class="border-0 total-table-attribute-label">TAX</td>
                    <td class="border-0 item-cell total-table-attribute-value ">
                        {{ number_format($data['vat'], 0, ',', ',') }}</td>
                </tr>
                <tr>
                    <td class="py-3"></td>
                    <td class="py-3"></td>
                </tr>
                <tr>
                    <td class="border-0 total-border-left total-table-attribute-label">Total</td>
                    <td class="py-8 border-0 total-border-right item-cell total-table-attribute-value"
                        style="color: #5851D8">
                        {{ number_format($data['total_amount'], 0, ',', ',') }}
                    </td>
                </tr>
            </table>
        </div>


        <div class="notes">
            <h4 style="color: #040405">Term And Condition :</h4>
            <p>{{ $data['term_and_condition'] }}</p>
            <h4 style="color: #040405">Term Shipping :</h4>
            <h4 style="color: #040405">Term Payment :</h4>

        </div>

        <div class="footer">
            <hr>
            <span style="margin-left: 8px;font-size:10px">{{ $company->name }}
            </span>
            <hr>
        </div>
    </div>
</body>

</html>
