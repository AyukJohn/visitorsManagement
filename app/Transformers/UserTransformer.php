<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal;

// LaravelSolutionTransformer


class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(User $user)
    {
        return [
          'id'=>$user->id,
          'first_name'=>$user->first_name,
          'last_name'=>$user->last_name,
          'username'=>$user->username,
          'email'=>$user->email,
        //   'fullname'=>$user->fullName(),
        //   'profile_image'=>$user->profile_image,
        //   'gender'=>$user->gender,
        //   'address'=>$user->address,
        //   'date_of_birth'=>$user->date_of_birth,
        //   'country'=>$user->country()->first(),
        //   'role'=>$user->role()->first(),
        //   'profile'=>$user->profile()->first(),
          
        ];
    }

}