<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name'
    ];
    protected $dates = ['deleted_at'];
    
    public function tag()
    {
        return $this->hasMany(Tag::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
