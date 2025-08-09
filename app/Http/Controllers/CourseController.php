<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Http\Requests\Courses\CourseRequest;
use App\Http\Resources\Courses\CourseResource;
use App\Http\Requests\Courses\CreateCourseRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;
use App\Http\Resources\Courses\CourseListResource;

class CourseController extends Controller
{
    protected ?string $serviceClass = CourseService::class;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CourseListResource::collection($this->service->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCourseRequest $request)
    {
        $course = $this->service->create($request);
        return response()->json([
            "message" => __("Course created successfully"),
            "data" => new CourseResource($course)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => new CourseResource($this->service->findOne($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, string $id)
    {
        $course = $this->service->update($request, $id);
        return response()->json([
            "message" => __("Course updated successfully"),
            "data" => new CourseResource($course)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);
        return response()->json([
            "message" => __("Course deleted successfully")
        ]);
    }
}
