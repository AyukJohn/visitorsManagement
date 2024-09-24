<?php

namespace App\Modules\Traits;

trait VMTraits
{
   
    public function messageResponse($message, $status = 201)
    {
        return response()->json([
            'message'=>$message,
        ], $status);
    }


    public function dataResponse($data, $status = 200)
    {
        return response()->json([
            'bet_tips'=>$data,
        ], $status);
    }

}
