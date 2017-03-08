<?php

use Illuminate\Database\Seeder;

class BuddiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Buddy::class, 15)->create();
    }
}
