<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;

class BaseService
{
    protected BaseRepository $repository;
    protected string $repositoryClass;

    public function __construct()
    {
        $this->repository = new $this->repositoryClass;
    }

    public function paginate()
    {
        return $this->repository->paginate();
    }

    public function findOne(int $id)
    {
        return $this->repository->findOne($id);
    }

    public function create(Request $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(Request $request, int $id)
    {
        return $this->repository->update($id, $request->all());
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}