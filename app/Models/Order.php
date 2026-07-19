<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Database\Factories\UserFactory;
class Order extends Model
{
    //
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_amount',
        'order_status',
        'shipping_address',
        'instruction',
        'payment_method',
        'payment_status'
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
