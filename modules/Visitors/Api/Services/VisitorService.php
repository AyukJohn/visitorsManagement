<?php

namespace App\Modules\Visitors\Api\Services;

use App\Modules\Residents\Api\Repositories\ResidentsRepository;
use App\Modules\Visitors\Api\Repositories\VisitorRepository;

class VisitorService
{


    private $visitorRepository;

    public function __construct(VisitorRepository $visitorRepository)
    {
       $this->visitorRepository  = $visitorRepository;
    }


    public function returnVisitors()
    {
        $data =  $this->visitorRepository->returnVisitors();

        if ($data->isEmpty()) {
         return null;
        }
        return $data;
    }


    public function createVisitors($request)
    {

        $request->validate([
            'fName' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required',
        ]);

        return $this->visitorRepository->createVisitors([
            'fName' => $request['fName'],
            'email' => $request['email'],
            'phoneNumber' => $request['phoneNumber'],
        ]);

    }


    public function returnVisits()
    {
        $data =  $this->visitorRepository->returnVisits();

        if ($data->isEmpty()) {
         return null;
        }
        return $data;
    }


    public function createVisits($request)
    {

        
        $request->validate([
            'resident_id' => 'required',
            'visitor_id' => 'required',
            'roomNumber' => 'required',
            'timeOfVisit' => 'required',
            'timeOfLeaving' => 'required',
            
        ]);
        
        // dd($request);
        return $this->visitorRepository->createVisits([
            'resident_id' => $request['resident_id'],
            'visitor_id' => $request['visitor_id'],
            'roomNumber' => $request['roomNumber'],
            'timeOfVisit'  => $request['timeOfVisit'],
            'timeOfLeaving'  => $request['timeOfLeaving'],
        ]);

    }


}