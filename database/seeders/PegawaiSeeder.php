<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Jumlah data yang akan di-generate
        for ($i = 0; $i < 10; $i++) {
            DB::table('pegawai')->insert([
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'jabatan' => $faker->jobTitle,
                'tanggalmasuk' => $faker->date(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
