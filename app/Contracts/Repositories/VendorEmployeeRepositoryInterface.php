<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface VendorEmployeeRepositoryInterface
{
    public function add(array $data): string|object;

    public function getFirstWhere(array $params, array $relations = []): ?Model;

    public function getList(
        array      $orderBy = [],
        array      $relations = [],
        int|string $dataLimit = DEFAULT_DATA_LIMIT,
        int        $offset = null
    ): Collection|LengthAwarePaginator;

    public function getListWhere(
        array      $orderBy = [],
        string     $searchValue = null,
        array      $filters = [],
        array      $relations = [],
        int|string $dataLimit = DEFAULT_DATA_LIMIT,
        int        $offset = null
    ): Collection|LengthAwarePaginator;

    public function update(string|int $id, array $data): bool;

    public function delete(array $params): bool;
}
