<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeLeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => $this->faker->numberBetween(1, 2),
            'sick_leave' => $this->faker->numberBetween(0, 10),
            'casual_leave' => $this->faker->numberBetween(0, 10),
            'marital_leave' => $this->faker->numberBetween(0, 10),
            'total_leave' => $this->faker->numberBetween(0, 10),
        ];
    }
}
