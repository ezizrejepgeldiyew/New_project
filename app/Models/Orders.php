<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id', 'id');
    }
}
