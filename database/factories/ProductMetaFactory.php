<?php

namespace Database\Factories;

use App\Models\ProductMeta;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductMetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductMeta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id'=>$this->faker->name,'key'=>$this->faker->unique()->word,
            'value'=>$this->faker->unique()->word
        ];
    }
}
