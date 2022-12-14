<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message',
        'note',
    ];

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
