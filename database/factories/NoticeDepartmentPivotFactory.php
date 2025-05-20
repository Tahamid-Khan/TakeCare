<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Notice;
use App\Models\NoticeDepartmentPivot;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class NoticeDepartmentPivotFactory extends Factory
{
    protected $model = NoticeDepartmentPivot::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'notice_id' => Notice::factory(),
            'department_id' => Department::factory(),
        ];
    }
}
