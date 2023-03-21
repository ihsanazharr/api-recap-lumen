<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();

        $users = [
            [
                'id_role'=> 1,
                'nama'  => 'Admin Bara',
                'email' => 'admin.bara@gmail.com',
                'password'  => Hash::make('admin123'),
                'telp' => '082213475930',
                'alamat' => 'Jl. Jend. Amir Machmud, Cicendo, Bandung',
                'jabatan' => 'Chief Operating Officer'
            ],
            [
                'id_role' => 2,
                'nama' => 'Ihsan Ertansa Azhar',
                'email' => 'ihsan@gmail.com',
                'password' => Hash::make('ihsan123'),
                'telp' => '08577136021',
                'alamat' => 'Jl. KH Usman Dhomiri, Padasuka, Cimahi',
                'jabatan' => 'Internship'   
            ],
        ];

        User::insert($users);

        // User::create(
            // [
            //     'id_role'=> 1,
            //     'nama'  => 'Admin Bara',
            //     'email' => 'admin.bara@gmail.com',
            //     'password'  => Hash::make('admin123'),
            //     'telp' => '082213475930',
            //     'alamat' => 'Jl. Jend. Amir Machmud, Cicendo, Bandung',
            //     'jabatan' => 'Chief Operating Officer'
            // ],
            // [
            //     'id_role' => 2,
            //     'nama' => 'Ihsan Ertansa Azhar',
            //     'email' => 'ihsan@gmail.com',
            //     'password' => Hash::make('ihsan123'),
            //     'telp' => '08577136021',
            //     'alamat' => 'Jl. KH Usman Dhomiri, Padasuka, Cimahi',
            //     'jabatan' => 'Internship'
            // ]);
    }
}
