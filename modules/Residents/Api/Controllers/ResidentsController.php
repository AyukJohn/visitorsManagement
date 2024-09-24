<?php

namespace App\Modules\Residents\Api\Controllers;


use App\Modules\Residents\Api\Services\ResidentsService;
use Illuminate\Http\Request;

class ResidentsController
{

    private $residentsService;


    public function __construct(ResidentsService $residentsService)
    {
        $this->residentsService = $residentsService;
    }

    public function returnResidents(Request $request)
    {
        return $this->residentsService->returnResidents();
    }

    public function createResidents(Request $request)
    {
       return $this->residentsService->createResidents($request);
    }

}