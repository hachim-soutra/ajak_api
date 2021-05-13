<?php

namespace Database\Factories;

use App\Models\Agence;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'city_id' => 1,
            'status' => 'active',
        ];
    }
}
