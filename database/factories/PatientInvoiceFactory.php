<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\PatientInvoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PatientInvoiceFactory extends Factory
{
    protected $model = PatientInvoice::class;

    public function definition(): array
    {
        return [
            'invoice_number' => $this->faker->word(),
            'invoice_date' => Carbon::now(),
            'service_name' => $this->faker->name(),
            'total_price' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomFloat(),
            'final_price' => $this->faker->randomFloat(),
            'due_amount' => $this->faker->randomFloat(),
            'payment_status' => $this->faker->word(),
            'payment_method' => $this->faker->word(),
            'transaction_id' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'fund_department_id' => $this->faker->randomNumber(),

            'patient_id' => Patient::factory(),
        ];
    }
}
