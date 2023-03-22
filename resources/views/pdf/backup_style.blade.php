<style type="text/css">
    /* -- Base -- */
    body {
        font-family: "DejaVu Sans";
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
        border: 0.5px solid #EAF1FB;
    }

    /* -- Header -- */

    .header-container {
        background: #233044;
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
        padding: 20px 30px 20px 0px;
        text-align: right;
        color: white;
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
        font-size: 24px;
        line-height: 36px;
        text-align: right;
        font-family: "DejaVu Sans";
    }

    .estimate-details-container h4 {
        margin: 0;
        font-size: 10px;
        line-height: 15px;
        text-align: right;
    }

    .estimate-details-container h3 {
        margin-bottom: 1px;
        margin-top: 0;
    }

    /* -- Address -- */

    .content-wrapper {
        display: block;
        margin-top: 60px;
        padding-bottom: 20px;
    }

    .address-container {
        display: block;
        padding-top: 20px;
        margin-top: 10px;
    }

    /* -- Company Address -- */

    .company-address-container {
        padding: 0 0 0 30px;
        display: inline;
        float: left;
        width: 30%;
    }

    .company-address-container {
        padding-left: 30px;
        float: left;
        width: 30%;
        text-transform: capitalize;
        margin-bottom: 2px;
    }

    .company-address-container h1 {
        font-size: 15px;
        line-height: 22px;
        letter-spacing: 0.05em;
        margin-bottom: 0px;
    }

    .company-address {
        margin-top: 2px;
        text-align: left;
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
        padding: 0 40px 0 0;
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
        padding: 30px 30px 10px 30px;
        page-break-before: avoid;
        page-break-after: auto;
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
        border-bottom: 0.620315px solid #E8E8E8;
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
        padding: 0 25px;
    }

    .item-cell-table-hr {
        margin: 0 25px 0 30px;
    }

    .total-display-table {
        box-sizing: border-box;
        page-break-inside: avoid;
        page-break-before: auto;
        page-break-after: auto;
        margin-top: 20px;
        float: right;
        width: auto;
    }

    .total-table-attribute-label {
        font-size: 12px;
        color: #55547A;
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
        border: 1px solid #E8E8E8 !important;
        border-right: 0px !important;
        padding-top: 0px;
        padding: 8px !important;
    }

    .total-border-right {
        border: 1px solid #E8E8E8 !important;
        border-left: 0px !important;
        padding-top: 0px;
        padding: 8px !important;
    }

    /* -- Notes -- */

    .notes {
        font-size: 8px;
        color: #595959;
        margin-top: 8px;
        margin-left: 30px;
        width: 442px;
        text-align: left;
        page-break-inside: avoid;
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
        color: #5851DB;
    }

    .text-center {
        text-align: center
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
        background-image: url({{ $template }})
    }
</style>