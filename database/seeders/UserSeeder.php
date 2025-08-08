<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use App\Models\Course;
use App\Models\Session;
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
        $teacher = User::factory()->create([
            'name' => 'Teacher',
            'email' => 'teacher@test.com',
            'role' => Role::TEACHER
        ]);

        $this->createCoursesForTeacher($teacher);
    }

    protected function createCoursesForTeacher(User $teacher)
    {
        Course::factory()
            ->count(5)
            ->for($teacher, 'teacher')
            ->has(Session::factory()->count(3))
            ->create();
    }
}
