<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;
use App\Models\User;
use Modules\Brand\Database\Seeders\BrandDatabaseSeeder;
use Modules\Local\Database\Seeders\LocalDatabaseSeeder;
use Modules\Dashboard\Database\Seeders\DashboardDatabaseSeeder;
use Modules\Gallery\Database\Seeders\GalleryDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $this->call(UserSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(BrandDatabaseSeeder::class);
        $this->call(LocalDatabaseSeeder::class);
        $this->call(DashboardDatabaseSeeder::class);
        $this->call(GalleryDatabaseSeeder::class);

        // \App\Models\User::factory(10)->create();
        // for ($i=0; $i < 4; $i++) {
        //     $category = Category::create([
        //         'name' => $faker->words(2, true),
        //     ]);

        //     for ($j=0; $j < 4; $j++) {
        //         $childCategory = $category->categories()->create([
        //             'name'=>$faker->words(3, true)
        //         ]);
        //         for ($k=0; $k < 4; $k++) {
        //             $childCategory->categories()->create([
        //                 'name'=>$faker->words(4, true)
        //             ]);
        //     }
        // }
    // }
}
}
