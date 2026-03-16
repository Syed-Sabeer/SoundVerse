<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSection extends Model
{
    protected $table = 'work_sections';

    protected $fillable = [
        'heading',
        'description',
        'deposit_email',
    ];
}
