<?php

namespace App\Modules\Admin\Api\Controllers;

// use App\Models\Transaction;




// use App\Modules\Services\PaymentService;

use App\Modules\Admin\Api\Repositories\AdminRepository;
use App\Modules\Admin\Api\Requests\AdminLoginRequest;
use App\Modules\Admin\Api\Requests\AdminRequest;
use App\Modules\Admin\Api\Policies\AdminPolicy;
use App\Modules\Admin\Models\AdminModel;
use Illuminate\Http\Request;

class AdminController
{

    protected $adminRepository;
    protected $bankSearch;

  


    public function __construct()
    {
        $this->adminRepository = app(AdminRepository::class);
        // $this->bankSearch = app(BankListRepository::class);

    }

    /**
 * Create a new blog post.
 *
 * @throws \Illuminate\Auth\Access\AuthorizationException
 */

    public function index(){
        return $this->adminRepository->index();

    }


    public function register(AdminRequest $request){
        // $this->authorize('createAdmin', AdminModel::class);

        
        return $this->adminRepository->register($request->validated());
    }


    public function login(AdminLoginRequest $request){
        return $this->adminRepository->login($request->validated());
    }


    public function deleteAdmin($adminId)
    {
        // dd($adminId);
        return $this->adminRepository->deleteAdmin($adminId);
    }


}
