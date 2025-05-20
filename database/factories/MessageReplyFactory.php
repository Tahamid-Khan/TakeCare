<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MessageReplyFactory extends Factory
{
    protected $model = MessageReply::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'attachment' => $this->faker->word(),

            'message_id' => Message::factory(),
            'user_id' => User::factory(),
        ];
    }
}
