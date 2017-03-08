<?php

use Illuminate\Database\Seeder;

class AdtjesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Adtje::class, 37)->create();
        factory(App\Adtje::class, 24)->states('collected')->create();
    }
}
