<?php
namespace Modules\Dashboard\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Modules\Dashboard\Entities\Product;
use Modules\Brand\Entities\Brand;
use Modules\Store\Entities\Store;


class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Dashboard\Entities\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        $name = $faker->text(20);
        $brand = Brand::inRandomOrder()->first('id');
        $store = Store::inRandomOrder()->first(['id', 'user_id']);
        $sourceDir = public_path(). '/upload/files/product_images';
        $targetDir = public_path() . '/upload/image/product_images';
        return [
            'name'=>$name,
            'slug'=>Str::of($name)->slug('-'),
            'image'=>'upload/image/product_images/' . $faker->file($sourceDir, $targetDir, false),
            'code'=>substr(md5(time()), 0, 5),
            'description'=>$faker->text(100),
            'content'=>$faker->text(200),
            'description_seo'=>$faker->text(50),
            'title_seo'=>$faker->text(10),
            'keyword_seo'=>$faker->word(3),
            'status'=>$faker->randomElement([0, 1]),
            'home'=>$faker->randomElement([0, 1]),
            'hot'=>$faker->randomElement([0, 1]),
            'focus'=>$faker->randomElement([0, 1]),
            'view'=>$faker->buildingNumber(),
            'price'=>$faker->randomNumber(5),
            'price_sale'=>$faker->randomNumber(5),
            'rate'=>$faker->randomElement([0, 1]),
            'brand_id'=>$brand->id,
            // 'user_id'=>$store->user_id,
            'store_id'=>$store->id,
        ];
    }
}

