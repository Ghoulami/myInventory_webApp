<?php

use Illuminate\Database\Seeder;
use App\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Stock::class, 1)->create();
    }
}
