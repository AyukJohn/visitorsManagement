<?php

// namespace App\Policies;
namespace App\Modules\Admin\Api\v1\Policies;


use App\Modules\Account\Models\User;

use App\Modules\Admin\Models\AdminModel;
// use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    // use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    // public function __construct()
    // {
    //     //
    // }

    public function viewAdmin(AdminModel $admin){
        return $admin->role = 'superAdmin';
    }

    public function createAdmin(AdminModel $admin){
        return $admin->role = 'superAdmin';
    }

}
