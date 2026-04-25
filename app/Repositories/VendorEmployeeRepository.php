<?php

namespace App\Repositories;

use App\Contracts\Repositories\VendorEmployeeRepositoryInterface;
use App\Models\VendorEmployee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class VendorEmployeeRepository implements VendorEmployeeRepositoryInterface
{
    public function __construct(
        private readonly VendorEmployee $vendorEmployee,
    ) {}

    public function add(array $data): string|object
    {
        return $this->vendorEmployee->create($data);
    }

    public function getFirstWhere(array $params, array $relations = []): ?Model
    {
        return $this->vendorEmployee->with($relations)->where($params)->first();
    }

    public function getList(
        array      $orderBy = [],
        array      $relations = [],
        int|string $dataLimit = DEFAULT_DATA_LIMIT,
        int        $offset = null
    ): Collection|LengthAwarePaginator {
        $query = $this->vendorEmployee->with($relations)
            ->when(!empty($orderBy), fn($q) => $q->orderBy(array_key_first($orderBy), array_values($orderBy)[0]));

        return $dataLimit === 'all' ? $query->get() : $query->paginate($dataLimit);
    }

    public function getListWhere(
        array      $orderBy = [],
        string     $searchValue = null,
        array      $filters = [],
        array      $relations = [],
        int|string $dataLimit = DEFAULT_DATA_LIMIT,
        int        $offset = null
    ): Collection|LengthAwarePaginator {
        $query = $this->vendorEmployee->with($relations)
            ->when(!empty($orderBy), fn($q) => $q->orderBy(array_key_first($orderBy), array_values($orderBy)[0]))
            ->when(isset($filters['vendor_id']), fn($q) => $q->where('vendor_id', $filters['vendor_id']))
            ->when(isset($filters['vendor_role_id']) && $filters['vendor_role_id'] !== 'all',
                fn($q) => $q->where('vendor_role_id', $filters['vendor_role_id']))
            ->when($searchValue, fn($q) => $q->where(function ($q) use ($searchValue) {
                $q->where('name', 'like', "%$searchValue%")
                    ->orWhere('email', 'like', "%$searchValue%")
                    ->orWhere('phone', 'like', "%$searchValue%");
            }));

        $filters += ['searchValue' => $searchValue];
        return $dataLimit === 'all' ? $query->get() : $query->paginate($dataLimit)->appends($filters);
    }

    public function update(string|int $id, array $data): bool
    {
        return $this->vendorEmployee->where('id', $id)->update($data);
    }

    public function delete(array $params): bool
    {
        $this->vendorEmployee->where($params)->delete();
        return true;
    }
}
