<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'country',
        'state',
        'city',
        'district',
        'address_line1',
        'address_line2',
        'postal_code',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
