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
    // Lấy dữ liệu trả về từ VNPAY
    $vnp_ResponseCode = $request->input('vnp_ResponseCode');
    $vnp_TxnRef = $request->input('vnp_TxnRef');
    $vnp_Amount = $request->input('vnp_Amount');
    $vnp_OrderInfo = $request->input('vnp_OrderInfo');
    $vnp_PaymentStatus = $request->input('vnp_PaymentStatus');

    // Lấy giá trị trạng thái thanh toán (0: thanh toán trực tiếp, 1: thanh toán VNPAY)
    $paymentMethod = $request->input('payment_method'); // Bạn cần phải truyền giá trị này trong quá trình thanh toán

    // Kiểm tra thanh toán VNPAY
    if ($paymentMethod == 1) {
        // Kiểm tra mã phản hồi từ VNPAY
        if ($vnp_ResponseCode == '00') {
            $paymentStatus = 'Thanh toán thành công';
        } else {
            $paymentStatus = 'Thanh toán thất bại';
        }

        // Cập nhật đơn hàng với thông tin thanh toán VNPAY
        $order = Order::where('order_code', $vnp_TxnRef)->first();
        if ($order) {
            $order->updatePaymentStatus($vnp_TxnRef, $vnp_Amount, $vnp_OrderInfo, $vnp_ResponseCode, $paymentStatus);
        }

        // Chuyển hướng tới trang thành công hoặc thất bại
        if ($vnp_ResponseCode == '00') {
            return redirect()->route('client.thankyou'); // Thanh toán thành công
        } else {
            return redirect()->route('client.thatbai'); // Thanh toán thất bại
        }
    }

    // Trường hợp thanh toán trực tiếp (paymentMethod == 0)
    if ($paymentMethod == 0) {
        // Không cần xử lý thêm gì, vì đây là thanh toán trực tiếp, không qua VNPAY
        return redirect()->route('client.thanku'); // Chuyển hướng tới trang cảm ơn sau khi thanh toán trực tiếp
    }

    // Nếu không có phương thức thanh toán hợp lệ, chuyển hướng đến trang thất bại
    return redirect()->route('client.thatbai');

}
}
