<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientDailySummaryFactory extends Factory
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
            'doctor_id' => $this->faker->numberBetween(1, 2),
            // summary with at least 50 characters
            'summary' => $this->faker->text(50)
        ];
    }
}
