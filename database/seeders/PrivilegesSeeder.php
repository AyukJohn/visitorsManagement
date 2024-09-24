<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        


        $cryptoNetworkType  = [
            // ['name' => 'canEdit'],
            // ['name' => 'canDelete',],
            // ['name' => 'canApprove',],
            // ['name' => 'canRemove',],
            // ['name' => 'canAdd',],
            // ['name' => 'canBan', ],

            ['name' => 'canApproveGiftcards'],
            ['name' => 'canApproveCrypto'],
        

        ];

        foreach($cryptoNetworkType as $asset) {
            DB::table('privileges_models')->updateOrInsert([
                "name"=>$asset['name'],
            ]);
        }




    }
}
