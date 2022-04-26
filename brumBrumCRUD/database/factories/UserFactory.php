<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->userName();
        $surname = $this->faker->lastName();

        return [
            'username' => ( $name . $surname),
            'email' => ( $name . $surname . "@gmail.com"),
            'name' => $name,
            'surname' => $surname,
            'password' => Hash::make('12345'),
            'rol' => "user",
            'detail' => "test",
            'otherInformation' => "test",
            'photo' => Str::random(10),
            'googleID' => Str::random(10)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
