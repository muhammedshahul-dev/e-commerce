<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'slug'
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'product_tags');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
