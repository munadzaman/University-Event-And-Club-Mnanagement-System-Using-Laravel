<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory; // Import FakerFactory

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create(); // Initialize Faker

        // Create one specific user with random data
        User::factory()->create([
            'name' => 'Ashrafuzzaman Munad',
            'student_id' => 'SW' . $faker->unique()->numberBetween(10000000, 99999999),
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'is_admin' => 0,
            'role' => 'student', // Specify role for the user
            'clubs' => null,
            'pending_clubs' => null,
            'rejected_clubs' => null,
            'member_role' => 'Member',
            'course' => 'Software Engineering',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create additional users using the factory
        User::factory()->count(10)->create([
            'student_id' => function () use ($faker) {
                return 'SW' . $faker->unique()->numberBetween(10000000, 99999999);
            },
            'phone' => $faker->phoneNumber,
            'role' => 'student', // Specify role for each additional user
        ]);
    }
}
