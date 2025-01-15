<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận thanh toán thành công</title>
</head>
<body>
    <h1>Cảm ơn bạn đã đặt hàng!</h1>
    <p>Xin chào {{ $order->customer->name }},</p>
    <p>Chúng tôi đã nhận được thanh toán cho đơn hàng của bạn. Dưới đây là thông tin chi tiết:</p>

    <ul>
        <li>Mã đơn hàng: {{ $order->order_code }}</li>
        <li>Tổng tiền: {{ number_format($order->total) }} VNĐ</li>
        <li>Ngày đặt hàng: {{ $order->ngaydathang->format('d/m/Y H:i') }}</li>
    </ul>

    <p>Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ hỗ trợ khách hàng</p>
</body>
</html>
