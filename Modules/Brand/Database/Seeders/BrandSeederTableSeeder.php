<?php

namespace Modules\Brand\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Brand\Entities\Brand;
use Faker\Factory as Faker;

class BrandSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $list = Brand::factory()
        ->count(50)
        ->create();
        // $this->call("OthersTableSeeder");

        foreach($list as $key=>$value)
        {
            $list[$key]['sort'] = Brand::find($value->id)->update(["sort"=>$value->id]);
        }
    }
}
