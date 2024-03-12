<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(10)->create();


        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'johnias@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'phone' => '123123123',
        ]);

        //seeder profile clinic manual
        \App\Models\ProfileClinic::factory()->create([
            'name' => 'Johni-As Clinic',
            'email' => 'johnias@gmailcom',
            'phone' => '123123123',
            'address' => 'Jl. Jend. Sudirman No. 10',
            'website' => 'johniasclinic.com',
            'description' => 'Johni-As Clinic adalah klinik yang berada di Jl. Jend. Sudirman No. 10, Jakarta.
            Klinik ini berada di kota jakarta, Indonesia.',
            'doctor_name' => 'Johni',
            'unique_code' => '123123123',
            'logo' => 'https://www.thermofisher.com/content/dam/global/brand-identity/thermofisher/mythology/brand-logo.png',

        ]);

        //call
        $this->call(DoctorSeeder::class);
        



    }
}
