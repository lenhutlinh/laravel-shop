<?php
/**
 * Test script để kiểm tra tích hợp MoMo
 * Chạy: php test_momo_integration.php
 */

// Test data
$orderId = 123;
$amount = 100000; // 100,000 VND

// MoMo API configuration
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

$orderInfo = "Thanh toán đơn hàng #{$orderId}";
$orderId = $orderId . "_" . time();
$redirectUrl = "http://localhost:8000/momo-callback";
$ipnUrl = "http://localhost:8000/momo-callback";
$extraData = "";

$requestId = time() . "";
$requestType = "payWithATM";

// Tạo signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);

$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Ecommerce Store",
    "storeId" => "EcommerceStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

echo "=== MoMo Payment Test ===\n";
echo "Order ID: {$orderId}\n";
echo "Amount: {$amount} VND\n";
echo "Signature: {$signature}\n";
echo "Raw Hash: {$rawHash}\n\n";

// Gửi request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($data))
));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_error($ch)) {
    echo "Curl Error: " . curl_error($ch) . "\n";
} else {
    echo "HTTP Code: {$httpCode}\n";
    echo "Response: {$result}\n";
    
    $jsonResult = json_decode($result, true);
    if (isset($jsonResult['payUrl'])) {
        echo "\n✅ Success! Payment URL: {$jsonResult['payUrl']}\n";
    } else {
        echo "\n❌ Error: " . ($jsonResult['message'] ?? 'Unknown error') . "\n";
    }
}

curl_close($ch);

echo "\n=== Test Completed ===\n";
?>
