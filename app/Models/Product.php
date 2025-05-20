<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = 
    ['name', 'desc', 'stock', 'price', 'imgProduct', 'sex_id', 'category_id', 'brand_id', 'discount', 'status'];

    public function gender() {
        return $this->belongsTo(Gender::class, 'sex_id');
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    
    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }
    
    public function sizes() {
        return $this->belongsToMany(Size::class, 'product_size');
    }
    
    public function colors() {
        return $this->belongsToMany(Color::class, 'product_color');
    }

}
