<?php

namespace App\Modules\Admin\Api\Repositories;


use App\Mail\AccountActivationRequest;
use App\Modules\Account\Models\User;
use App\Modules\Admin\Models\AdminModel;
use App\Modules\Admin\Models\PrivilegesModel;

class AdminPrivilegesRepository
{



    public function getAllPrivileges()
    {
        

        $data = PrivilegesModel::all();

        // dd($data);

        return response()->json([
            "privileges" => $data,
        ]);
    }




    // public function updatePrivilege($privilege, $adminId)
    // {
        
    //    $adminPrivi = AdminModel::where()

    // }


    public function updatePrivilege($crypto, $giftCard, $adminId)
    {
        $admin = AdminModel::find($adminId);
    
        if ($admin) {
            if ($crypto === true) {
                $admin->can_approve_cryptos = true;
            } elseif ($crypto === false) {
                $admin->can_approve_cryptos = false;
            } else {
                // Handle the case of an invalid value for $crypto
                return response()->json(['message' => 'Invalid value for crypto privilege.'], 400);
            }
    
            if ($giftCard === true) {
                $admin->can_approve_gift_cards = true;
            } elseif ($giftCard === false) {
                $admin->can_approve_gift_cards = false;
            } else {
                // Handle the case of an invalid value for $giftCard
                return response()->json(['message' => 'Invalid value for gift card privilege.'], 400);
            }
    
            // Save the updated privileges
            $admin->save();
    
            // Return a success message upon privilege update
            return response()->json(['message' => 'Privileges updated successfully.']);
        }
    
        // Return a JSON response if the admin is not found
        return response()->json(['message' => 'Admin not found.']);
    }
    
    

}