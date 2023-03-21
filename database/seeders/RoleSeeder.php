<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $role = [
            [
                'role'=>'admin'
            ],
            [
                'role'=>'user'
            ],
        ];

        Role::insert($role);

        // Role::create(
        //     [
        //         'role' => 'admin'
        //     ],
        //     [
        //         'role' => 'user'
        //     ]);
    }
}
