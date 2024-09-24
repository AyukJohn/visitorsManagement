<?php

namespace App\Modules\Residents\Api\Repositories;

use App\Modules\Traits\VMTraits;
// use App\ResidentsModel;
use App\Modules\Residents\Models\ResidentsModel;

class ResidentsRepository
{

    use VMTraits;


    public function returnResidents()
    {
        $data =  ResidentsModel::OrderBy('created_at', 'desc')->paginate(10);
        return $this->dataResponse($data);

    }

    public function createResidents($request)
    {
        $data = ResidentsModel::create($request);
        return $this->messageResponse('Data Created');
    }


 
    
}