<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'patient_id' => $this->faker->randomDigitNotNull,
            // 'user_id' => $this->faker->randomDigitNotNull,
            // patient id and user id random from 1, 2
            'patient_id' => $this->faker->numberBetween(1, 2),
            'user_id' => $this->faker->numberBetween(1, 2),
            'pulse_rate' => $this->faker->randomDigitNotNull,
            'blood_pressure' => $this->faker->randomDigitNotNull,
            'temperature' => $this->faker->randomDigitNotNull,
            'oxygen_level' => $this->faker->randomDigitNotNull,
        ];
    }
}
