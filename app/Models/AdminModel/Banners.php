<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    protected $table = 'Banners';
    protected $primaryKey = 'BannerID';
    public $timestamps = true;
    use HasFactory;
}
