<?php

namespace App\Modules\Admin\Api\Services;


use App\Modules\Admin\Models\AdminModel;

class AuthorizationService
{

 

    public function canApproveGiftcards(AdminModel $admin)
    {
        return $admin->hasPrivilege('canApproveGiftCards');
    }


    public function canApproveCrypto(AdminModel $admin)
    {
        return $admin->hasPrivilege('canApproveCrypto');
    }



}
// canApproveGiftCards canApproveCrypto'