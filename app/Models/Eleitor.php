<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eleitor extends Model
{
    protected $table = 'eleitores';
    protected $fillable = [
        'nome', 'matricula', 'telefone', 'eleicao_id'
    ];

    public function eleicao()
    {
        return $this->belongsTo(Eleicao::class);
    }
}
