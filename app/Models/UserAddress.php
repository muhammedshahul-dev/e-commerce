<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    protected $fillable = [
        'user_id',
        'country',
        'state',
        'city',
        'address_line1',
        'address_line2',
        'postal_code',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
