<?php

namespace App\Modules\Visitors\Api\Controllers;


use App\Modules\Visitors\Api\Services\VisitorService;
use Illuminate\Http\Request;

class VisitorController
{

    private $visitorService;


    public function __construct(VisitorService $visitorService)
    {
        $this->visitorService = $visitorService;
    }

    public function returnVisitors(Request $request)
    {
        return $this->visitorService->returnVisitors();
    }

    public function createVisitors(Request $request)
    {
       return $this->visitorService->createVisitors($request);
    }


    public function returnVisits(Request $request)
    {
        return $this->visitorService->returnVisits();
    }

    public function createVisits(Request $request)
    {

        // dd($request);
       return $this->visitorService->createVisits($request);
    }

}