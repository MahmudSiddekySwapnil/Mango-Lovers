<?php

namespace App\Models\LandingModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $table = 'Carts';
    public $timestamps = true;
    use HasFactory;
}
