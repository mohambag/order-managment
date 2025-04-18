<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        dd($this->repo->all());
        return $this->repo->all();
    }

    public function getById($id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(Product $product, array $data)
    {
        return $this->repo->update($product, $data);
    }

    public function destroy(Product $product)
    {
        return $this->repo->delete($product);
    }

    public function allCached()
    {
        return Cache::remember('products_list', 3600, function () {
            $products = Product::all();
            return $products;
        });
    }
}
