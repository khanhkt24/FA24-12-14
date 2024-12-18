<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bienthe extends Model
{
    use HasFactory;
    public function sanphams()
    {
        
        return $this->belongsTo(Product::class);
    }
}
