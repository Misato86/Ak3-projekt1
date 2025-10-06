<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Uppgift;

class UppgiftFactory extends Factory{
    protected $model = Uppgift::class;
    /**
     * The name of the factory's corresponding model.
     *
     * @inherit string
     */

    public function definition()
    {
        return [
            'id' => 0,
            'text' => "fgdhg", //$this->faker->sentence(3),
            'done' => false,
        ];
    }
}