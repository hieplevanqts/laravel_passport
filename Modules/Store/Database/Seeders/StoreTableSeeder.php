<?php

namespace Modules\Store\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Store\Entities\Store;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $list = Store::factory()
        ->count(50)
        ->create();
        foreach($list as $key=>$value)
        {
            $list[$key]['sort'] = Store::find($value->id)->update(["sort"=>$value->id]);
        }
    }
}
