<?php

namespace Database\Seeders;


use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        $this->create_users();
    }

    private function create_users()
    {
        User::create([
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
        ]);

        for($i=0; $i<20; $i++) {

            $name = fake()->word();
            $email = Str::slug($name) . '@gmail.com';

            User::firstOrCreate(
                ['email' => $email],
                [
                    'role' => 'user',
                    'name' => $name,
                    'password' => Hash::make(12345678),
                ]
            );
        }
    }
}
