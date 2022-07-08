<?php

namespace App\Imports;

use App\Models\StockPrice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StockPricesImport implements ToModel, WithHeadingRow, WithBatchInserts ,WithChunkReading, ShouldQueue
{
    use Importable;
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $date = $this->getDate($row['date']);
        
        return new StockPrice([
            'date'       => $date->format("Y-m-d"),
            'price'      => $row['stock_price']
        ]);
    }

    public function headingRow(): int
    {
        return 9;
    }

    public function getDate($value)
    {
        return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
