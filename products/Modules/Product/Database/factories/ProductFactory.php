<?php

namespace Modules\Product\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Person\Entities\Person;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Product\Entities\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => fake()->name(),
            'price' => fake()->randomDigit(),
            'status' => 0,
            'type' => 'item',
            'person_id' => Person::factory(),
        ];

    }
}

