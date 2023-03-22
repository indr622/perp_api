<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PurchaseShippingObserver.php
 * Date: 2023-01-30
 */

namespace App\Observers;

use App\Models\Purchase\PurchaseShipping;
use App\Models\Purchase\PurchaseOrderDetail;

class PurchaseShippingObserver
{
    /**
     * Handle the PurchaseShipping "created" event.
     *
     * @param  \App\Models\Purchase\PurchaseShipping  $purchaseShipping
     * @return void
     */
    public function created(PurchaseShipping $purchaseShipping)
    {
    }

    /**
     * Handle the PurchaseShipping "updated" event.
     *
     * @param  \App\Models\Purchase\PurchaseShipping  $purchaseShipping
     * @return void
     */
    public function updated(PurchaseShipping $purchaseShipping)
    {
        //
    }

    /**
     * Handle the PurchaseShipping "deleted" event.
     *
     * @param  \App\Models\Purchase\PurchaseShipping  $purchaseShipping
     * @return void
     */
    public function deleted(PurchaseShipping $purchaseShipping)
    {
        //
    }

    /**
     * Handle the PurchaseShipping "restored" event.
     *
     * @param  \App\Models\Purchase\PurchaseShipping  $purchaseShipping
     * @return void
     */
    public function restored(PurchaseShipping $purchaseShipping)
    {
        //
    }

    /**
     * Handle the PurchaseShipping "force deleted" event.
     *
     * @param  \App\Models\Purchase\PurchaseShipping  $purchaseShipping
     * @return void
     */
    public function forceDeleted(PurchaseShipping $purchaseShipping)
    {
        //
    }
}
