<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
        return $this->belongsToMany(Tag::class,'product_tag');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
