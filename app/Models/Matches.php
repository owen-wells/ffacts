<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'Date',
        'HomeTeam',
        'AwayTeam',
        'FTHG',
        'FTAG',
        'FTR',
        'HTHG',
        'HTAG',
        'HTR',
        'Referee',
        'HS',
        'AS',
        'HST',
        'AST',
        'HF',
        'AF',
        'HC',
        'AC',
        'HY',
        'AY',
        'HR',
        'AR',
    ];

}
