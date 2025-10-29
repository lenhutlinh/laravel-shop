<?php
/**
 * Test script để kiểm tra tích hợp VNPay
 * Chạy: php test_vnpay_integration.php
 */

// Test data
$orderId = 123;
$amount = 100000; // 100,000 VND

// VNPay configuration
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://127.0.0.1:8000/after_order";
$vnp_TmnCode = "1VYBIYQP";
$vnp_HashSecret = "NOH6MBGNLQL9O9OMMFMZ2AX8NIEP50W1";

$vnp_TxnRef = $orderId . "_" . time();
$vnp_OrderInfo = 'Thanh toán đơn hàng #' . $orderId;
$vnp_OrderType = 'billpayment';
$vnp_Amount = $amount * 100; // VNPay yêu cầu amount tính bằng xu
$vnp_Locale = 'vn';
$vnp_IpAddr = '127.0.0.1';

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
);

// Sắp xếp mảng theo key
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
}

echo "=== VNPay Payment Test ===\n";
echo "Order ID: {$orderId}\n";
echo "Amount: {$amount} VND\n";
echo "TxnRef: {$vnp_TxnRef}\n";
echo "Hash Data: {$hashdata}\n";
echo "Secure Hash: {$vnpSecureHash}\n";
echo "Payment URL: {$vnp_Url}\n\n";

echo "✅ VNPay URL generated successfully!\n";
echo "You can test by opening the URL in browser.\n\n";

echo "=== Test Completed ===\n";
?>
