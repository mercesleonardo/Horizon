<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onda extends Model
{
    use HasFactory;
    protected $table = "ondas";
    protected $fillable = ["surfista_id", "bateria_id"];

    public function surfista()
    {
        return $this->belongsTo(Surfista::class, 'surfista_id');
    }

    public function baterias()
    {
        return $this->belongsTo(Bateria::class, 'bateria_id');
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
