<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedAdmin();
        $this->seedTeacher();
    }

    protected function seedAdmin()
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'role' => Role::ADMIN
        ]);
    }

    protected function seedTeacher()
    {
        User::factory()->create([
            'name' => 'Teacher',
            'email' => 'teacher@test.com',
            'role' => Role::TEACHER
        ]);
    }
}
