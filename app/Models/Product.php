<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'price',
        'discount_price',
        'image',
        'short_description',
        'description',
        'status',
        'stock',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        // When a product is deleted, also remove stored images
        static::deleting(function ($product) {
            if ($product->image) {
                $path = public_path($product->image);
                if (file_exists($path)) {
                    @unlink($path);
                }
            }
            foreach ($product->images as $img) {
                $path = public_path($img->image_path);
                if (file_exists($path)) {
                    @unlink($path);
                }
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function averageRating()
    {
        return round($this->reviews()->avg('rating'), 1) ?: 0;
    }
}
