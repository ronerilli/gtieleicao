<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Eleicao extends Model
{
    protected $table = 'eleicoes';
    protected $fillable = ['nome', 'orgao','data_hora_inicio', 'data_hora_fim','chapas','user_id'];

    protected $casts = ['data_hora_inicio' => 'datetime','data_hora_fim' => 'datetime'];

    public function eleitores()
    {
         return $this->hasMany(Eleitor::class);
    }
    public function chapas()
    {
         return $this->hasMany(Chapa::class);
    }
}
