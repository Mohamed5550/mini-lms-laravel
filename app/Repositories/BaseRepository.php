<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseContract
{
    protected static string $modelClass;

    public static function findOne($id): Model
    {
        return static::$modelClass::find($id);
    }

    public function getAlll(): Collection
    {
        return $this->modelClass::get();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->modelClass::paginate();
    }

    public function delete($id)
    {
        $model = $this->findOne($id);
        $model?->delete();
    }

    public function create($data): Model
    {
        return $this->modelClass::create($data);
    }

    public function update($id, $data): Model
    {
        $model = $this->findOne($id);
        $model?->update($data);
        return $model;
    }

    public function updateModel($model, $data): Model
    {
        return $model->update($data);
    }
}