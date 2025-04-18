@extends('layouts.app')

@section('title', 'لیست محصولات')

@section('content')
    <h1 class="text-xl font-bold mb-4">لیست محصولات</h1>

    <div x-data="productList()" class="bg-white p-6 rounded shadow">
        <div class="mb-4 flex items-center justify-between">
            <input
                type="text"
                x-model="search"
                placeholder="جستجو بر اساس نام محصول..."
                class="border p-2 rounded w-1/2"
            >
            <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                افزودن محصول
            </a>
        </div>

        <table class="w-full table-auto border">
            <thead>
            <tr class="bg-gray-200">
                <th class="p-2">نام</th>
                <th class="p-2">قیمت</th>
                <th class="p-2">موجودی</th>
                <th class="p-2">عملیات</th>
            </tr>
            </thead>
            <tbody>
            <template x-for="product in filteredProducts" :key="product.id">
                <tr class="border-t">
                    <td class="p-2" x-text="product.name"></td>
                    <td class="p-2" x-text="product.price"></td>
                    <td class="p-2" x-text="product.stock"></td>
                    <td class="p-2">
                        <a :href="`/products/${product.id}/edit`" class="text-blue-600 hover:underline">ویرایش</a>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>

    <script>
        function productList() {
            return {
                search: '',
                products: @json($products),
                get filteredProducts() {
                    if (!this.search) return this.products;
                    return this.products.filter(p =>
                        p.name.toLowerCase().includes(this.search.toLowerCase())
                    );
                }
            }
        }
    </script>
@endsection
