<?php

namespace Database\Factories;

use App\Models\Fund;
use App\Models\FundDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FundDepartmentFactory extends Factory
{
    protected $model = FundDepartment::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'balance' => $this->faker->randomFloat(),

            'fund_id' => Fund::factory(),
        ];
    }
}
