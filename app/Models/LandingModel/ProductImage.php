<?php

namespace App\Models\LandingModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_image';
    public $timestamps = true;
    use HasFactory;
}
