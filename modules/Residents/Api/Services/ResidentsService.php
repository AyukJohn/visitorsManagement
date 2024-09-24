<?php

namespace App\Modules\Residents\Api\Services;

use App\Modules\Residents\Api\Repositories\ResidentsRepository;

class ResidentsService
{


    private $residentsRepository;

    public function __construct(ResidentsRepository $residentsRepository)
    {
       $this->residentsRepository  = $residentsRepository;
    }



    public function returnResidents()
    {
        $data =  $this->residentsRepository->returnResidents();

        if ($data->isEmpty()) {
         return null;
        }
        return $data;
    }


    public function createResidents($request)
    {

        $request->validate([
            'fName' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required',
        ]);

        return $this->residentsRepository->createResidents([
            'fName' => $request['fName'],
            'email' => $request['email'],
            'phoneNumber' => $request['phoneNumber'],
        ]);

    }


}