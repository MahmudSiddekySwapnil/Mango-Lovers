<?php

namespace App\Models\LandingModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'Categories';
    protected $primaryKey = 'CategoryID';
    public $timestamps = true;
    use HasFactory;
}
