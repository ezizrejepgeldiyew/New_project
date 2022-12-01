<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class product extends Model
{
    use HasFactory;

    protected $fillable = ['photo', 'photos', 'category_id', 'ourbrand_id', 'name', 'price', 'description',  'rating', 'show'];

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }

    public function ourbrand()
    {
        return $this->belongsTo(ourbrand::class, 'ourbrand_id', 'id');
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
