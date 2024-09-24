<?php

namespace App\Modules\Admin\Api\Repositories;


use App\Mail\AccountActivationRequest;
use App\Modules\Account\Models\User;
use App\Modules\Admin\Api\Resources\AdminUserResource;
use App\Modules\Mail\StatusNotification;
use App\Modules\Wallet\Models\UserSellCrypto;
use App\Modules\Wallet\Models\UserSellGiftCardModel;
use App\Modules\Wallet\Models\Wallet;
use Illuminate\Support\Facades\Mail;

class AdminUserRepository
{



    public function index()
    {

        $users = User::with('wallet')->orderBy('created_at', 'desc')->get();

            // $modifiedUsers = $users->map(function ($user) {
            //     return [
            //         'id' => $user->id,
            //         'name' => $user->name,
        
            //         'verified' => $user->email_verified_at ? 'Yes' : 'No',
            //         'verified_at_email' => $user->email_verified_at ? $user->email : null,
            //     ];
            // });

 
        return $users;

    }


    // public static function calculateTotalWalletBalance()
    // {
    //     $wallet = User::with('wallet')->get()->sum(function ($user) {
    //         return $user->wallet->calculateBalance();
    //     });

    //     return $wallet;
    // }


    public function getTotalUsersBalance()
    {
        // $account = Wallet
        $totalBalance = User::with('wallet')->get()->sum(function ($user){
            return $user->wallet->calculateBalance();
        });

        $formatted = number_format($totalBalance, 2, '.', ',');

        return $formatted;
        // return $totalBalance;
    }




    public function findUserById($userId)
    {
        return User::find($userId);
    }


    public function deleteUser(User $user)
    {
        $user->delete();
    }

    // user_sell_crypto
    // user_sell_card
    // bills_utility_transactions

    // public function user($id){

    //     $user = User::with([
    //         'bills_utility_transactions',
    //         'userSellCard',
    //         'userSellCrypto'
    //     ])->find($id);


    //     return response()->json([
    //         'user' => $user,
    //     ]);

    //     // If you need counts as well
    //     // $user->loadCount(['bills_utility_transactions', 'userSellCard', 'userSellCrypto']);

    // }




    public function user($id)
    {

        $user = User::with([
            'bills_utility_transactions' => function ($query) {
                $query->where('p2p_details', null)
                    ->where(function ($query) {
                        $query->where('channel', '!=', 'transfer')
                            ->orWhereNull('channel');
                    })
                    ->orderBy('created_at', 'desc');
            },
            
        ])->find($id);

        // Fetch crypto transactions for the user
        $cryptoTransactions = UserSellCrypto::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch gift card transactions for the user
        $giftcardTransactions = UserSellGiftCardModel::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($giftCardTransaction) {
                $images = json_decode($giftCardTransaction->image, true);
                $formattedImages = [];

                foreach ($images as $index => $url) {
                    $formattedImages[] = [
                        'id' => $index + 1,
                        'url' => $url,
                    ];
                }

                $giftCardTransaction->image = $formattedImages;
                return $giftCardTransaction;
            });

        $user->user_sell_crypto = $cryptoTransactions;
        $user->user_sell_card = $giftcardTransactions;

        $userResource = new AdminUserResource($user);

    return response()->json([
        'user' => $userResource,
    ]);

        // return response()->json([
        //     'user' => $user,
        // ]);
    }



    public function deleteUserAccount($email, $message)
    {


        $user = User::where('email',  $email)->first();

        // dd($user);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $user->delete();

        Mail::to($user->email)->send(new StatusNotification($user, $message));

        // return response()->json([
        //     'message' => 'User Deleted',
        // ]);

    }
 


    public function banUser($request)
    {

        $userId = $request['user_id'];
        $banUser = $request['banUser'];

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $user->update(['is_Banned' => $banUser]);


        if($user->is_Banned === 'false'){
            return response()->json([
                'status' => true,
                'message' => 'User has been unBanned',
            ]);
        }else {
            return response()->json([
                'status' => true,
                'message' => 'User has been banned',
            ]);
        }
    }

    
    
    
    public function unBanUser($request)
    {

        $userId = $request['user_id'];
        $banUser = $request['banUser'];

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.',
            ], 404);
        }
        
        $user->update(['is_Banned' => $banUser]);
        
        return response()->json([
            'status' => 'success',
        ]);
        
    }



    public function getBannedUsers()
    {
        $bannedUsers = User::where('is_Banned', 'true')->get();

        return response()->json([
            'banned_users' => $bannedUsers,
        ]);
    }


}