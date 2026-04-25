<?php

namespace App\Repositories;

use App\Contracts\Repositories\VendorRoleRepositoryInterface;
use App\Models\VendorRole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class VendorRoleRepository implements VendorRoleRepositoryInterface
{
    public function __construct(
        private readonly VendorRole $vendorRole,
    ) {}

    public function add(array $data): string|object
    {
        return $this->vendorRole->create($data);
    }

    public function getFirstWhere(array $params, array $relations = []): ?Model
    {
        return $this->vendorRole->with($relations)->where($params)->first();
    }

    public function getList(
        array      $orderBy = [],
        array      $relations = [],
        int|string $dataLimit = DEFAULT_DATA_LIMIT,
        int        $offset = null
    ): Collection|LengthAwarePaginator {
        $query = $this->vendorRole->with($relations)
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
        $query = $this->vendorRole->with($relations)
            ->when(!empty($orderBy), fn($q) => $q->orderBy(array_key_first($orderBy), array_values($orderBy)[0]))
            ->when($searchValue, fn($q) => $q->where('name', 'like', "%$searchValue%"))
            ->when(isset($filters['vendor_id']), fn($q) => $q->where('vendor_id', $filters['vendor_id']))
            ->when(isset($filters['status']), fn($q) => $q->where('status', $filters['status']));

        $filters += ['searchValue' => $searchValue];
        return $dataLimit === 'all' ? $query->get() : $query->paginate($dataLimit)->appends($filters);
    }

    public function getVendorRoleList(
        int        $vendorId,
        array      $orderBy = [],
        string     $searchValue = null,
        int|string $dataLimit = DEFAULT_DATA_LIMIT,
        int        $offset = null
    ): Collection|LengthAwarePaginator {
        $query = $this->vendorRole
            ->where('vendor_id', $vendorId)
            ->when(!empty($orderBy), fn($q) => $q->orderBy(array_key_first($orderBy), array_values($orderBy)[0]))
            ->when($searchValue, fn($q) => $q->where('name', 'like', "%$searchValue%"));

        return $dataLimit === 'all' ? $query->get() : $query->paginate($dataLimit)->appends(['searchValue' => $searchValue]);
    }

    public function update(string|int $id, array $data): bool
    {
        return $this->vendorRole->where('id', $id)->update($data);
    }

    public function delete(array $params): bool
    {
        $this->vendorRole->where($params)->delete();
        return true;
    }
}
