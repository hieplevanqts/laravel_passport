<?php

namespace Modules\Local\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LocalDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $this->call(ProvinceSeederTableSeeder::class);
        $this->call(DistrictSeederTableSeeder::class);
        $this->call(WardSeederTableSeeder::class);
    }
}
