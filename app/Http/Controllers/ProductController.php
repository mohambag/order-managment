<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service)
    {
//        $this->authorizeResource(Product::class, 'product');
    }

    public function index()
    {
        $products = $this->service->getAll();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $this->service->store($data);
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $this->service->update($product, $data);
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $this->service->destroy($product);
        return redirect()->route('products.index');
    }
}
