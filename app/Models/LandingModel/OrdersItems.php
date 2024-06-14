<?php

namespace App\Models\LandingModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersItems extends Model
{
    protected $table = 'OrderItems';
    public $timestamps = true;
    use HasFactory;
}
