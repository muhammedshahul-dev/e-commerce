<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Database\Factories\UserFactory;

class ProductImage extends Model
{
    //
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    protected $fillable = [
        'image_path',
        'product_id',
        'is_primary'
    ];
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
