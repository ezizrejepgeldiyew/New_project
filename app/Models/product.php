<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


class Product extends Model
{
    use HasFactory;

    protected $fillable = ['photo', 'photos', 'category_id', 'ourbrand_id', 'name', 'price', 'discount', 'description',  'rating', 'show'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function ourbrand()
    {
        return $this->belongsTo(OurBrand::class, 'ourbrand_id', 'id');
    }

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }

    public function order()
    {
        return $this->hasMany(Orders::class);
    }

    public function getPriceAttribute($value)
    {
        if(Session::has('money'))
        foreach (session('money') as $item) {
            return $value * $item['price'];
        }
        return $value;
    }
}
