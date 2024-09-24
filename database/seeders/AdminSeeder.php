<?php

namespace Database\Seeders;

use App\Modules\Admin\Models\AdminModel;
use App\Modules\Admin\Models\PrivilegesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // AdminModel::updateOrInsert(
        //     [
        //         'email' => 'superadmin@gmail.com',
        //     ],
        //     [
        //         'name' => 'SuperAdmin',
        //         'password' => Hash::make('admin2023'),
        //         'role' => 'superAdmin',
        //     ]
        // );


        $superAdmin = AdminModel::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],

            [
                'name' => 'SuperAdmin',
                'password' => Hash::make('admin2023'),
                'role' => 'superAdmin',
            ]
            
        );


        $superAdmin = AdminModel::where('email', 'superadmin@gmail.com')->first();

        // $privileges = ['canApproveGiftCards', 'canApproveCrypto'];

        // foreach ($privileges as $privilege){
        //     PrivilegesModel::updateOrInsert([
        //         'name' => $privilege,
        //         'admin_id' => $superAdmin->id,
        //     ]);
        // }

    }


}
