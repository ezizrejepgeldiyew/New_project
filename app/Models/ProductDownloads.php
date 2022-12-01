<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDownloads extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'download'];

    public function Product()
    {
        return $this->belongsTo(product::class);
    }
}
