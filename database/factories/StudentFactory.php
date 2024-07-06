<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'student_id' => 'SW' . $this->faker->unique()->numberBetween(10000000, 99999999),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // you can use Hash::make('password') if you prefer
            'is_admin' => 0,
            'role' => 'student',
            'clubs' => null,
            'pending_clubs' => null,
            'rejected_clubs' => null,
            'member_role' => 'Member',
            'course' => 'Software Engineering',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
