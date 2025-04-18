@extends('layouts.app')

@section('title', 'لیست سفارشات')

@section('content')
    <div class="max-w-5xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">سفارشات من</h2>

        <div x-data="{ openOrder: null }" class="space-y-4">
            @forelse ($orders as $order)
                <div class="bg-white p-4 shadow rounded-2xl border">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="font-semibold">Order #{{ $order->id }}</div>
                            <div class="text-gray-500 text-sm">Total: ${{ $order->total_price }}</div>
                            <div class="text-sm mt-1">
                                Status:
                                <span class="px-2 py-1 text-white text-xs rounded
                                    {{ $order->status === 'completed' ? 'bg-green-500' : ($order->status === 'cancelled' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <button
                            class="text-blue-600 hover:underline text-sm"
                            @click="openOrder === {{ $order->id }} ? openOrder = null : openOrder = {{ $order->id }}"
                        >
                            Details
                        </button>
                    </div>

                    <div x-show="openOrder === {{ $order->id }}" x-collapse class="mt-3 text-sm text-gray-700">
                        <h4 class="font-medium mb-2">Items:</h4>
                        <ul class="space-y-1">
                            @foreach ($order->items as $item)
                                <li class="flex justify-between">
                                    <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                    <span>${{ $item->price }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <div class="text-gray-600">شما هنوز هیچ سفارشی ثبت نکرده اید.</div>
            @endforelse
        </div>
    </div>
@endsection
