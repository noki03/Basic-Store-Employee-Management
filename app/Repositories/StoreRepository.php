<?php

namespace App\Repositories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Collection;

class StoreRepository
{
    public function all(): Collection
    {
        return Store::withCount('employees')->get();
    }

    public function create(array $data): Store
    {
        return Store::create($data);
    }

    public function update(Store $store, array $data): Store
    {
        $store->update($data);
        return $store;
    }

    public function delete(Store $store): bool
    {
        return $store->delete();
    }

    public function findById(int $id): ?Store
    {
        return Store::find($id);
    }
}
