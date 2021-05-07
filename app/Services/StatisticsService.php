<?php

namespace App\Services;
use App\Models\Matches;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    public static function getStatistics($team)
    {
        //Verify that $team is in fact in table before running team in DB::raw
        $lastPlayed = Matches::select('Date')
            ->where("HomeTeam" ,"=" , $team)
            ->orWhere("AwayTeam", "=", $team) 
            ->orderByDesc("Date")
            ->first();

        if(!$lastPlayed){
            return;
        }

        $homeResults = Matches::select('FTR', DB::raw('COUNT(FTR) as count'))
            ->where("HomeTeam" ,"=" , $team)
            ->groupBy('FTR')
            ->get();

        $awayResults = Matches::select('FTR', DB::raw('COUNT(FTR) as count'))
            ->where("AwayTeam" ,"=" , $team)
            ->groupBy('FTR')
            ->get();

        $headToHead = Matches::select(
                DB::raw(
                    "CASE
                    WHEN HomeTeam = '$team' THEN AwayTeam
                    ELSE HomeTeam
                    END AS team"
                ),
                DB::raw(
                    "COUNT(CASE WHEN HomeTeam = '$team' AND FTR = 'H'
                    OR AwayTeam = '$team' AND FTR = 'A' THEN 1
                    ELSE NULL END) AS W"
                ),
                DB::raw(
                    "COUNT(CASE WHEN FTR = 'D' THEN 1 ELSE NULL END) AS D"
                ),
                DB::raw(
                    "COUNT(CASE WHEN HomeTeam = '$team' AND FTR = 'A'
                    OR AwayTeam = '$team' AND FTR = 'H' THEN 1
                    ELSE NULL END) AS L"
                ),
            )
            ->where("HomeTeam", "=", $team)
            ->orWhere("AwayTeam", "=", $team)
            ->groupBy("team")
            ->get();

        $results = array();
        $results["lastPlayed"] = $lastPlayed;
        $results["homeResults"] = $homeResults;
        $results["awayResults"] = $awayResults;
        $results["headToHead"] = $headToHead;
        return $results;
    }
}
