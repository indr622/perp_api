<?php

namespace App\Observers;

use App\Models\Purchase\PurchaseOrderDetail;
use App\Models\Purchase\PurchaseShippingDetail;

class PurchaseShippingDetailObserver
{
    /**
     * Handle the PurchaseShippingDetail "created" event.
     *
     * @param  \App\Models\Purchase\PurchaseShippingDetail  $purchaseShippingDetail
     * @return void
     */
    public function created(PurchaseShippingDetail $purchaseShippingDetail)
    {

        $purchase_order_detail = PurchaseOrderDetail::find(1);

        $purchase_order_detail->delete();
    }

    /**
     * Handle the PurchaseShippingDetail "updated" event.
     *
     * @param  \App\Models\Purchase\PurchaseShippingDetail  $purchaseShippingDetail
     * @return void
     */
    public function updated(PurchaseShippingDetail $purchaseShippingDetail)
    {
        //
    }

    /**
     * Handle the PurchaseShippingDetail "deleted" event.
     *
     * @param  \App\Models\Purchase\PurchaseShippingDetail  $purchaseShippingDetail
     * @return void
     */
    public function deleted(PurchaseShippingDetail $purchaseShippingDetail)
    {
        //
    }

    /**
     * Handle the PurchaseShippingDetail "restored" event.
     *
     * @param  \App\Models\Purchase\PurchaseShippingDetail  $purchaseShippingDetail
     * @return void
     */
    public function restored(PurchaseShippingDetail $purchaseShippingDetail)
    {
        //
    }

    /**
     * Handle the PurchaseShippingDetail "force deleted" event.
     *
     * @param  \App\Models\Purchase\PurchaseShippingDetail  $purchaseShippingDetail
     * @return void
     */
    public function forceDeleted(PurchaseShippingDetail $purchaseShippingDetail)
    {
        //
    }
}
