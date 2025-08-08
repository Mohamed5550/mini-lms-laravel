<?php

namespace App\Enums;

enum Role: string
{
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case ADMIN = 'admin';

    public function getLabel(): ?string
    {
        return match($this)
        {
            self::STUDENT => __("Student"),
            self::TEACHER => __("Teacher"),
            self::ADMIN => __("Admin"),
        };
    }
}