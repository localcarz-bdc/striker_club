<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['category','title','message','member_call_back_url','user_id','admin_is_read','admin_call_back_url','member_is_read'];
}
