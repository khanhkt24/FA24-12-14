<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bienthe extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'img', 'size', 'color', 'quantity'];
    public function sanphams()
    {
        return $this->belongsTo(Product::class);
    }
}
