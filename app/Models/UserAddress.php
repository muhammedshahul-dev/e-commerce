<?php

namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    //
    protected $fillable = [
        'country',
        'user_id',
        'state',
        'city',
        'district',
        'address_line1',
        'address_line2',
        'postal_code',

    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
