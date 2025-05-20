<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OPDPatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => $this->faker->unique()->randomNumber(5),
            'name' => $this->faker->name,
            'age' => $this->faker->numberBetween(1, 100),
            'mobile' => $this->faker->phoneNumber,
            'address' => $this->faker->address
        ];
    }
}
