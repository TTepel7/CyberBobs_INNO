<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team_member extends Model
{
    private function anonymize($str)
    {
        return substr_replace(substr_replace($str, '****', 0, 4), '****', -4);
    }

    use HasFactory;

    public function getPhoneAttribute($value)
    {
        return $this->anonymize($this->attributes['phone']);
    }

    public function getLastNameAttribute($value)
    {
        return $this->anonymize($this->attributes['last_name']);
    }

    public function getEmailAttribute($value)
    {
        return $this->anonymize($this->attributes['email']);
    }
}
