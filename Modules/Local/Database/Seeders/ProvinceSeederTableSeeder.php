<?php

namespace Modules\Local\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Local\Entities\Province;

class ProvinceSeederTableSeeder extends Seeder
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
        Province::insert(config('data_provinces', []));
        $list = Province::all();
        foreach($list as $key => $value)
        {
            $list[$key]['slug'] = Province::find($value->id)->update(['slug'=> Str::of($value->name)->slug('-')]);
        }
    }
}
