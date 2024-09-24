<?php

namespace App\Modules\Admin\Api\Resources;

use App\Modules\Account\Models\Referral;
use App\Modules\Wallet\Api\Resources\WithdrawalResource;
use App\Modules\Wallet\Models\UserBankAcctNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
{
   
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    

     public function toArray(Request $request): array
     {
         $referralCount = Referral::where('referrer_id', $this->id)->count();
 
         $referrer = Referral::where('referree_id', $this->id)->first();
 
         $referrerName = $referrer ? $referrer->referrer->first_name . ' ' . $referrer->referrer->last_name : null;
 
         $withdrawal = $this->user_withdrawal_acctnumbers; // Use the relationship to fetch the bank account information
 
         return [
             'id' => $this->id,
             'full_name' => $this->full_name,
             'email' => $this->email,
             "phone_number" => $this->phone_number,
             "fcm_token" => $this->fcm_token,
             "user_tag" => $this->user_tag,
             "transactionPin" => $this->transactionPin,
             "image" => $this->image,
             "state" => $this->state,
             "address" => $this->address,
             // "account_reference" => $this->account_reference,
             "country" => $this->country,
             'totalPeopleReferred' => $referralCount,
             'referredBy' => $referrerName,
             'account_name' => $withdrawal ? $withdrawal->account_name : null,
             'account_number' => $withdrawal ? $withdrawal->acct_number : null,
             'bank_name' => $withdrawal ? $withdrawal->bank_name : null,
             "email_verified_at" => $this->email_verified_at,
             "status" => $this->status,
             "referralCode" => $this->referral_code,
             'referral_bonus' => number_format($this->referral_bonus, 2),
             'verified' => $this->email_verified_at ? 'Yes' : 'No', // Display 'Yes' if verified, 'No' if not
             'verified_at_email' => $this->email_verified_at ? $this->email : null,
             'created_at' => $this->created_at,
             'updated_at' => $this->updated_at,
             'total_transactions' => $this->total_transactions,

             'bills_utility_transactions' => $this->bills_utility_transactions,
             'user_sell_crypto' => $this->user_sell_crypto,
             'user_sell_card' => $this->user_sell_card,
         ];
     }

}

