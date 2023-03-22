<?php

namespace App\Constant;

class GlobalConstant
{
    const QUO_STATUS_OPTIONS = [
        self::QUO_STATUS_PENDING,
        self::QUO_STATUS_PROCESS,
        self::QUO_STATUS_FINISH,
        self::QUO_STATUS_CANCEL,
        self::QUO_STATUS_HOLD,
    ];
    const QUO_STATUS_PENDING         = "PENDING";
    const QUO_STATUS_PROCESS         = "PROCESS";
    const QUO_STATUS_FINISH          = "FINISH";
    const QUO_STATUS_CANCEL          = "CANCEL";
    const QUO_STATUS_HOLD            = "HOLD";

    const SO_STATUS_OPTIONS = [
        self::SO_STATUS_PENDING,
        self::SO_STATUS_PROCESS,
        self::SO_STATUS_FINISH,
        self::SO_STATUS_CANCEL,
        self::SO_STATUS_HOLD,
    ];
    const SO_STATUS_PENDING         = "PENDING";
    const SO_STATUS_PROCESS         = "PROCESS";
    const SO_STATUS_FINISH          = "FINISH";
    const SO_STATUS_CANCEL          = "CANCEL";
    const SO_STATUS_HOLD            = "HOLD";
    const PO_TYPE_OPTIONS = [
        self::PO_TYPE_PRODUCT,
        self::PO_TYPE_MATERIAL,
    ];
    const PO_TYPE_PRODUCT               = "PRODUCT";
    const PO_TYPE_MATERIAL              = "MATERIAL";


    const PO_STATUS_OPTIONS = [
        self::PO_STATUS_PROCESS,
        self::PO_STATUS_FINISH,
        self::PO_STATUS_CANCEL,
        self::PO_STATUS_DELIVERY,
    ];

    const PO_STATUS_PROCESS        = "PROCESS";
    const PO_STATUS_FINISH         = "FINISH";
    const PO_STATUS_CANCEL         = "CANCEL";
    const PO_STATUS_DELIVERY       = "DELIVERY";

    const SHP_STATUS_OPTIONS = [
        self::SHP_STATUS_PROCESS,
        self::SHP_STATUS_FINISH,
        self::SHP_STATUS_CANCEL,
        self::SHP_STATUS_DELIVERY,
    ];
    const SHP_STATUS_PROCESS        = "PROCESS";
    const SHP_STATUS_FINISH         = "FINISH";
    const SHP_STATUS_CANCEL         = "CANCEL";
    const SHP_STATUS_DELIVERY       = "DELIVERY";


    const INV_STATUS_OPTIONS = [
        self::INV_STATUS_PAID,
        self::INV_STATUS_UNPAID,
        self::INV_STATUS_CANCEL,
        self::INV_STATUS_PARTIAL,
    ];

    const INV_STATUS_PAID           = "PAID";
    const INV_STATUS_UNPAID         = "UNPAID";
    const INV_STATUS_CANCEL         = "CANCEL";
    const INV_STATUS_PARTIAL        = "PARTIAL";
}
