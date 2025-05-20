<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => 1,
            'check_in' => $this->faker->dateTime(),
            'check_out' => $this->faker->dateTime(),
            'total_hours' => $this->faker->time(),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['present', 'absent', 'leave']),
        ];
    }
}
