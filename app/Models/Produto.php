<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'foto', 'valor', 'categoria_id', 'quantidade'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}

