<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function placeOrder(array $items, $userId): Order
    {
        return DB::transaction(function () use ($items, $userId) {
            $total = 0;

            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }
                $total += $product->price * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => $userId,
                'status' => 'pending',
                'total_price' => $total,
            ]);

            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $product->decrement('stock', $item['quantity']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);
            }

            return $order;
        });
    }
}
