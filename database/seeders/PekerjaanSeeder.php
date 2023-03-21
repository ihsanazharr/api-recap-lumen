<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('pekerjaan')->delete();

            $pekerjaan = [
                [
                    'bulan' => 'Januari',
                    'start' => '2023-01-01 00:00:00',
                    'end'=> '2023-01-31 00:00:00',
                    'jam_toleransi'=> 22,
                    'total_jam'=> 176,
                ],
                [
                    'bulan' => 'Februari',
                    'start' => '2023-02-01 00:00:00',
                    'end' => '2023-02-28 00:00:00',
                    'jam_toleransi'=> 20,
                    'total_jam'=> 170,
                ]
            ];
    
            Pekerjaan::insert($pekerjaan);
            // [
            //     'bulan' => 'Maret',
            //     'start' => '2023-03-01 00:00:00',
            //     'end'=> '2023-03-31 00:00:00',
            //     'jam_toleransi'=> 22,
            //     'total_jam'=> 176,
            // ],
            // [
            //     'bulan' => 'April',
            //     'start' => '2023-04-01 00:00:00',
            //     'end' => '2023-04-30 00:00:00',
            //     'jam_toleransi'=> 20,
            //     'total_jam'=> 160,
            // ],
            // [
            //     'bulan' => 'Mei',
            //     'start' => '2023-05-01 00:00:00',
            //     'end' => '2023-05-31 00:00:00',
            //     'jam_toleransi'=> 23,
            //     'total_jam'=> 184,
            // ],
            // [
            //     'bulan' => 'Juni',
            //     'start' => '2023-06-01 00:00:00',
            //     'end' => '2023-06-30 00:00:00',
            //     'jam_toleransi'=> 22,
            //     'total_jam'=> 176,
            // ],
            // [
            //     'bulan' => 'Juli',
            //     'start' => '2023-07-01 00:00:00',
            //     'end' => '2023-07-31 00:00:00',
            //     'jam_toleransi'=> 21,
            //     'total_jam'=> 168,
            // ],
            // [
            //     'bulan' => 'Agustus',
            //     'start' => '2023-08-01 00:00:00',
            //     'end' => '2023-08-31 00:00:00',
            //     'jam_toleransi'=> 23,
            //     'total_jam'=> 184,
            // ],
            // [
            //     'bulan' => 'September',
            //     'start' => '2023-09-01 00:00:00',
            //     'end' => '2023-09-30 00:00:00',
            //     'jam_toleransi'=> 21,
            //     'total_jam'=> 168,
            // ],
            // [
            //     'bulan' => 'Oktober',
            //     'start' => '2023-10-01 00:00:00',
            //     'end' => '2023-10-31 00:00:00',
            //     'jam_toleransi'=> 22,
            //     'total_jam'=> 176,
            // ],
            // [
            //     'bulan' => 'November',
            //     'start' => '2023-10-01 00:00:00',
            //     'end' => '2023-10-30 00:00:00',
            //     'jam_toleransi'=> 22,
            //     'total_jam'=> 176,
            // ],
            // [
            //     'bulan' => 'Desember',
            //     'start' => '2023-12-01 00:00:00',
            //     'end' => '2023-12-31 00:00:00',
            //     'jam_toleransi'=> 21,
            //     'total_jam'=> 168,
            // ]
    }
}
