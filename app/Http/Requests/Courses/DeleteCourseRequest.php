<?php

namespace App\Http\Requests\Courses;

use App\Enums\Role;
use App\Repositories\CourseRepository;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCourseRequest extends BaseCourseRequest
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
            
        ];
    }

    public function withValidator($validator)
    {
        $id = $this->route('course');
        $course = CourseRepository::findOne($id);
        $this->assertCourseNotBooked($validator, $course);
        $this->assertCourseBelongsToAuthenticatedTeacher($validator, $course);
    }

    private function assertCourseNotBooked($validator, $course)
    {
        $validator->after(function ($validator) use ($course){
            if (CourseRepository::hasStudents($course)) {
                $validator->errors()->add('course', 'This course cannot be deleted');
            }
        });
    }
}
