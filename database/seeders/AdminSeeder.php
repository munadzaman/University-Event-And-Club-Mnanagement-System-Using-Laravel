<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'munadzaman@gmail.com',
            'password' => Hash::make('admin'), 
            'role' => 'admin',
            'student_id' => 'admin',
            'phone' => '1234567890',
            'member_role' => 'admin',
            'course' => 'Admin Course'
        ]);
    }
}
