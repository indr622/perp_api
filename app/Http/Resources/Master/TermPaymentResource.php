<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: TermPaymentResource.php
 * Date: 2023-01-20
 */

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class TermPaymentResource extends JsonResource
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
            'status'        => $this->status,
            'pid'           => $this->pid,
            'term_payment'  => $this->resource,
            'message'       => $this->message,
        ];
    }
}
