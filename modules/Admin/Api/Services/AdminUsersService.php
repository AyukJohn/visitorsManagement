<?php

namespace App\Modules\Admin\Api\Services;


use App\Modules\Admin\Api\Repositories\AdminUserRepository;
use App\Modules\Admin\Api\Resources\AdminUserCollection;
use App\Modules\Admin\Api\Resources\AdminUserResource;
use App\Modules\Admin\Api\Resources\UserResource;

class AdminUsersService
{

    protected $adminUserRepository;
 




    public function __construct()
    {
        $this->adminUserRepository = app(AdminUserRepository::class);
    }
    



    public function index(){
        
        $users = $this->adminUserRepository->index();

        // return new AdminUserCollection($users);
        $totalUsers = $users->count(); 

        return [ 
            'total_users'=>$totalUsers,
            'users' => AdminUserResource::collection($users)
        ];


        // return response()->json([
        //     'total_users'=>$totalUsers,
        //     'users' => $users,
        // ]);




        // $users = $this->adminUserRepository->index();

        // // Iterate through each user and add 'verified' and 'verified_at_email' fields
        // $modifiedUsers = $users->map(function ($user) {
        //     return [
        //         'id' => $user->id,
        //         'name' => $user->name,
        //         // ... other user fields
    
        //         'verified' => $user->email_verified_at ? 'Yes' : 'No',
        //         'verified_at_email' => $user->email_verified_at ? $user->email : null,
        //     ];
        // });
    
        // $totalUsers = $users->count(); 
    
        // return response()->json([
        //     'total_users' => $totalUsers,
        //     'users' => $modifiedUsers,
        // ]);
   
    }


    public function getTotalUsersBalance()
    {
       $data = $this->adminUserRepository->getTotalUsersBalance();

       return response()->json([
        'total'=>$data
       ]);
    }




    public function user($id){
        
        return $user = $this->adminUserRepository->user($id);

        // return response()->json([
        //     'user' => $user,
        // ]);
    

    }





    public function deleteUser($userId)
    {
        $user = $this->adminUserRepository->findUserById($userId);

        if ($user) {
            $this->adminUserRepository->deleteUser($user);
            return true; // Deletion successful
        }

        return false; // User not found
    }




    public function deleteUserAccount($request)
    {
        $request->validate([
            'userEmail' => 'required',
            'deletemessage' => 'required',
        ]);

        $userEmail = $request['userEmail'];
        $deleteMessage = $request['deletemessage'];

        $user = $this->adminUserRepository->deleteUserAccount($userEmail, $deleteMessage);


        return response()->json([
            'message' => 'User Deleted',
        ]);

    }





    public function banUser($request){

        return $this->adminUserRepository->banUser($request);

    }



    public function unBanUser($request){

        
    }
    
    
    public function getBannedUsers() {
        return $this->adminUserRepository->getBannedUsers();
    }



}
