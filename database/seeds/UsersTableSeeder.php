<?php

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
        factory(App\User::class, 20)->states('email_verified')->create();
        factory(App\User::class)->states('email_verified')->create([
            'name' => 'Super Bibz',
            'email' => 'admin@bibz.biz',
            'password' => bcrypt('secret'),
            'remember_token' => 'faker_'.str_random(10),
        ]);

    }
}
