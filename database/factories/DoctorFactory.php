<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
