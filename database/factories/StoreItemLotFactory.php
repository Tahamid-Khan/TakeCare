<?php

namespace Database\Factories;

use App\Models\StoreItemLot;
use App\Models\StoreProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StoreItemLotFactory extends Factory
{
    protected $model = StoreItemLot::class;

    public function definition(): array
    {
        return [
            'lot_number' => $this->faker->word(),
            'expiry_date' => Carbon::now(),
            'quantity' => $this->faker->randomNumber(),
            'has_expiry_date' => $this->faker->boolean(),
            'deleted_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'store_product_id' => StoreProduct::factory(),
        ];
    }
}
