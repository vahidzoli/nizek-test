<?php

namespace App\Repositories;

Interface StockPriceRepositoryInterface
{
    public function uploadExcel($request);

    public function showChanges();

    public function showChangesInSpecificDuration($request);
}