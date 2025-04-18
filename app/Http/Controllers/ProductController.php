<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ProductController extends Controller
{

    use AuthorizesRequests;

    public function __construct(protected ProductService $productService)

    {
        $this->authorizeResource(Product::class, 'product');
    }

    public function index()
    {
        $products = $this->productService->allCached();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreOrUpdateProductRequest $request)
    {
        $data = $request->validated();
        $this->productService->store($data);
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(StoreOrUpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $this->productService->update($product, $data);
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $this->productService->destroy($product);
        return redirect()->route('products.index');
    }
}
