@extends('layouts.app')

@section('title', 'افزودن محصول جدید')

@section('content')
    <h1 class="text-xl font-bold mb-4">افزودن محصول جدید</h1>

    <form action="{{ route('products.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">نام محصول:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">قیمت:</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">موجودی:</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                ذخیره محصول
            </button>
            <a href="{{ route('products.index') }}" class="text-blue-600 ml-4">بازگشت</a>
        </div>
    </form>
@endsection
