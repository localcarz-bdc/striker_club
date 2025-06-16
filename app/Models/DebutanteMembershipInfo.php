<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DebutanteMembershipInfo extends Model
{
    use HasFactory;
    protected $table = 'debutante_membership_info';

    public function membership()
    {
        return $this->belongsTo(DebutanteMembership::class);
    }
}
