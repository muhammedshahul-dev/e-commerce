<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Database\Factories\UserFactory;

class Product extends Model
{
    //
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'slug'
    ];
    public function tags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'product_tag');
    }
    public function productImages():HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
    public function primaryImages():HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }
    public function categorys():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function carts():HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
