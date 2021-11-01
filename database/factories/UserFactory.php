<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        $name = $faker->name;
        $slug = Str::of($name)->slug('-');
        $sourceDir = public_path(). '/upload/files/users';
        $targetDir = public_path() . '/upload/image/users';
        return [
            'name'=>$name,
            'slug'=>$slug,
            'email'=>$faker->email,
            'avatar'=>'upload/image/users/' . $faker->file($sourceDir, $targetDir, false),
            'address'=>$faker->address,
            'facebook'=>'facebook',
            'phone'=>$faker->phoneNumber,
            'gender'=>$faker->randomElement([0, 1]),
            'password'=>$faker->password
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
