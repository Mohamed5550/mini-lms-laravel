<?php

use App\Enums\Role;
use App\Models\User;

test("students can't create courses", function () {
    $student = User::factory()->create(['role' => Role::STUDENT]);

    $response = $this->apiActingAs($student)->postJson('/api/courses', [
        'title' => 'Test Course',
        'description' => 'This is a test course description.'
    ]);

    $response->assertStatus(403);
});

test("teachers can create courses with sessions", function () {
    $teacher = User::factory()->create(['role' => Role::TEACHER]);

    $response = $this->apiActingAs($teacher)->postJson('/api/courses', [
        'title' => 'Test Course',
        'description' => 'This is a test course description.',
        'sessions' => [
            [
                'title' => 'Session 1',
                'scheduled_at' => now()->addDays(1)->format('Y-m-d H:i:s'),
                'duration_minutes' => 120
            ],
        ]
    ]);

    $response->assertStatus(201)
             ->assertJsonFragment(['title' => 'Test Course']);
});

test("teachers can't create courses without sessions", function () {
    $teacher = User::factory()->create(['role' => Role::TEACHER]);

    $response = $this->apiActingAs($teacher)->postJson('/api/courses', [
        'title' => 'Course without sessions',
        'description' => 'Only course data, no sessions'
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['sessions']);
});

test("guest users cannot create courses", function () {
    $response = $this->postJson('/api/courses', [
        'title' => 'Guest Attempt',
        'description' => 'This should fail'
    ]);

    $response->assertStatus(401);
});

test("course creation fails if title is missing", function () {
    $teacher = User::factory()->create(['role' => Role::TEACHER]);

    $response = $this->apiActingAs($teacher)->postJson('/api/courses', [
        'description' => 'Missing title test'
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['title']);
});

test("course creation fails if description is missing", function () {
    $teacher = User::factory()->create(['role' => Role::TEACHER]);

    $response = $this->apiActingAs($teacher)->postJson('/api/courses', [
        'title' => 'Missing Description Course'
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['description']);
});

test("course creation fails if session date is in the past", function () {
    $teacher = User::factory()->create(['role' => Role::TEACHER]);

    $response = $this->apiActingAs($teacher)->postJson('/api/courses', [
        'title' => 'Course with past session',
        'description' => 'Test invalid session date',
        'sessions' => [
            [
                'title' => 'Old Session',
                'scheduled_at' => now()->subDay()->format('Y-m-d H:i:s'),
                'duration_minutes' => 60
            ],
        ]
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['sessions.0.scheduled_at']);
});

test("course creation fails if session duration is missing", function () {
    $teacher = User::factory()->create(['role' => Role::TEACHER]);

    $response = $this->apiActingAs($teacher)->postJson('/api/courses', [
        'title' => 'Course with invalid session',
        'description' => 'Missing duration in session',
        'sessions' => [
            [
                'title' => 'Incomplete Session',
                'scheduled_at' => now()->addDays(2)->format('Y-m-d H:i:s'),
            ],
        ]
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['sessions.0.duration_minutes']);
});
