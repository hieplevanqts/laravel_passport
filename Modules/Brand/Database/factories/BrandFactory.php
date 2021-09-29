<?php
namespace Modules\Brand\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Brand\Entities\Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $faker = Faker::create();
        $name = $faker->name;
        $type = config('data_type', []);
        $status = [0, 1];
        return [
            "name"=>$name,
            "slug"=>Str::of($name)->slug('-'),
            "type"=>$faker->randomElement($type),
            "image"=>$faker->imageUrl(640, 480),
            "sort"=>null,
            "status"=>$faker->randomElement($status),
            "description"=>$faker->text(100)
        ];
    }
}

