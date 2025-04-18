<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearProductCache extends Command
{
    protected $signature = 'cache:clear-products';
    protected $description = 'Clear the cached product list';

    public function handle()
    {
        Cache::forget('products_list');
        $this->info('Product list cache cleared successfully.');
    }
}
