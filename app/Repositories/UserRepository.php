<?php
namespace App\Repositories;



use App\Mail\AccountActivationRequest;
use App\Models\User;
use App\Requests\ActivateRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserRepository  
{

    // public function __construct() {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    public static function find($id) : User
    {
        return User::find($id);
    }


    public static function index()
    {
        return User::all();
    }



    public function register($request){

        $randomNumber = random_int(1000, 9999);

        $data = $request;
        

        // check email exist and user is not verified
       $user = User::where('email', $data['email'])->first();

        
        if ($user==null) {
            
            $tokenData = DB::table('password_reset_tokens')->where('email', $data['email'])->first();

                //Create Password Reset Token
               $da =  DB::table('password_reset_tokens')->insert([
                    'email' => $request['email'],
                    'token' => $randomNumber,
                    'created_at' => Carbon::now()
                ]);
               


                //Get the token just created above
                $tokenData = DB::table('password_reset_tokens')
                    ->where('email', $request['email'])->first();
            


                $user = User::create($data);
                if (!$user)
                    return response()->json([
                        'message' => 'We could not create your account at this time, try again later.'
                ]);


            $this->sendActivationEmail($user, $tokenData->token);

            return response()->json([
                'message' => 'Your account activation email has been sent successfully'
            ]);

        }



        $user = User::create($data);
        if (!$user)
            return response()->json([
                'message' => 'We could not create your account at this time, try again later.'
            ]);
     
        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        $this->sendActivationEmail($user, $tokenData->token);
        return response()->json([
            'message' => 'Your account activation email has been sent successfully'
        ]);

        
    }



    public function sendActivationEmail($user, $token)
    {
        Mail::to($user->email)->later(now()->addSecond(5), new AccountActivationRequest($user, $token));
    }



    public function activateAccount($request)
    {
        $tokenData = DB::table('password_reset_tokens')
            ->where('token', $request['token'])->first();
        if (!$tokenData) {
            return response()->json([
                'message' => 'Invalid token provided'
            ])->status(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::where('email', $tokenData->email)->first();

        $user->email_verified_at = Carbon::now();

        if ($user->save()) {
            // delete the token
            DB::table('password_reset_tokens')
                ->where('token', $request['token'])->delete();
        
                return response()->json([
                    'message' => 'Your account activation email is successful'
                ]);
        }
    }



    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }



    public function login($request){
        if (! $token = auth()->attempt($request)) {
            return response()->json(['error' => 'Unauthorized'], 401);
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