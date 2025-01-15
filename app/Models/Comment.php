<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['customer_id', 'product_id', 'content'];

    // Bình luận thuộc về một khách hàng
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Bình luận thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
