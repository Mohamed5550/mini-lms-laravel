<?php

namespace App\Http\Requests\Courses;

use App\Enums\Role;
use App\Repositories\CourseRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends BaseCourseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth("sanctum")->user()->role == Role::TEACHER;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000'
        ];
    }

    public function withValidator($validator)
    {
        $id = $this->route('course');
        $course = CourseRepository::findOne($id);
        $this->assertCourseBelongsToAuthenticatedTeacher($validator, $course);
    }
}
