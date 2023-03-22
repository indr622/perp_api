<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SalesInvoiceResource.php
 * Date: 2023-02-13
 */

namespace App\Http\Resources\Sales;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesInvoiceResource extends JsonResource
{
    public static $wrap = null;
    public $status;
    public $pid;
    public $message;

    public function __construct($resource, $pid, $status, $message)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
        $this->pid = $pid;
    }
    public function toArray($request)
    {
        return [
            'status'            => $this->status,
            'pid'               => $this->pid,
            'sales_invoice'     => $this->resource,
            'message'           => $this->message,
        ];
    }
}
