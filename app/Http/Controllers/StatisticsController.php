<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StatisticsService;

class StatisticsController extends Controller
{
    public function getStatistics(Request $request){
        return StatisticsService::getStatistics($request->input("teamName"));
    }
}
