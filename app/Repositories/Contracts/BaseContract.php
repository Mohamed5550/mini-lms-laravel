<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseContract
{
    public static function findOne($id): Model;
    public function getAlll(): Collection;
    public function paginate(): LengthAwarePaginator;
    public function delete($id);
    public function create($data): Model;
    public function update($id, $data): Model;
}