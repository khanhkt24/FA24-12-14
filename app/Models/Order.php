<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const TYPE_1 = "Đang vận chuyển";
    const TYPE_2 = "Đã giao hàng";
    const TYPE_3 = "Đã bị hủy";
    protected $fillable = ['name', 'email', 'phone', 'address','total','ngaydathang','giaohang','thanhtoan'];
    public function proOrder()
    {
        return $this->hasMany(ProOrder::class);
    }
}
