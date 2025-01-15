<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PayController extends Controller
{
    public function vnpayPayment(Request $request)
{
    $auth = auth('cus')->user();

    // Tạo mã đơn hàng mới
    $order_code = 'BILL-' . strtoupper(Str::random(10));
    
    // Tạo đơn hàng (còn thiếu thông tin email, phone, address nếu cần)
    $order = Order::create([
        'customer_id' => $auth->id,
        'email' => $auth->email ?? "",
        'phone' => $auth->phone ?? "",
        'address' => $auth->address ?? "",
        'total' => 0,
        'ngaydathang' => now(),
        'giaohang' => Order::TYPE_0,
        'thanhtoan' => "",
        'order_code' => $order_code
    ]);

    // Lấy sản phẩm trong giỏ hàng của khách
    $carts = Cart::where('customer_id', $auth->id)->get();
    $total = 0;

    // Lặp qua từng sản phẩm trong giỏ hàng và tạo bản ghi sản phẩm trong đơn hàng
    foreach ($carts as $cart) {
        $proOrder = new ProOrder();
        $proOrder->order_id = $order->id;
        $proOrder->product_id = $cart->product_id;
        $proOrder->name_pro = $cart->product->name;
        $proOrder->img = $cart->product->img;
        $proOrder->price = $cart->price;
        $proOrder->color = $cart->bienthe->color;
        $proOrder->size = $cart->bienthe->size;
        $proOrder->quantity = $cart->quantity;
        $proOrder->total = $cart->quantity * $cart->price;

        $proOrder->save();

        $total += $proOrder->total;
    }

    // Cập nhật tổng tiền cho đơn hàng
    $order->total = $total;
    $order->save();

    // Xóa giỏ hàng sau khi tạo đơn hàng
    Cart::where('customer_id', $auth->id)->delete();

    // Cấu hình cổng thanh toán VNPAY
    $vnp_TmnCode = "TP1GFETD"; // Mã website tại VNPAY
    $vnp_HashSecret = "CK7G7ASMD4UDHBC7KRGQNIQVTBBZ6ENI"; // Chuỗi bí mật
    $vnp_ReturnUrl = route('payment.callback'); // URL trả về sau thanh toán
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL cổng thanh toán (sandbox)

    // Thông tin giao dịch
    $vnp_TxnRef = $order_code; // Mã đơn hàng duy nhất
    $vnp_OrderInfo = "Thanh toán đơn hàng";
    $vnp_OrderType = "billpayment";
    $vnp_Amount = (int) str_replace(['.', 'VNĐ'], '', $total) * 100; // Số tiền (đổi ra đơn vị VND)
    $vnp_Locale = "vn"; // Ngôn ngữ
    $vnp_BankCode = ""; // Để trống nếu không chọn ngân hàng cụ thể
    $vnp_IpAddr = $request->ip(); // Lấy IP của người dùng
    $vnp_CreateDate = now()->format('YmdHis'); // Ngày giờ tạo giao dịch
    
    // Dữ liệu đầu vào cho VNPAY
    $inputData = [
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => $vnp_CreateDate,
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
"vnp_ReturnUrl" => $vnp_ReturnUrl,
        "vnp_TxnRef" => $vnp_TxnRef,
    ];

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        return redirect($vnp_Url);
    }
}
public function vnpayReturn(Request $request)
{

    $vnp_ResponseCode = $request->input('vnp_ResponseCode');
    $vnp_TxnRef = $request->input('vnp_TxnRef');
    $vnp_Amount = $request->input('vnp_Amount');
    $vnp_OrderInfo = $request->input('vnp_OrderInfo');
    $vnp_PaymentStatus = $request->input('vnp_PaymentStatus');
// dd($request->all());
        if ($vnp_ResponseCode == '00') {
            $paymentStatus = 'Thanh toán thành công';
        } else {
            $paymentStatus = 'Thanh toán thất bại';
        }

        $order = Order::where('order_code', $vnp_TxnRef)->first();
        

            // Lưu lịch sử thanh toán
            DB::table('payment_histories')->insert([
                'order_code' => $vnp_TxnRef,
                'transaction_id' => $vnp_TxnRef,
                'amount' => 500000,
                'status' => 'success',
                'payment_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Gửi email xác nhận

        if ($vnp_ResponseCode == '00') {
            return redirect()->route('client.thanku'); 
        } else {
            return redirect()->route('client.thatbai'); 
        }

    

   
}
}