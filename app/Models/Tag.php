<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'img',
        'category_id'
    ];
    protected $dates = ['deleted_at'];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
