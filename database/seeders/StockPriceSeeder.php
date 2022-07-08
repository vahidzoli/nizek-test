<?php

namespace Database\Seeders;

use App\Models\StockPrice;
use Illuminate\Database\Seeder;

class StockPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockPrice::factory()->create();
    }
}
