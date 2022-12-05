<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ourbrand extends Model
{
    use HasFactory;

    protected $fillable = ['name','photo','products'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
