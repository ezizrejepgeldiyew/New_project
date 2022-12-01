<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyCours extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'name', 'price'];

}
