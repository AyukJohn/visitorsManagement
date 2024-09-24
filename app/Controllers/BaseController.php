<?php
namespace App\Controllers;

// use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\ArraySerializer;

use League\Fractal\Resource\Collection;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Ramsey\Uuid\Uuid;
use App\Models\User;
use Spatie\Fractalistic\Fractal;

class BaseController {
    use DispatchesJobs,ValidatesRequests,AuthorizesRequests;
    // use ResetsPasswords, SendsPasswordResetEmails;

    
    public function loginUser($request){
        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return $this->fail("Invalid login credentials");
        }
        return $this->success( [
            'token' => $token,
            'user' => auth()->user()
        ]);
    }
	
	protected function success($data)
    {
        return response()->json([
            'status'     => "success",
            'data'        => $data,
        ]);
    }

    protected function successWithPages($paginator, $transformer)
    {
        
		$collection = $paginator->getCollection();

		$data = Fractal::create()
			->collection($collection)
			->transformWith($transformer)
            ->serializeWith(new ArraySerializer())         
            ->withResourceName('items')
			->paginateWith(new IlluminatePaginatorAdapter($paginator))
			->toArray();
        return response()->json([
            'status'     => "success",
            'data'        => $data
        ]);
    }

	protected function fail($data)
    {
        return response()->json([
            'status'     => "fail",
            'data'        => $data,

        ],422);
    }

	protected function transform($model, $transformer)
	{		
		$data = Fractal::create($model, $transformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer());
		return $this->success($data);		
	}


	protected function transformModel($model,$transformer){
        return Fractal::create($model, $transformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer());

    }

	protected function error($message)
    {
        return response()->json([
            'status'     => "success",
            'message'    => $message,
        ]);
    }
}