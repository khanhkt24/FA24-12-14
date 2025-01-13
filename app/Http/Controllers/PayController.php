<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

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
    $vnp_ReturnUrl = "https://localhost/vnpay_php/vnpay_return.php"; // URL trả về sau thanh toán
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

}
