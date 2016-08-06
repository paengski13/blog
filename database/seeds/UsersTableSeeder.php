<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'secret';
        $users = [
            [
                'name'       => 'Rafael Torres',
                'email'      => 'rafael@gmail.com',
                'password'   => $password
            ],

            [
                'name'       => 'Zainab Al-anbuky',
                'email'      => 'zainab@gmail.com',
                'password'   => $password
            ],
        ];
        dd($users);
        foreach ($users as $user) {
            \App\Models\User::create([
                'name'     => $user['name'],
                'email'    => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
