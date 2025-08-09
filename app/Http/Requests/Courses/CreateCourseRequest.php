<?php

namespace App\Http\Requests\Courses;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'sessions' => 'required|array|min:1',
            'sessions.*.title' => 'required|string|max:255',
            'sessions.*.scheduled_at' => 'required|date_format:Y-m-d H:i:s|after:now',
            'sessions.*.duration_minutes' => 'required|integer|min:1',
        ];
    }
}
