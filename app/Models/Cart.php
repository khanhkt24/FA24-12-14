<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_id',
        'product_id',
        'bienthe_id',
        'price',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function bienthe()
    {
        return $this->belongsTo(Bienthe::class, 'bienthe_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
