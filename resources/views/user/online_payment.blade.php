<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Trực Tuyến</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%,rgb(253, 253, 253) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .payment-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .payment-header {
            background: linear-gradient(135deg, #667eea 0%,rgb(92, 95, 186) 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .payment-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        
        .payment-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        
        .payment-body {
            padding: 40px;
        }
        
        .order-summary {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 5px solid #667eea;
        }
        
        .order-summary h4 {
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        
        .summary-item:last-child {
            border-bottom: none;
            font-weight: 600;
            font-size: 18px;
            color: #667eea;
        }
        
        .payment-methods {
            margin-bottom: 30px;
        }
        
        .payment-methods h4 {
            color: #333;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .payment-option {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .payment-option:hover {
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15);
        }
        
        .payment-option.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        }
        
        .payment-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }
        
        .payment-option-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .payment-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }
        
        .momo-icon {
            background: linear-gradient(135deg, #d82d8b 0%, #f8b500 100%);
        }
        
        .vnpay-icon {
            background: linear-gradient(135deg, #0052a5 0%, #00a651 100%);
        }
        
        .payment-info h5 {
            margin: 0 0 5px 0;
            color: #333;
            font-weight: 600;
        }
        
        .payment-info p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }
        
        .payment-features {
            margin-top: 15px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .feature-tag {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .btn-payment {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        
        .btn-momo {
            background: linear-gradient(135deg, #d82d8b 0%, #f8b500 100%);
            color: white;
        }
        
        .btn-momo:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(216, 45, 139, 0.3);
        }
        
        .btn-vnpay {
            background: linear-gradient(135deg, #0052a5 0%, #00a651 100%);
            color: white;
        }
        
        .btn-vnpay:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 82, 165, 0.3);
        }
        
        .btn-payment:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }
        
        .security-info {
            background: #e8f5e8;
            border: 1px solid #c3e6c3;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            text-align: center;
        }
        
        .security-info i {
            color: #28a745;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .security-info h6 {
            color: #155724;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .security-info p {
            color: #155724;
            margin: 0;
            font-size: 14px;
        }
        
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }
        
        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .payment-container {
                margin: 20px;
                border-radius: 15px;
            }
            
            .payment-body {
                padding: 25px;
            }
            
            .payment-option-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .payment-features {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-container">
            <div class="payment-header">
                <h2><i class="fas fa-credit-card"></i> Thanh Toán Trực Tuyến</h2>
                <p>Chọn phương thức thanh toán phù hợp với bạn</p>
            </div>
            
            <div class="payment-body">
                <!-- Tóm tắt đơn hàng -->
                <div class="order-summary">
                    <h4><i class="fas fa-receipt"></i> Tóm tắt đơn hàng</h4>
                    <div class="summary-item">
                        <span>Tổng tiền hàng:</span>
                        <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>
                    <div class="summary-item">
                        <span>Phí vận chuyển:</span>
                        <span>{{ number_format($orderData['shipping_cost'] ?? 0, 0, ',', '.') }}đ</span>
                    </div>
                    @if(isset($orderData['shipping_cost']) && $orderData['shipping_cost'] > 0)
                    <div class="summary-item" style="font-size: 12px; color: #666;">
                        <span>Địa chỉ giao hàng:</span>
                        <span>{{ $orderData['ship_address'] ?? 'N/A' }}</span>
                    </div>
                    @endif
                    @if(($orderData['coupon_discount'] ?? 0) > 0)
                    <div class="summary-item">
                        <span>Giảm giá:</span>
                        <span style="color: #28a745;">-{{ number_format($orderData['coupon_discount'], 0, ',', '.') }}đ</span>
                    </div>
                    @endif
                    <div class="summary-item">
                        <span><strong>Tổng thanh toán:</strong></span>
                        <span><strong>{{ number_format($total, 0, ',', '.') }}đ</strong></span>
                    </div>
                </div>
                
                <!-- Phương thức thanh toán -->
                <div class="payment-methods">
                    <h4><i class="fas fa-mobile-alt"></i> Chọn phương thức thanh toán</h4>
                    
                    <!-- Momo -->
                    <div class="payment-option" data-payment="momo">
                        <input type="radio" name="payment_method" value="momo" id="momo">
                        <div class="payment-option-content">
                            <div class="payment-icon momo-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="payment-info">
                                <h5>Ví điện tử MoMo</h5>
                                <p>Thanh toán nhanh chóng và an toàn qua ví MoMo</p>
                                <div class="payment-features">
                                    <span class="feature-tag">Nhanh chóng</span>
                                    <span class="feature-tag">Bảo mật cao</span>
                                    <span class="feature-tag">Hỗ trợ 24/7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- VNPay -->
                    <div class="payment-option" data-payment="vnpay">
                        <input type="radio" name="payment_method" value="vnpay" id="vnpay">
                        <div class="payment-option-content">
                            <div class="payment-icon vnpay-icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="payment-info">
                                <h5>VNPay</h5>
                                <p>Thanh toán qua thẻ ngân hàng, ví điện tử</p>
                                <div class="payment-features">
                                    <span class="feature-tag">Đa dạng thẻ</span>
                                    <span class="feature-tag">Bảo mật SSL</span>
                                    <span class="feature-tag">Hỗ trợ nhiều ngân hàng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Nút thanh toán -->
                <button class="btn-payment btn-momo" id="btn-momo" onclick="processPayment('momo')" disabled>
                    <i class="fas fa-mobile-alt"></i> Thanh toán bằng MoMo
                </button>
                
                <button class="btn-payment btn-vnpay" id="btn-vnpay" onclick="processPayment('vnpay')" disabled>
                    <i class="fas fa-university"></i> Thanh toán bằng VNPay
                </button>
                
                <!-- Loading -->
                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Đang xử lý thanh toán...</p>
                </div>
                
                <!-- Thông tin bảo mật -->
                <div class="security-info">
                    <i class="fas fa-shield-alt"></i>
                    <h6>Thanh toán an toàn</h6>
                    <p>Thông tin thanh toán của bạn được mã hóa và bảo mật tuyệt đối</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Xử lý chọn phương thức thanh toán
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                // Bỏ chọn tất cả
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('selected');
                    opt.querySelector('input[type="radio"]').checked = false;
                });
                
                // Chọn option hiện tại
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
                
                // Kích hoạt nút thanh toán tương ứng
                const paymentMethod = this.dataset.payment;
                document.querySelectorAll('.btn-payment').forEach(btn => {
                    btn.disabled = true;
                });
                
                if (paymentMethod === 'momo') {
                    document.getElementById('btn-momo').disabled = false;
                } else if (paymentMethod === 'vnpay') {
                    document.getElementById('btn-vnpay').disabled = false;
                }
            });
        });
        
        // Xử lý thanh toán
        function processPayment(method) {
            if (!method) {
                alert('Vui lòng chọn phương thức thanh toán');
                return;
            }
            
            // Hiển thị loading
            document.getElementById('loading').style.display = 'block';
            document.querySelectorAll('.btn-payment').forEach(btn => {
                btn.disabled = true;
            });
            
            // Gửi request đến server
            const url = method === 'momo' ? '{{ route("process_momo_payment") }}' : '{{ route("process_vnpay_payment") }}';
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    payment_method: method
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    // Chuyển hướng đến trang thanh toán
                    window.location.href = data.payment_url;
                } else {
                    alert('Có lỗi xảy ra: ' + data.message);
                    document.getElementById('loading').style.display = 'none';
                    document.querySelectorAll('.btn-payment').forEach(btn => {
                        btn.disabled = false;
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi xử lý thanh toán');
                document.getElementById('loading').style.display = 'none';
                document.querySelectorAll('.btn-payment').forEach(btn => {
                    btn.disabled = false;
                });
            });
        }
        
        // Auto focus vào option đầu tiên sau 1 giây
        setTimeout(() => {
            document.querySelector('.payment-option').click();
        }, 1000);
    </script>
</body>
</html>
