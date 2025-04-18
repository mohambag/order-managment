@extends('layouts.app')

@section('title', 'ویرایش محصول')

@section('content')
    <h1 class="text-xl font-bold mb-4">ویرایش محصول: {{ $product->name }}</h1>

    <form action="{{ route('products.update', $product) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">نام محصول:</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">قیمت:</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">موجودی:</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ذخیره تغییرات
            </button>
            <a href="{{ route('products.index') }}" class="text-blue-600 ml-4">بازگشت</a>
        </div>
    </form>
@endsection
