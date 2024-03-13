<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'Admin Toko',
            'email' => 'widi@gmail.com',
            'password' => bcrypt('admin'),
            'email_verified_at'=> now(),
            'address'=>'jl rajawali',
            'phone'=>'085886843050',
            'role' => 'admin',

        ]);
    }
}
