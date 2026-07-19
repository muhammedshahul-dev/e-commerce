<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Database\Factories\ProductImageFactory;

class ProductImage extends Model
{
    //
    /** @use HasFactory<ProductImageFactory> */
    use HasFactory;
    protected $fillable = [
        'image_path',
        'product_id',
        'is_primary'
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
