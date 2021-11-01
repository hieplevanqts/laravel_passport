<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Str;
use Modules\Store\Entities\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = Store::factory()
        ->count(50)
        ->create();
        foreach($list as $key=>$value)
        {
            $list[$key]['sort'] = Store::find($value->id)->update(["sort"=>$value->id]);
        }
    }
}
