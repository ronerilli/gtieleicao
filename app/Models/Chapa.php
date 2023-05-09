<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapa extends Model
{
    use HasFactory;
    protected $table = 'chapas';
    protected $fillable = [
        'nome',
        'votos',
        'eleicao_id'
    ];

    public function eleicao()
    {
        return $this->belongsTo(Eleicao::class);
    }
}
