<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository extends BaseRepository
{
    protected static string $modelClass = Course::class;

    public function createSessions(Course $course, array $sessions): void
    {
        $course->sessions()->createMany($sessions);
    }

    public static function hasStudents(Course $course): bool
    {
        return $course->students()->exists();
    }
}