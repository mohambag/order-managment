<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    protected $repo;
    protected string $cacheKey = 'products_list';

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->all();
    }

    public function getById($id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        $product = $this->repo->create($data);
        $this->forgetCache();
        return $product;
    }

    public function update(Product $product, array $data)
    {
        $this->repo->update($product, $data);
        $this->forgetCache();
        return $product;
    }

    public function destroy(Product $product)
    {
        $this->repo->delete($product);
        $this->forgetCache();
        return true;
    }

    public function allCached()
    {
        return Cache::remember($this->cacheKey, now()->addMinutes(60), function () {
            return $this->repo->all();
        });
    }

    protected function forgetCache()
    {
        Cache::forget($this->cacheKey);
    }
}
