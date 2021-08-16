<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->name, 'price'=> $this->faker->randomNumber(2), 'discount'=>$this->faker->randomNumber(1),
            'quantity'=>$this->faker->randomNumber(2),
            'availability'=>$this->faker->randomNumber(1), 'merchant_name'=>$this->faker->company,
            'starts_at'=>$this->faker->dateTime, 'ends_at'=>$this->faker->dateTime, 'tell'=>$this->faker->phoneNumber,
            'service_time'=>$this->faker->name, 'service_days'=>$this->faker->name, 'address'=>$this->faker->address
        ];
    }
}


















// <?php

// use App\Models\Product;
// use App\Models\ProductMeta;
// use Faker\Generator as Faker;

//     $factory->define(Product::class, function (Faker $faker) {
//         return [
//             'title'=> $faker->name, 'price'=> $faker->randomNumber(2), 'discount'=>$faker->randomNumber(1),
//             'quantity'=>$faker->randomNumber(2),
//             'availability'=>$faker->randomNumber(1), 'merchant_name'=>$faker->title,
//             'starts_at'=>$faker->dateTime, 'ends_at'=>$faker->dateTime, 'tell'=>$faker->phoneNumber,
//             'service_time'=>$faker->name, 'service_days'=>$faker->name, 'address'=>$faker->name
//         ];
//     });
    
//     $factory->define(ProductMeta::class, function (Faker $faker) {
//         return [
//             'key'=>$faker->name, 'value'=>$faker->name
//         ];
//     });
    




