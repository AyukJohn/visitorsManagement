<?php

namespace App\Modules\Visitors\Api\Repositories;

use App\Modules\Traits\VMTraits;
// use App\VisitorsModel;
use App\Modules\Visitors\Models\VisitorsModel;
// use App\VisitsModel;
use App\Modules\Visitors\Models\VisitsModel;

class VisitorRepository
{

    use VMTraits;


    public function returnVisitors()
    {
        $data =  VisitorsModel::OrderBy('created_at', 'desc')->paginate(10);
        return $this->dataResponse($data);

    }

    public function createVisitors($request)
    {
        $data = VisitorsModel::create($request);
        return $this->messageResponse('Data Created');
    }


    public function createVisits($request)
    {
        $data = VisitsModel::create($request);
        return $this->messageResponse('Data Created');
    }


    public function returnVisits()
    {

        $data = VisitsModel::with(['resident', 'visitor'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return $this->dataResponse($data);
    }


 
    
}