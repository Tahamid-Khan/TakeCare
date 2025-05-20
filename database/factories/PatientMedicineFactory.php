<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientMedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'patient_id' => $this->faker->numberBetween(1, 2),
            'doctor_id' => $this->faker->numberBetween(1, 2),
            'medicine_name' => $this->faker->word(),
            'schedule' => json_encode(['morning', 'afternoon', 'evening']),
            'taking_time' => $this->faker->randomElement(['before', 'after']),
            'dose' => $this->faker->word(),
            'duration' => $this->faker->randomElement(['1 week', '2 weeks', '3 weeks', '4 weeks']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'created_by' => $this->faker->name(),
        ];
    }
}
