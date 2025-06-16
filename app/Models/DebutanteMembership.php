<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebutanteMembership extends Model
{
    use HasFactory;
    protected $table = "debutante_memberships";

    public function membershipInfo()
    {
        return $this->hasMany(DebutanteMembershipInfo::class);
    }
}
