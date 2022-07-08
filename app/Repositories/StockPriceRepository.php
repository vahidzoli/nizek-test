<?php

namespace App\Repositories;

use App\Imports\StockPricesImport;
use App\Models\StockPrice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class StockPriceRepository implements StockPriceRepositoryInterface
{
    protected $stockModel;

    public function __construct(StockPrice $stock)
    {
        $this->stockModel = $stock;
    }

    public function uploadExcel($request)
    {
        return (new StockPricesImport)->queue($request->file('file'));
    }

    public function showChanges()
    {
        if(Cache::has('show-changes')){
            $result = Cache::get('show-changes');
        } else {
            $start = StockPrice::first();
            $dates = config('dates');
            $result = [];

            foreach($dates as $date){
                $end_date = $this->getDateOptions($date, $start);

                $end = StockPrice::whereDate('date', '>=', $end_date)
                    ->orderby('id', 'desc')
                    ->first();

                $result[$date] = $this->formula($start, $end);
            }

            Cache::put('show-changes', $result, 60);
        }

        return $result;
    }

    public function showChangesInSpecificDuration($request)
    {
        $data = StockPrice::whereBetween('date', [$request->get('end_date'), $request->get('start_date')])->get();

        $result['change'] = $this->formula($data[0], $data[count($data) - 1]);

        return $result;
    }

    public function getDateOptions($date, $start)
    {
        switch($date){
            case '1D':
                $end_date = Carbon::parse($start->date)->subDay(1)->format('Y-m-d');
                break;
            case '1M':  
                $end_date = Carbon::parse($start->date)->subMonth(1)->format('Y-m-d');
                break;
            case '3M':  
                $end_date = Carbon::parse($start->date)->subMonth(3)->format('Y-m-d');
                break;
            case '6M':  
                $end_date = Carbon::parse($start->date)->subMonth(6)->format('Y-m-d');
                break;          
            case 'YTD':  
                $end_date = Carbon::parse($start->date)->firstOfYear()->format('Y-m-d');
                break;
            case '1Y':  
                $end_date = Carbon::parse($start->date)->subYear(1)->format('Y-m-d');
                break;    
            case '3Y':  
                $end_date = Carbon::parse($start->date)->subYear(3)->format('Y-m-d');
                break;    
            case '5Y':  
                $end_date = Carbon::parse($start->date)->subYear(5)->format('Y-m-d');
                break;    
            case '10Y':  
                $end_date = Carbon::parse($start->date)->subYear(10)->format('Y-m-d');
                break;
            case 'MAX':  
                $last = StockPrice::latest('id')->first();
                $end_date = Carbon::parse($last->date)->format('Y-m-d');
                break;    
            default:
                $end_date = Carbon::parse($start->date)->subDay(1)->format('Y-m-d');
                break;
        }

        return $end_date;
    }

    public function formula($start, $end)
    {
        $diff = (($start->price / $end->price) - 1) * 100;
        
        return number_format($diff, 2). '%';

    }
}