<?php

namespace App\Services;
use App\Models\Matches;


class DashboardService
{
	protected $matches; 

	public static function getTeams()
	{
        return Matches::select('HomeTeam')
                        ->groupBy('HomeTeam')
                        ->get();
	}
}
