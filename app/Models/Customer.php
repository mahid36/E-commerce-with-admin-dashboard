<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
        use HasFactory, Notifiable;

        protected $guard = 'customer';
        protected $guarded = ['id'];

        protected $hidden = [
            'password',
            'remember_token',
        ];

        protected function casts(): array
        {
            return[
                'email_verification_at'=>'datetime',
                'password'=>'hashed',
            ];
        }
}
