<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','img','description','category_id','tag_id','cost','deleted_at','sale'];
    protected $dates = ['deleted_at'];
    public function bienthe()
    {
        return $this->hasMany(Bienthe::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tag(){
        return $this->belongsTo(Tag::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }
}
