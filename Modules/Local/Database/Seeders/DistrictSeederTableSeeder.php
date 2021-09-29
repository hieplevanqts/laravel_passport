<?php

namespace Modules\Local\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\Flysystem\Adapter\Local;
use Modules\Local\Entities\District;

class DistrictSeederTableSeeder extends Seeder
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

        District::insert(config('data_districts', []));
         $list = District::all();
        foreach($list as $key => $value)
        {
            $list[$key]['slug'] = District::find($value->id)->update(['slug'=> Str::of($value->name)->slug('-')]);
        }
    }
}
