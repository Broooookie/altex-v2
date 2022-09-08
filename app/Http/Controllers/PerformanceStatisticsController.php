<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerformanceStatistics\IndexPerformanceStatisticsRequest;
use App\SalesPerformance;
use Illuminate\Http\Request;

class PerformanceStatisticsController extends Controller
{
    //
    public function index(IndexPerformanceStatisticsRequest $request)
    {
        $statistics =  SalesPerformance::with('client')->get();
    }
}
