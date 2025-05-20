<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\EmployeeLeaveRequest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EmployeeLeaveRequestFactory extends Factory
{
    protected $model = EmployeeLeaveRequest::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'leave_type' => $this->faker->word(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'total' => $this->faker->randomNumber(),
            'reason' => $this->faker->word(),
            'status' => $this->faker->word(),

            'employee_id' => Employee::factory(),
        ];
    }
}
