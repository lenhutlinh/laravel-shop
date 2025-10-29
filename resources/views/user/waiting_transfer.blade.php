@extends('user.layout')

@section('content')
<div class="text-center mt-5">
    <h2 class="text-success">💰 Đang chờ chuyển khoản</h2>
    <p>Vui lòng chuyển khoản theo thông tin bên dưới:</p>
    <img src="{{ asset('images/qr_momo.png') }}" alt="QR Momo" style="width: 200px; margin: 20px auto; display: block;">

    <div class="alert alert-warning w-50 mx-auto">
        <strong>Ngân hàng:</strong> MB Bank<br>
        <strong>Số tài khoản:</strong> 123456789<br>
        <strong>Tên người nhận:</strong> Nguyễn Văn A<br>
        <strong>Nội dung:</strong> Thanh toán đơn #{{ $order_id }}
    </div>

    <div class="text-muted">Sau khi chuyển khoản, đơn hàng sẽ được xác nhận bởi hệ thống.</div>
</div>
@endsection