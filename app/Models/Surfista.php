<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surfista extends Model
{
    use HasFactory;
    protected $table = "surfistas";
    protected $fillable = ["nome", "pais"];

    public function baterias()
    {
        return $this->belongsToMany(Bateria::class);
    }

    public function ondas()
    {
        return $this->hasMany(Onda::class);
    }
}
