<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
class Users extends Model implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Notifiable, Authenticatable;

    protected $table = 'Users';
    public $timestamps = true;
    use HasFactory;
}
