<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const TYPE_0 = 'Đang xác nhận';
    const TYPE_1 = "Đang vận chuyển";
    const TYPE_2 = "Đã giao hàng";
    const TYPE_3 = "Đã bị hủy";
    protected $casts = [
        'ngaydathang' => 'datetime',
    ];
    protected $fillable = ['customer_id', 'email', 'phone', 'address','total','ngaydathang','giaohang','thanhtoan','order_code'];
    protected $attributes = [
        'giaohang' => self::TYPE_0, // Đặt mặc định trong model
    ];
    public function proOrder()
    {
        return $this->hasMany(ProOrder::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function cancel()
    {
        if ($this->status !== self::TYPE_0) {
            return false; // Chỉ hủy nếu đơn hàng đang ở trạng thái "Đang xác nhận"
        }

        $this->status = self::TYPE_3;
        return $this->save();
    }
    public static function getGiaoHangStatuses()
    {
        return [
            'Đang xác nhận' => self::TYPE_0,
            'Đang vận chuyển' => self::TYPE_1,
            'Đã giao hàng' => self::TYPE_2,
            'Đã bị hủy' => self::TYPE_3,
        ];
    }
    
}
