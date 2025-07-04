<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    use HasFactory;
    protected $table = 'hero_sliders';
    protected $fillable = ['title','details','image','is_read','status'];
}
