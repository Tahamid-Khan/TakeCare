<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'patient_id' => $this->faker->word(),
            'gender' => $this->faker->word(),
            'age' => $this->faker->word(),
            'blood_group' => $this->faker->word(),
            'mobile' => $this->faker->word(),
            'guardian_mobile' => $this->faker->word(),
            'address' => $this->faker->address(),
            'disease' => $this->faker->word(),
            'patient_summary' => $this->faker->text(),
            'patient_type' => $this->faker->word(),
            'department' => $this->faker->word(),
            'reference' => $this->faker->word(),
            'advance' => $this->faker->word(),
            'due' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'doctor_id' => Doctor::factory(),
        ];
    }
}
