<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name' => 'supper',
            'email' => 'supper_admin@app.com',
            'password' => bcrypt('123456')
        ]);
        $user->attachRole('super_admin');
    }
}
