<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bateria extends Model
{
    use HasFactory;
    protected $table = "baterias";
    protected $fillable = ["surfista1", "surfista2"];

    public function surfistas()
    {
        return $this->belongsToMany(Surfista::class);
    }

    public function ondas()
    {
        return $this->hasMany(Onda::class);
    }
}
