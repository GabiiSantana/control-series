<?php

namespace App\Models;

// Factory utilizada para gerar usuários fictícios
use Database\Factories\UserFactory;

// Attributes do Eloquent
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Campos liberados para preenchimento em massa
#[Fillable(['name', 'email', 'password'])]

// Campos ocultos ao converter para array ou JSON
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable {

    // HasFactory: permite gerar usuários fictícios
    // Notifiable: permite enviar notificações
    use HasApiTokens, HasFactory, Notifiable;

    // Converte atributos automaticamente
    protected function casts(): array {
        return [

            // Converte para objeto DateTime/Carbon
            'email_verified_at' => 'datetime',

            // Faz hash automático da senha
            'password' => 'hashed',
        ];
    }
}