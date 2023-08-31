<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'matricula', 
        'telefone', 
        'password', 
        'profile', 
        'eleicao_id',
        'votou'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function eleicao()
    {
        return $this->belongsTo(Eleicao::class);
    }
}
