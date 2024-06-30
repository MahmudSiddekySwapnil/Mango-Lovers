<?php

namespace App\Models\LandingModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'order_items';
    public $timestamps = true;
    use HasFactory;
}
