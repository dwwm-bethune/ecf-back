<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'slug',
        'favorite',
        'image',
        'discount',
        'category_id',
    ];

    public function getDescriptionTruncatedAttribute()
    {
        return Str::limit($this->description, 20);
    }

    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 2, ',', ' ').' €';
    }

    public function getPromoAttribute()
    {
        return number_format($this->price - $this->price * $this->discount / 100, 2, ',', ' ').'€';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }
}
