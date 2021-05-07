<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Matches;

class MatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    static public function run()
    {
        DB::table('matches')->truncate();
        $files = Storage::allFiles('MatchesDump');
        foreach($files as $file)
        {
            if ( substr($file, -4) === 'json' )
            {
                $data = json_decode(Storage::get($file));
                foreach($data as $row)
                {
                    //Data's date has form DD/MM/YYYY or DD/MM/YY - convert to mySQL standard YYYY-MM-DD instead 
                    $convert = explode("/", $row->Date);
                    $convert = array_reverse($convert);
                    if(strlen($convert[0]) == 4)
                    {
                        $row->Date = implode("-", $convert);
                    }
                    else
                    {
                        $len = strlen($convert[0]);
                        $row->Date = "20".implode("-", $convert);
                    }
                    Matches::create(
                        array(
                        'Date' => $row->Date,
                        'HomeTeam' => $row->HomeTeam,
                        'AwayTeam' => $row->AwayTeam,
                        'FTHG' => $row->FTHG,
                        'FTAG' => $row->FTAG,
                        'FTR' => $row->FTR,
                        'HTHG' => $row->HTHG,
                        'HTAG' => $row->HTAG,
                        'HTR' => $row->HTR,
                        'Referee' => $row->Referee,
                        'HS' => $row->HS,
                        'AS' => $row->AS,
                        'HST' => $row->HST,
                        'AST' => $row->AST,
                        'HF' => $row->HF,
                        'AF' => $row->AF,
                        'HC' => $row->HC,
                        'AC' => $row->AC,
                        'HY' => $row->HY,
                        'AY' => $row->AY,
                        'HR' => $row->HR,
                        'AR' => $row->AR,
                    ));
                }
            }    
        }
    }
}
