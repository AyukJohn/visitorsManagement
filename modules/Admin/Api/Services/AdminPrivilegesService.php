<?php

namespace App\Modules\Admin\Api\Services;

use App\Modules\Admin\Api\Repositories\AdminPrivilegesRepository;


class AdminPrivilegesService
{

    protected $adminPrivileges;
 




    public function __construct()
    {
        $this->adminPrivileges = app(AdminPrivilegesRepository::class);
    }
    



    public function getAllPrivileges()
    {
        return $data = $this->adminPrivileges->getAllPrivileges();
    }


    public function updatePrivilege($request, $adminId)
    {

        $giftCard = $request['can_approve_gift_cards'];
        $crypto = $request['can_approve_cryptos'];

        // dd($request);
        $updatedAdmin = $this->adminPrivileges->updatePrivilege($crypto, $giftCard, $adminId);

        // dd($updatedAdmin);

        return $updatedAdmin;
    }



}