<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = [
        'nome_completo',
        'biografia',
        'foto',
        'chapa_id',
        'eleicao_id',
        'votos_recebidos',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

}
