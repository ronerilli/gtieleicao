<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votacao extends Model
{
    protected $fillable = ['eleicao_id', 'chapa_id', 'created_at'];
}