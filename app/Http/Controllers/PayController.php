<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Order;
use Log;

class PayController extends Controller
{
    public function vnpayPayment(Request $request)
{
    // Thông tin cấu hình VNPAY
// $data = $request->all();
// dd($data);
    $total = $request->input('total');
    $vnp_TmnCode = "TP1GFETD"; // Mã website tại VNPAY
    $vnp_HashSecret = "CK7G7ASMD4UDHBC7KRGQNIQVTBBZ6ENI"; // Chuỗi bí mật
    $vnp_ReturnUrl = route('payment.callback'); // URL trả về sau thanh toán
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL cổng thanh toán (sandbox)

    // Thông tin giao dịch
    $vnp_TxnRef = time(); // Mã đơn hàng duy nhất
    $vnp_OrderInfo = "Thanh toán đơn hàng";
    $vnp_OrderType = "billpayment";
    $vnp_Amount = (int) str_replace(['.', 'VNĐ'], '', $total)* 100; // Số tiền (đổi ra đơn vị VND)
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

    //var_dump($inputData);
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

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        return redirect($vnp_Url);
    }
    
}
public function vnpayReturn(Request $request)
{
    Log::info('VNPAY Response', $request->all());

    $vnp_ResponseCode = $request->input('vnp_ResponseCode');
    $vnp_TxnRef = $request->input('vnp_TxnRef');
    $vnp_Amount = $request->input('vnp_Amount');
    $vnp_OrderInfo = $request->input('vnp_OrderInfo');
    $vnp_PaymentStatus = $request->input('vnp_PaymentStatus');
    $paymentMethod = $request->input('payment_method'); 

    if ($paymentMethod == 1) {
        if ($vnp_ResponseCode == '00') {
            $paymentStatus = 'Thanh toán thành công';
        } else {
            $paymentStatus = 'Thanh toán thất bại';
        }

        $order = Order::where('order_code', $vnp_TxnRef)->first();
        if ($order) {
            $order->updatePaymentStatus($vnp_TxnRef, $vnp_Amount, $vnp_OrderInfo, $vnp_ResponseCode, $paymentStatus);

            // Lưu lịch sử thanh toán
            DB::table('payment_histories')->insert([
                'order_id' => 1,
                'transaction_id' => 'TX12345678',
                'amount' => 500000,
                'status' => 'success',
                'payment_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Gửi email xác nhận
            if ($vnp_ResponseCode == '00') {
                \Mail::to($order->email)->send(new \App\Mail\PaymentSuccessMail($order));
            }
        }

        if ($vnp_ResponseCode == '00') {
            return redirect()->route('client.mail.thankyou'); 
        } else {
            return redirect()->route('client.thatbai'); 
        }
    }

    if ($paymentMethod == 0) {
        return redirect()->route('client.thanku'); 
    }

    return redirect()->route('client.thatbai');
}
}   
