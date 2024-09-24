<?php

namespace App\Modules\Admin\Api\Repositories;


use App\Mail\AccountActivationRequest;
use App\Modules\Account\Models\User;
use App\Modules\Admin\Models\AdminModel;
// use App\Models\User;
use App\Requests\ActivateRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminRepository
{




 // public function __construct() {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    public static function find($id)
    {
        return AdminModel::find($id);
    }


    public static function index()
    {
        return AdminModel::all();
    }



    public function register($request)
    {
    
        // dd($request);

        // Create a new admin record
   
        $data = new AdminModel();
        $data['name'] = $request['name'];
        $data['email'] = $request['email'];
        $data['role'] = $request['role'];
        $data['password'] = Hash::make($request['password']);
        $data['can_approve_gift_cards'] = false;
        $data['can_approve_cryptos'] = false;


        // dd($data);
    
        if($data->save()){
            return response()->json([
                'message' => 'AdminCreated',
                'data'=> $data,
            ]); 
        }
        return response()->json([
            'message' => 'Admin Not Created',
        ], 401);
    }




    public function deleteAdmin($adminId)
    {
        $admin = AdminModel::find($adminId);

        // dd($admin);

        if($admin){
            if($admin->delete()){
                return response()->json(['message'=>'admin removed from records']);
            }
            else {
                return response()->json(['message'=>'admin rnot removed']);
            }
        }
        else {
            return response()->json(['message'=>'admin not found']);
        }


    }





    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'admin' => auth()->guard('admin')->user()
        ]);
    }



    public function login($request){

        // dd($request);
        // if (!$token = JWTAuth::attempt($request)) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
    
        // return response()->json(compact('token'));

        $credentials = request(['email', 'password']);
        // dd($credentials);
        if (!$token = auth()->guard('admin')->attempt($credentials)) {
            // dd(auth()->guard('admin'));
            return response()->json(['error' => 'invalid Credentials'], 401);
        }

        return $this->respondWithToken($token);
        

    
    }


    public function userProfile() {
        return response()->json(auth()->user());
    }


    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function renew() {
        return $this->respondWithToken(auth()->refresh());
    }





}