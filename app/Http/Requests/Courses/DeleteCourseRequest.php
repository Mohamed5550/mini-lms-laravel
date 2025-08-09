<?php

namespace App\Http\Requests\Courses;

use App\Enums\Role;
use App\Repositories\CourseRepository;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth("sanctum")->check() && auth("sanctum")->user()->role == Role::TEACHER;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
        ];
    }

    public function withValidator($validator)
    {
        $id = $this->route('course');
        $course = CourseRepository::findOne($id);
        // check if the course has linked sessions with students
        $validator->after(function ($validator) use ($course){
            if (CourseRepository::hasSessionsWithStudents($course)) {
                $validator->errors()->add('course', 'This courase cannot be deleted');
            }
        });
        // check if the course belongs to the authenticated teacher
        $validator->after(function ($validator) use ($course) {
            if ($course->teacher_id !== auth("sanctum")->id()) {
                $validator->errors()->add('title', 'You are not authorized to delete this course.');
            }
        });
    }
}
