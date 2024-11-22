<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'nim' => implode('.', [
                $this->faker->randomElement(['22', '23']), // Bagian pertama hanya 22 atau 23
                $this->faker->randomElement(['31', '51', '52']), // Bagian kedua hanya 31, 51, atau 52
                '00' . str_pad($this->faker->numberBetween(0, 99), 2, '0', STR_PAD_LEFT) // Bagian ketiga 00 + angka acak 2 digit
            ]),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('123'),
            // tambahkan baris diawah ini
            // 'role_id' => mt_rand(1, 4),
            'role_id' => $this->faker->numberBetween(1, 4),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
