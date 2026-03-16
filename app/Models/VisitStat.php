<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitStat extends Model
{
    use HasFactory;

     protected $fillable = ['home_visits'];
}
