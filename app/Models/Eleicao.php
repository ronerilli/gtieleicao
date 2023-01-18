<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Eleicao extends Model
{
    protected $table = 'eleicoes';
    protected $fillable = ['nome', 'orgao', 'chapas','user_id'];
}
