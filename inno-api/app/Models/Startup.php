<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Startup extends Model
{
    use HasFactory;
    use Searchable;

    public function pilots()
    {
        return $this->hasMany(Pilot::class);
    }

    public function transport_type()
    {
        return $this->belongsTo(Transport_type::class);
    }

    public function cert_type()
    {
        return $this->belongsTo(Cert_type::class);
    }

    public function project_stage()
    {
        return $this->belongsTo(Project_stage::class);
    }
    public function leader()
    {
        return $this->belongsTo(Team_member::class);
    }
    public function directions()
    {
        return $this->belongsToMany(Direction::class,'startups_directions');
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    protected $with = ['directions','leader','project_stage','cert_type','transport_type','pilots','team'];
}
