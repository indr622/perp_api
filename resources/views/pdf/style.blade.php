<style type="text/css">
    body {
        font-family: 'DejaVu Sans';
        padding: 0px 40px;
    }

    html {
        margin: 0px;
        padding: 0px;
        margin-top: 50px;
    }

    table {
        border-collapse: collapse;
    }

    hr {
        color: rgba(0, 0, 0, 0.2);
        border: 0.5px solid #eaf1fb;
    }

    /* -- Header -- */

    .header-container {
        position: absolute;
        width: 100%;
        height: 141px;
        left: 0px;
        top: -60px;

    }

    .header-section-left {
        padding-top: 45px;
        padding-bottom: 45px;
        padding-left: 30px;
        display: inline-block;
        width: 30%;
    }

    .header-logo {
        position: absolute;

        text-transform: capitalize;
        color: #fff;
    }

    .header-section-right {
        display: inline-block;

        width: 35%;
        float: right;
        padding: 8px 24px 20px 0px;
        text-align: right;
    }

    .header {
        font-size: 20px;
        color: rgba(0, 0, 0, 0.7);
    }

    /* -- Estimate Details -- */

    .estimate-details-container {
        text-align: center;
        width: 40%;
    }

    .estimate-details-container h1 {
        margin: 0;
        font-size: 1rem;
        line-height: 36px;
        text-align: right;
        font-family: 'DejaVu Sans';
    }

    .estimate-details-container h4 {
        margin: 0;
        font-size: 0.75rem;
        line-height: 15px;
        text-align: right;
        font-weight: normal;
    }

    .estimate-details-container h3 {
        margin-bottom: 1px;
        margin-top: 0;
    }

    /* -- Address -- */

    .content-wrapper {
        display: block;
        margin-top: 24px;
        padding-bottom: 20px;
    }

    .content-wrapper .title-container {
        width 100%;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .content-wrapper .title-container h2 {
        font-size: 1.3rem;
        width 100%;
        line-height: 22px;
        letter-spacing: 0.05em;
        margin-bottom: 0px;
        text-align: center;
    }

    .order-detail-container {
        width: 100%;
        border-spacing: 0;
        margin-top: 12px;
        border-collapse: separate;
        border-radius: 10px;
        border: 1px solid grey;
    }

    .order-detail-container th {
        width: calc(100% / 3);
    }

    .order-detail-container td {
        width: calc(100% / 3);
    }

    .order-detail-container th:not(:last-child),
    .order-detail-container td:not(:last-child) {
        border-right: 1px solid grey;
    }

    .order-detail-container tr:last-child {
        height: 2.75rem;
        max-height: 3rem;
    }

    .order-detail-container>thead>tr:not(:last-child)>th,
    .order-detail-container>thead>tr:not(:last-child)>td,
    .order-detail-container>tbody>tr:not(:last-child)>th,
    .order-detail-container>tbody>tr:not(:last-child)>td,
    .order-detail-container>tfoot>tr:not(:last-child)>th,
    .order-detail-container>tfoot>tr:not(:last-child)>td,
    .order-detail-container>tr:not(:last-child)>td,
    .order-detail-container>tr:not(:last-child)>th,
    .order-detail-container>thead:not(:last-child),
    .order-detail-container>tbody:not(:last-child),
    .order-detail-container>tfoot:not(:last-child) {
        border-bottom: 1px solid grey;
    }




    .table-head-border {
        border: 0px 1px solid #222222;
    }

    .align-text-center {
        text-align: center;
    }


    .address-container {
        display: flex;
        padding-top: 10px;
        margin-top: 0px;
        width: 100%;
        justify-content: space-between;
    }

    /* -- Company Address -- */

    .company-address-container {
        /* padding: 0 0 0 30px; */
        display: inline;
        float: left;
        width: 40%;
    }

    .company-address-container {
        float: left;
        text-transform: capitalize;
        margin-bottom: 2px;
    }

    .company-address-container h1 {
        font-size: 15px;
        line-height: 22px;
        letter-spacing: 0.05em;
        margin-bottom: 0px;
    }

    .address-label {
        width: 100%;
        display: block;
        text-align: center;
        font-size: 12px;
        border-bottom: 1px solid grey;
        line-height: 16px;
        padding: 0px;
        margin-bottom: 12px;
    }

    .company-address {
        height: 150px;
        max-height: 150px;
        margin-top: 0px;
        border-radius: 10px;
        text-align: left;
        border: 1px solid grey;
        word-wrap: break-word;
        font-size: 12px;
        line-height: 15px;
        color: #595959;

    }

    /* -- Billing -- */

    .billing-address-container {
        display: block;
        /* position: absolute; */
        float: right;
        /* padding: 0 40px 0 0; */
        width: 40%;
    }

    .billing-address-label {
        font-size: 12px;
        line-height: 18px;
        padding: 0px;
        margin-bottom: 0px;
    }

    .billing-address-name {
        max-width: 160px;
        font-size: 15px;
        line-height: 22px;
        padding: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .billing-address {
        font-size: 12zpx;
        line-height: 15px;
        color: #595959;
        padding: 0px;
        margin: 0px;
        width: 170px;
        word-wrap: break-word;
    }

    /* -- Shipping -- */

    .shipping-address-container {
        display: block;
        float: right;
        padding: 0 30px 0 0;
    }

    .shipping-address-label {
        font-size: 12px;
        line-height: 18px;
        padding: 0px;
        margin-bottom: 0px;
    }

    .shipping-address-name {
        max-width: 160px;
        font-size: 15px;
        line-height: 22px;
        padding: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .shipping-address {
        font-size: 10px;
        line-height: 15px;
        color: #595959;
        padding: 0px 30px 0px 20px;
        margin: 0px;
        width: 170px;
        word-wrap: break-word;
    }

    .attribute-label {
        font-size: 12;
        font-weight: bold;
        line-height: 22px;
        color: rgba(0, 0, 0, 0.8);
    }

    .attribute-value {
        font-size: 12;
        line-height: 22px;
        color: rgba(0, 0, 0, 0.7);
    }

    /* -- Items Table -- */

    .items-table {
        width: 100%;
        border-spacing: 0;
        margin-top: 24px;
        border-collapse: separate;
        border-radius: 10px;
        border: 1px solid grey;
        page-break-before: avoid;
        page-break-after: auto;
    }

    .items-table th:not(:last-child),
    .items-table td:not(:last-child) {
        border-right: 1px solid grey;
    }

    .items-table>thead>tr:not(:last-child)>th,
    .items-table>thead>tr:not(:last-child)>td,
    .items-table>tbody>tr:not(:last-child)>th,
    .items-table>tbody>tr:not(:last-child)>td,
    .items-table>tfoot>tr:not(:last-child)>th,
    .items-table>tfoot>tr:not(:last-child)>td,
    .items-table>tr:not(:last-child)>td,
    .items-table>tr:not(:last-child)>th,
    .items-table>thead:not(:last-child),
    .items-table>tbody:not(:last-child),
    .items-table>tfoot:not(:last-child) {
        border-bottom: 1px solid grey;
    }


    .items-table hr {
        height: 0.1px;
        margin: 0 30px;
    }

    .item-table-heading {
        font-size: 13.5;
        text-align: center;
        color: rgba(0, 0, 0, 0.85);
        padding: 5px;
    }

    .item-table-heading-row td {
        padding: 5px;
        padding-bottom: 10px;
    }

    .item-table-heading-row {
        border-bottom: 1px solid #233044;
    }

    tr.item-table-heading-row th {
        border-bottom: 0.620315px solid #e8e8e8;
        font-size: 12px;
        line-height: 18px;
    }

    tr.item-row td {
        font-size: 12px;
        line-height: 18px;
    }

    .item-cell {
        font-size: 13;
        color: #040405;
        text-align: center;
        padding: 5px;
        padding-top: 10px;
    }

    .item-description {
        color: #595959;
        font-size: 9px;
        line-height: 12px;
        page-break-inside: avoid;
    }

    /* -- Total Display Table -- */

    .total-display-container {
        display: flex;
        justify-content: flex-end;
        align-items: end;
        margin-top: 20px;
    }

    .item-cell-table-hr {
        margin: 0 25px 0 30px;
    }

    .total-display-table {
        border-spacing: 0;

        border-collapse: separate;
        border-radius: 10px;
        border: 1px solid grey;
        box-sizing: border-box;
        page-break-inside: avoid;
        page-break-before: auto;
        page-break-after: auto;
        float: right;
        width: auto;
    }

    .total-display-table th:not(:last-child),
    .total-display-table td:not(:last-child) {
        border-right: 1px solid grey;
    }

    .total-display-table>thead>tr:not(:last-child)>th,
    .total-display-table>thead>tr:not(:last-child)>td,
    .total-display-table>tbody>tr:not(:last-child)>th,
    .total-display-table>tbody>tr:not(:last-child)>td,
    .total-display-table>tfoot>tr:not(:last-child)>th,
    .total-display-table>tfoot>tr:not(:last-child)>td,
    .total-display-table>tr:not(:last-child)>td,
    .total-display-table>tr:not(:last-child)>th,
    .total-display-table>thead:not(:last-child),
    .total-display-table>tbody:not(:last-child),
    .total-display-table>tfoot:not(:last-child) {
        border-bottom: 1px solid grey;
    }

    .total-table-attribute-label {
        font-size: 12px;
        color: #55547a;
        text-align: left;
        padding-left: 10px;
    }

    .total-table-attribute-value {
        font-weight: bold;
        text-align: right;
        font-size: 12px;
        color: #040405;
        padding-right: 10px;
        padding-top: 2px;
        padding-bottom: 2px;
    }

    .total-border-left {
        border: 1px solid #e8e8e8 !important;
        border-right: 0px !important;
        padding-top: 0px;
        padding: 8px !important;
    }

    .total-border-right {
        border: 1px solid #e8e8e8 !important;
        border-left: 0px !important;
        padding-top: 0px;
        padding: 8px !important;
    }

    /* -- Notes -- */
    .notes_container {
        display: flex;
        justify-content: space-between;
    }

    .notes {
        font-size: 8px;
        color: #595959;
        text-align: left;
        page-break-inside: avoid;
    }

    .author p {
        font-size: 8px;
    }

    .notes-label {
        font-size: 15px;
        line-height: 22px;
        letter-spacing: 0.05em;
        color: #040405;
        width: 108px;
        white-space: nowrap;
        height: 19.87px;
        padding-bottom: 10px;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        color: black;
    }

    /* -- Helpers -- */

    .text-primary {
        color: #5851db;
    }

    .text-center {
        text-align: center;
    }

    table .text-left {
        text-align: left;
    }

    table .text-right {
        text-align: right;
    }

    .border-0 {
        border: none;
    }

    .py-2 {
        padding-top: 2px;
        padding-bottom: 2px;
    }

    .py-8 {
        padding-top: 8px;
        padding-bottom: 8px;
    }

    .py-3 {
        padding: 3px 0;
    }

    .pr-20 {
        padding-right: 20px;
    }

    .pr-10 {
        padding-right: 10px;
    }

    .pl-20 {
        padding-left: 20px;
    }

    .pl-10 {
        padding-left: 10px;
    }

    .pl-0 {
        padding-left: 0;
    }

    .image {
        width: 90;
        height: 50;
        background-size: 100% 100%;
        background-image: url({{ $template }});
    }
</style>
