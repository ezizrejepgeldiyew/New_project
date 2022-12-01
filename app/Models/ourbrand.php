<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ourbrand extends Model
{
    use HasFactory;

    protected $fillable = ['name','photo','products'];

    public function product()
    {
        return $this->hasMany(product::class);
    }

}
