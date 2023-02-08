<?php

namespace Modules\Person\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Person\Entities\Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}

