<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\BaseRepository;
use App\Repositories\CourseRepository;
use DB;

class CourseService extends BaseService
{
    protected string $repositoryClass = CourseRepository::class;

    public function create($request)
    {
        $data = $request->validated();
        $data['teacher_id'] = auth("sanctum")->id();
        DB::beginTransaction();
        try {
            $course = $this->repository->create($data);
            $this->repository->createSessions($course, $request->validated('sessions', []));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $course;
    }
}