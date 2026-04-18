<?php

namespace App\Services;

use App\Models\Store;
use App\Repositories\StoreRepository;
use App\Http\Requests\StoreStoreRequest;

class StoreService
{
    protected StoreRepository $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function getAllStores()
    {
        return $this->storeRepository->all();
    }

    public function createStore(StoreStoreRequest $request): Store
    {
        $validatedData = $request->validated();
        return $this->storeRepository->create($validatedData);
    }

    public function updateStore(Store $store, StoreStoreRequest $request): Store
    {
        $validatedData = $request->validated();
        return $this->storeRepository->update($store, $validatedData);
    }

    public function deleteStore(Store $store): bool
    {
        return $this->storeRepository->delete($store);
    }

    public function findById(int $id): ?Store
    {
        return $this->storeRepository->findById($id);
    }
}
