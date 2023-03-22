<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationResource extends JsonResource
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
            'configuration' => $this->resource,
            'message'       => $this->message,
        ];
    }
}
