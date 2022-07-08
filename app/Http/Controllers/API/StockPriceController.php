<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\DurationRequest;
use App\Http\Requests\API\ExcelRequest;
use App\Repositories\StockPriceRepositoryInterface;
use Illuminate\Http\Response;

class StockPriceController extends Controller
{
    private $stockPriceRepository;

    public function __construct(StockPriceRepositoryInterface $stockPrice)
    {
        $this->stockPriceRepository = $stockPrice;
    }

    /**
     * Upload excel of the resource.
     *
     * @param  ExcelRequest  $request
     * @return json
     */
    public function uploadExcel(ExcelRequest $request)
    {
        $this->stockPriceRepository->uploadExcel($request);

        return response()->json(['message' => 'File Imported Successfully'], Response::HTTP_OK);
    }

    /**
     * Show the stock prices change in 1D, 1M, 3M,...
     *
     * @return json
     */
    public function showChanges()
    {
        $result = $this->stockPriceRepository->showChanges();

        return response()->json(['data' => $result], Response::HTTP_OK);
    }

    /**
     * Show the stock prices change in the specified duration.
     *
     * @param  DurationRequest  $request
     * @return json
     */
    public function showChangesInSpecificDuration(DurationRequest $request)
    {
        $result = $this->stockPriceRepository->showChangesInSpecificDuration($request);
        
        return response()->json(['data' => $result], Response::HTTP_OK);
    }
}
