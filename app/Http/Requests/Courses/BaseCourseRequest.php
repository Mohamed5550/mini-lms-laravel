<?php

namespace App\Http\Requests\Courses;

use App\Enums\Role;
use App\Repositories\CourseRepository;
use Illuminate\Foundation\Http\FormRequest;

class BaseCourseRequest extends FormRequest
{
    protected function assertCourseBelongsToAuthenticatedTeacher($validator, $course)
    {
        $validator->after(function ($validator) use ($course) {
            if ($course->teacher_id !== auth("sanctum")->id()) {
                $validator->errors()->add('title', 'You are not authorized to control this course.');
            }
        });
    }
}
