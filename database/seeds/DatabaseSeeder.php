<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        //we need factory of product and review
        //THE order is important, Review needs Products and Products need user

        factory(App\User::class, 5) -> create();

        factory(App\Model\Product::class, 50) -> create();

        factory(App\Model\Review::class, 300) -> create();
    }
}
