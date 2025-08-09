<?php

namespace App\Http\Controllers;

use App\Services\BaseService;

abstract class Controller
{
    protected ?string $serviceClass = null;
    protected ?BaseService $service = null;
    
    public function __construct()
    {
        if($this->serviceClass) {
            $this->service = new $this->serviceClass;
        }
    }
}
