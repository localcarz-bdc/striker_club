<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TmpInvoice extends Model
{
    use HasFactory;
    protected $table='tmp_invoices';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
