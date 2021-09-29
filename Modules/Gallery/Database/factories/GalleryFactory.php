<?php
namespace Modules\Gallery\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Gallery\Entities\Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        return [
            "url"=>$faker->imageUrl(640, 480),
            "module"=>"product",
            "alt"=>$faker->text(100),
            "sha1_text"=>$faker->sha1(),
            "total"=>0
        ];
    }
}

