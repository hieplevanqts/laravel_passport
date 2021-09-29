<?php

namespace Modules\Local\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Local\Entities\Ward;

class WardSeederTableSeeder extends Seeder
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
        Ward::insert(config('data_wards', []));
        $list = Ward::all();
        foreach($list as $key => $value)
        {
            $list[$key]['slug'] = Ward::find($value->id)->update(['slug'=> Str::of($value->name)->slug('-')]);
        }
    }
}
