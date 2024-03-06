<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $table = "notas";
    protected $fillable = ["onda_id", "notaParcial1", "notaParcial2", "notaParcial3",];

    public function onda()
    {
        return $this->belongsTo(Onda::class);
    }
}
