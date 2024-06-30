<?php

namespace App\Models\LandingModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'Products';
    public $timestamps = true;
    use HasFactory;

}
