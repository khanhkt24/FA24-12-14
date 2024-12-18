<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProOrder extends Model
{
    use HasFactory;
    protected $fillable = ['id_order', 'id_pro', 'name_pro', 'price','color','size','quantity','total'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
