<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    use HasFactory;
    public function pilot_owner()
    {
        return $this->belongsTo(Team::class);
    }
    protected $with=['pilot_owner'];
}
