<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">    
    <style>
        /* Modern CSS Reset and Base Styles */
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        /* Main Container - Modern Grid Layout */
        .purchase-page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 24px;
            min-height: 100vh;
        }
        
        /* Enhanced Sidebar */
        .purchase-sidebar {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            height: fit-content;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #f0f0f0;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .user-avatar {
            position: relative;
        }
        
        .user-avatar img {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .user-info h3 {
            margin: 0 0 4px 0;
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
        }
        
        .edit-profile {
            font-size: 13px;
            color: #ee4d2d;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .edit-profile:hover {
            color: #d73502;
            text-decoration: underline;
        }
        
        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 20px;
            border-radius: 10px;
            text-decoration: none;
            color: #666;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }
        
        .nav-item:hover {
            background: #f8f9fa;
            color: #333;
            transform: translateX(4px);
        }
        
        .nav-item.active {
            background: linear-gradient(135deg, #ee4d2d, #ff6b35);
            color: white;
            box-shadow: 0 4px 12px rgba(238, 77, 45, 0.3);
        }
        
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: -24px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: #ee4d2d;
            border-radius: 2px;
        }
        
        .nav-icon {
            font-size: 18px;
            width: 20px;
            text-align: center;
        }
        
        /* Enhanced Main Content */
        .purchase-main {
            background: #fff;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #f0f0f0;
        }
        
        /* Enhanced Order Filters */
        .order-filters {
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f8f9fa;
        }
        
        .filter-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .filter-tab {
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            background: #f8f9fa;
        }
        
        .filter-tab:hover {
            background: #e9ecef;
            color: #333;
            transform: translateY(-2px);
        }
        
        .filter-tab.active {
            background: linear-gradient(135deg, #ee4d2d, #ff6b35);
            color: white;
            border-color: #ee4d2d;
            box-shadow: 0 4px 12px rgba(238, 77, 45, 0.3);
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box input {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .search-box input:focus {
            outline: none;
            border-color: #ee4d2d;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(238, 77, 45, 0.1);
        }
        
        .search-box::before {
            content: '🔍';
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #999;
        }
        
        /* Enhanced Order List */
        .order-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        /* Enhanced Order Cards */
        .order-card {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.12);
            border-color: #ee4d2d;
        }
        
        .order-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ee4d2d, #ff6b35);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .order-card:hover::before {
            opacity: 1;
        }
        
        /* Enhanced Order Header */
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            background: linear-gradient(135deg, #f8f9fa, #fff);
            border-bottom: 1px solid #e9ecef;
        }
        
        .shop-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .shop-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .shop-name {
            font-weight: 700;
            color: #1a1a1a;
            font-size: 16px;
        }
        
        .shop-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #ee4d2d, #ff6b35);
            color: white;
            box-shadow: 0 2px 8px rgba(238, 77, 45, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(238, 77, 45, 0.4);
        }
        
        .btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #e9ecef;
        }
        
        .btn-secondary:hover {
            background: #e9ecef;
            color: #333;
            transform: translateY(-2px);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
        }
        
        .btn-info {
            background: linear-gradient(135deg, #17a2b8, #6f42c1);
            color: white;
            box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
        }
        
        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        }
        
        .btn-reorder {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
        }
        
        .btn-reorder:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
        }
        
        .btn-reorder:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        
        .order-status {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 20px;
            background: #f8f9fa;
        }
        
        .status-completed {
            color: #00a650;
            background: #e8f5e8;
        }
        
        .status-pending {
            color: #ff6b35;
            background: #fff3e0;
        }
        
        .status-cancelled {
            color: #999;
            background: #f5f5f5;
        }
        
        /* Enhanced Product Section */
        .product-section {
            padding: 24px;
        }
        
        .product-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .product-item:last-child {
            border-bottom: none;
        }
        
        .product-image {
            width: 90px;
            height: 90px;
            border-radius: 12px;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border: 2px solid #fff;
        }
        
        .product-details {
            flex: 1;
            min-width: 0;
        }
        
        .product-name {
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 6px;
            line-height: 1.4;
            font-size: 15px;
        }
        
        .product-variant {
            font-size: 13px;
            color: #666;
            margin-bottom: 6px;
            background: #f8f9fa;
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-block;
        }
        
        .product-quantity {
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }
        
        .product-price {
            font-weight: 700;
            color: #ee4d2d;
            font-size: 18px;
            text-align: right;
            flex-shrink: 0;
        }
        
        /* Enhanced Order Footer */
        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            background: linear-gradient(135deg, #fffefb, #fff);
            border-top: 1px solid #e9ecef;
        }
        
        .order-total {
            font-weight: 700;
            color: #1a1a1a;
            font-size: 18px;
        }
        
        .order-actions {
            display: flex;
            gap: 12px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .purchase-page-container {
                grid-template-columns: 1fr;
                padding: 16px;
                gap: 16px;
            }
            
            .purchase-sidebar {
                order: 2;
            }
            
            .purchase-main {
                order: 1;
                padding: 20px;
            }
            
            .order-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .shop-actions {
                width: 100%;
                justify-content: flex-start;
            }
            
            .product-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .product-price {
                text-align: left;
            }
            
            .order-footer {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .order-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }
        
        /* Loading and No Results States */
        .order-list {
            transition: opacity 0.3s ease;
        }
        
        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #999;
            font-size: 16px;
            background: #f8f9fa;
            border-radius: 12px;
            margin: 20px 0;
        }
        
        .no-results::before {
            content: '🔍';
            display: block;
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        
        /* Filter Tab Active State Enhancement */
        .filter-tab.active {
            position: relative;
            overflow: hidden;
        }
        
        .filter-tab.active::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        /* Star Rating Styles */
        .rating-modal {
            max-width: 100%;
            padding: 20px;
        }
        
        .rating-products {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .product-rating-item {
            padding: 20px;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            background: #f8f9fa;
        }
        
        .product-rating-item h4 {
            margin: 0 0 15px 0;
            color: #1a1a1a;
            font-size: 16px;
            font-weight: 600;
        }
        
        .star-rating {
            display: flex;
            gap: 5px;
            margin-bottom: 15px;
        }
        
        .star {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
        }
        
        .star:hover,
        .star.hover {
            color: #ffc107;
            transform: scale(1.1);
        }
        
        .star.active {
            color: #ffc107;
        }
        
        .rating-comment {
            width: 100%;
            padding: 12px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            resize: vertical;
            min-height: 80px;
            transition: border-color 0.3s ease;
        }
        
        .rating-comment:focus {
            outline: none;
            border-color: #ee4d2d;
            box-shadow: 0 0 0 2px rgba(238, 77, 45, 0.1);
        }
        
        .rating-image-upload {
            margin-top: 10px;
        }
        
        .image-upload-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            color: #6c757d;
        }
        
        .image-upload-label:hover {
            background: #e9ecef;
            border-color: #ee4d2d;
            color: #ee4d2d;
        }
        
        .image-upload-label i {
            font-size: 16px;
        }
        
        .image-preview {
            margin-top: 10px;
            text-align: center;
        }
        
        .image-preview img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        /* Hide original elements */
        .hiXKxx, .x0QT2k, ._0OiaZ-, .AM4Cxf, .kvXy0c, .O2KPzo {
            display: none !important;
        }
    </style>
    <title>Đơn mua</title>
</head>
<body>
    
    <header>
        @include('header')
    </header>
    <main>
        @csrf 
        <div class="purchase-page-container">
            <!-- Sidebar -->
            <div class="purchase-sidebar">
                <div class="user-profile">
                    <div class="user-avatar">
                            @php
                            $user_img = Session::get('user_img');
                            @endphp
                            @if(Session::get('user_img') != null)
                        <img src="{{asset('storage/'.$user_img)}}" alt="User Avatar">
                            @else
                        <img src="{{asset('storage/users_img/user.png')}}" alt="User Avatar">
                            @endif
                        </div>
                    <div class="user-info">
                        <h3>{{Session::get('user_name') }}</h3>
                        <a href="/user/account/profile" class="edit-profile">Sửa hồ sơ</a>
                    </div>
                            </div>
                           
                <nav class="sidebar-nav">
                    <a href="{{route('user_account')}}" class="nav-item">
                        <span class="nav-icon">👤</span>
                        <span>Tài khoản của tôi</span>
                    </a>
                    <a href="{{route('user_purchase')}}" class="nav-item active">
                        <span class="nav-icon">📦</span>
                        <span>Đơn mua</span>
                    </a>
                    <a href="{{route('chat_user')}}" class="nav-item">
                        <span class="nav-icon">💬</span>
                        <span>Tin nhắn</span>
                    </a>
                    <a href="{{route('user_password')}}" class="nav-item">
                        <span class="nav-icon">🔒</span>
                        <span>Đổi mật khẩu</span>
                    </a>
                </nav>
                            </div>
                            
            <!-- Main Content -->
            <div class="purchase-main">
                <div class="order-filters">
                    <div class="filter-tabs">
                        <a href="{{ route('user_purchase') }}" class="filter-tab {{ $status == 'all' ? 'active' : '' }}">Tất cả</a>
                        <a href="{{ route('user_purchase', ['status' => 'pending']) }}" class="filter-tab {{ $status == 'pending' ? 'active' : '' }}">Chờ thanh toán</a>
                        <a href="{{ route('user_purchase', ['status' => 'shipping']) }}" class="filter-tab {{ $status == 'shipping' ? 'active' : '' }}">Vận chuyển</a>
                        <a href="{{ route('user_purchase', ['status' => 'delivering']) }}" class="filter-tab {{ $status == 'delivering' ? 'active' : '' }}">Đang giao</a>
                        <a href="{{ route('user_purchase', ['status' => 'completed']) }}" class="filter-tab {{ $status == 'completed' ? 'active' : '' }}">Hoàn thành</a>
                        <a href="{{ route('user_purchase', ['status' => 'cancelled']) }}" class="filter-tab {{ $status == 'cancelled' ? 'active' : '' }}">Đã hủy</a>
                        <a href="#" class="filter-tab">Trả hàng/Hoàn tiền</a>
                        </div>
                    <div class="search-box">
                        <input type="text" placeholder="Tìm kiếm theo tên Shop, ID đơn hàng hoặc Tên sản phẩm">
                    </div>
                </div>
                
                <div class="order-list">
                    @foreach($orders as $key => $order)
                    <div class="order-card">
                        <!-- Order Header -->
                        <div class="order-header">
                            <div class="shop-info" data-shop_id="{{$order->shop_id}}">
                                <img src="{{asset('storage/'.$order->shopImg)}}" alt="Shop" class="shop-avatar">
                                <span class="shop-name">{{$order->shopname}}</span>
                                <div class="shop-actions">
                                    <a href="{{route('show_chat',$order->shop_id)}}" class="btn btn-primary">Chat</a>
                                    <a href="{{route('view_shop',$order->shop_id)}}" class="btn btn-secondary">Xem Shop</a>
                            </div>
                            </div>
                            <div class="order-status">
                                @if($order->order_status == 0)
                                    <span class="status-pending">⏳ Đang chờ xác nhận</span>
                                                @elseif($order->order_status == 1)
                                    <span class="status-completed">✅ Đã được xác nhận</span>
                                                @elseif($order->order_status == 2)
                                    <span class="status-cancelled">❌ Đã bị hủy</span>
                                                @elseif($order->order_status == 3)
                                    <span class="status-pending">🚚 Đang vận chuyển</span>
                                                @elseif($order->order_status == 4)
                                    <span class="status-pending">📦 Đang giao</span>
                                                @elseif($order->order_status == 5)
                                    <span class="status-completed">✅ Hoàn thành</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                        
                        <!-- Product Section -->
                        <div class="product-section">
                            @foreach($order->order_product as $product)
                            <div class="product-item" data-product_id="{{$product->product_id}}">
                                <div class="product-image" style="background-image: url({{asset('storage/'.$product->previewImage)}});"></div>
                                <div class="product-details">
                                    <div class="product-name">{{$product->product_name}}</div>
                                    @if($product->product_combination != null)
                                    <div class="product-variant">Phân loại hàng: {{$product->product_combination}}</div>
                                    @endif
                                    <div class="product-quantity">x{{$product->product_quantity}}</div>
                                </div>
                                <div class="product-price">{{number_format($product->product_price, 0, ',', '.')}}₫</div>
                                </div>
                                @endforeach
                        </div>
                        
                        <!-- Order Footer -->
                        <div class="order-footer">
                            <div class="order-total">Thành tiền: {{number_format($order->order_total, 0, ',', '.')}}₫</div>
                            <div class="order-actions">
                                @if($order->order_status == 0)
                                    <button data-order_id="{{$order->id}}" class="btn btn-primary user_cancel_order">Hủy Đơn Hàng</button>
                                @elseif($order->order_status == 1)
                                    <a href="{{ route('show_chat', $order->shop_id) }}" class="btn btn-secondary">Liên hệ Người bán</a>
                                @elseif($order->order_status == 2)
                                    <!-- Không hiển thị button nào cho đơn đã hủy -->
                                @elseif($order->order_status == 3)
                                    <a href="{{ route('show_chat', $order->shop_id) }}" class="btn btn-secondary">Liên hệ Người bán</a>
                                @elseif($order->order_status == 4)
                                    <a href="{{ route('show_chat', $order->shop_id) }}" class="btn btn-secondary">Liên hệ Người bán</a>
                                @elseif($order->order_status == 5)
                                    <button class="btn btn-success">⭐ Đánh giá</button>
                                    <a href="{{ route('show_chat', $order->shop_id) }}" class="btn btn-secondary">Liên hệ Shop</a>
                                    <button class="btn btn-reorder" data-order_id="{{ $order->id }}">🔄 Mua lại</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
        </div>
    </main>
    <footer>
       @include('footer')

    </footer>
    <!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- include jQuery validate library -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function(){
        // Prevent multiple event bindings
        $('.user_cancel_order').off('click').on('click', function(e){
            e.preventDefault();
            var order_id = $(this).data('order_id');
            var _token = $('input[name="_token"]').val();
            
            if (!order_id || !_token) {
                console.error('Missing order_id or token');
                return;
            }
            
            swal("Xác Nhận Hủy Đơn Hàng?", {
                buttons: {
                    cancel: "Không",
                    confirm: {
                    text: "Xác Nhận",
                        value: "confirm",
                    },
                },
            })
            .then((value) => {
                if (value === "confirm") {
                    $.ajax({
                        url: '{{route('user_cancel_order')}}',
                        method: 'POST',
                        data:{
                            order_id: order_id,
                            _token: _token,
                        },
                        success: function(data){
                            if(data.status == true){
                                swal("Thành công!", "Đơn hàng đã được hủy", "success")
                                .then(() => {
                                location.reload();
                                });
                            } else {
                                swal("Lỗi!", "Không thể hủy đơn hàng", "error");
                            }
                        },
                        error: function(xhr, status, error){
                            console.error('AJAX Error:', error);
                            swal("Lỗi!", "Có lỗi xảy ra khi hủy đơn hàng", "error");
                        }
                    });
                }
            });
        });
        
        // Search functionality
        $('.search-box input').on('input', function(){
            var searchTerm = $(this).val().toLowerCase();
            var orderCards = $('.order-card');
            
            orderCards.each(function(){
                var orderText = $(this).text().toLowerCase();
                if (orderText.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            
            // Show message if no results
            var visibleCards = $('.order-card:visible').length;
            if (searchTerm && visibleCards === 0) {
                if ($('.no-results').length === 0) {
                    $('.order-list').append('<div class="no-results" style="text-align: center; padding: 40px; color: #666;">Không tìm thấy đơn hàng nào</div>');
                }
            } else {
                $('.no-results').remove();
            }
        });
        
        // Filter tab click animation
        $('.filter-tab').on('click', function(e){
            // Add loading state
            $('.order-list').css('opacity', '0.6');
            
            // Remove loading state after a short delay
            setTimeout(function(){
                $('.order-list').css('opacity', '1');
            }, 300);
        });
        
        // Add smooth scroll to top when filter changes
        $('.filter-tab').on('click', function(){
            $('html, body').animate({
                scrollTop: $('.order-filters').offset().top - 100
            }, 500);
        });
        
        // Handle rating button click
        $('.btn-success').on('click', function(){
            var orderCard = $(this).closest('.order-card');
            var orderId = orderCard.find('[data-order_id]').data('order_id');
            var shopId = orderCard.find('.shop-info').data('shop_id');
            
            // Get all products in this order
            var products = [];
            orderCard.find('.product-item').each(function(){
                var productId = $(this).data('product_id');
                var productName = $(this).find('.product-name').text();
                products.push({id: productId, name: productName});
            });
            
            if (products.length === 0) {
                swal("Lỗi!", "Không tìm thấy sản phẩm để đánh giá", "error");
                return;
            }
            
            // Create rating modal
            var ratingHtml = '<div class="rating-modal">';
            ratingHtml += '<div class="rating-products">';
            products.forEach(function(product, index) {
                ratingHtml += '<div class="product-rating-item" data-product-id="' + product.id + '">';
                ratingHtml += '<h4>' + product.name + '</h4>';
                ratingHtml += '<div class="star-rating" data-rating="0">';
                for (var i = 1; i <= 5; i++) {
                    ratingHtml += '<span class="star" data-star="' + i + '">★</span>';
                }
                ratingHtml += '</div>';
                ratingHtml += '<textarea class="rating-comment" placeholder="Nhập bình luận (tùy chọn)..." rows="3"></textarea>';
                ratingHtml += '<div class="rating-image-upload">';
                ratingHtml += '<label for="rating-image-' + product.id + '" class="image-upload-label">';
                ratingHtml += '<i class="fas fa-camera"></i> Thêm hình ảnh (tùy chọn)';
                ratingHtml += '</label>';
                ratingHtml += '<input type="file" id="rating-image-' + product.id + '" class="rating-image-input" accept="image/*" style="display: none;">';
                ratingHtml += '<div class="image-preview" id="preview-' + product.id + '" style="display: none;"></div>';
                ratingHtml += '</div>';
                ratingHtml += '</div>';
            });
            ratingHtml += '</div></div>';
            
            swal({
                title: "Đánh giá đơn hàng",
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: ratingHtml
                    },
                },
                buttons: {
                    cancel: "Hủy",
                    confirm: {
                        text: "Gửi đánh giá",
                        value: "confirm",
                    },
                },
            })
            .then((value) => {
                if (value === "confirm") {
                    submitRatings(orderId, shopId, products);
                }
            });
            
            // Initialize star rating
            initializeStarRating();
        });
        
        // Handle comment button click
        $('.btn-info').on('click', function(){
            var orderId = $(this).closest('.order-card').find('[data-order_id]').data('order_id');
            var shopId = $(this).closest('.order-card').find('.shop-info').data('shop_id');
            
            swal({
                title: "Bình luận đơn hàng",
                content: {
                    element: "textarea",
                    attributes: {
                        placeholder: "Nhập bình luận của bạn về đơn hàng...",
                        rows: 4,
                        id: "comment-textarea"
                    },
                },
                buttons: {
                    cancel: "Hủy",
                    confirm: {
                        text: "Gửi bình luận",
                        value: "confirm",
                    },
                },
            })
            .then((value) => {
                if (value === "confirm") {
                    var comment = document.getElementById('comment-textarea').value;
                    if (comment && comment.trim().length > 0) {
                        // Submit comment via AJAX
                        $.ajax({
                            url: '{{ route("comment_store") }}',
                            method: 'POST',
                            data: {
                                order_id: orderId,
                                shop_id: shopId,
                                comment: comment.trim(),
                                _token: $('input[name="_token"]').val()
                            },
                            success: function(response) {
                                if (response.status) {
                                    swal("Thành công!", "Cảm ơn bạn đã bình luận!", "success")
                                    .then(() => {
                                        // Reload the page to show updated comments
                                        location.reload();
                                    });
                                } else {
                                    swal("Lỗi!", response.message || "Không thể gửi bình luận", "error");
                                }
                            },
                            error: function(xhr) {
                                var errorMsg = "Có lỗi xảy ra khi gửi bình luận";
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMsg = xhr.responseJSON.message;
                                }
                                swal("Lỗi!", errorMsg, "error");
                            }
                        });
                    } else {
                        swal("Lỗi!", "Vui lòng nhập bình luận", "error");
                    }
                }
            });
        });
        
        // Handle reorder button click
        $('.btn-reorder').on('click', function(){
            var orderId = $(this).data('order_id');
            var button = $(this);
            
            swal("Xác nhận mua lại", "Bạn có muốn mua lại đơn hàng này không?", {
                buttons: {
                    cancel: "Không",
                    confirm: {
                        text: "Mua lại",
                        value: "confirm",
                    },
                },
            })
            .then((value) => {
                if (value === "confirm") {
                    // Disable button and show loading
                    button.prop('disabled', true).text('Đang xử lý...');
                    
                    $.ajax({
                        url: '{{ route("reorder") }}',
                        method: 'POST',
                        data: {
                            order_id: orderId,
                            _token: $('input[name="_token"]').val()
                        },
                        success: function(response) {
                            if (response.status) {
                                swal("Thành công!", response.message, "success")
                                .then(() => {
                                    // Redirect to checkout page
                                    if (response.redirect_url) {
                                        window.location.href = response.redirect_url;
                                    }
                                });
                            } else {
                                swal("Lỗi!", response.message, "error");
                            }
                        },
                        error: function(xhr) {
                            var errorMsg = "Có lỗi xảy ra khi mua lại";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            swal("Lỗi!", errorMsg, "error");
                        },
                        complete: function() {
                            // Re-enable button
                            button.prop('disabled', false).text('Mua lại');
                        }
                    });
                }
            });
        });
        
        // Initialize star rating functionality
        function initializeStarRating() {
            $('.star').off('click').on('click', function() {
                var star = $(this);
                var rating = star.data('star');
                var starContainer = star.parent();
                
                // Update visual stars
                starContainer.find('.star').removeClass('active');
                for (var i = 1; i <= rating; i++) {
                    starContainer.find('.star[data-star="' + i + '"]').addClass('active');
                }
                
                // Update data attribute
                starContainer.data('rating', rating);
            });
            
            $('.star').off('mouseenter').on('mouseenter', function() {
                var star = $(this);
                var rating = star.data('star');
                var starContainer = star.parent();
                
                // Preview hover effect
                starContainer.find('.star').removeClass('hover');
                for (var i = 1; i <= rating; i++) {
                    starContainer.find('.star[data-star="' + i + '"]').addClass('hover');
                }
            });
            
            $('.star-rating').off('mouseleave').on('mouseleave', function() {
                var starContainer = $(this);
                var currentRating = starContainer.data('rating');
                
                // Reset to current rating
                starContainer.find('.star').removeClass('hover');
                for (var i = 1; i <= currentRating; i++) {
                    starContainer.find('.star[data-star="' + i + '"]').addClass('active');
                }
            });
        }
        
        // Submit ratings function
        function submitRatings(orderId, shopId, products) {
            var ratings = [];
            var hasRating = false;
            
            $('.product-rating-item').each(function() {
                var productId = $(this).data('product-id');
                var rating = $(this).find('.star-rating').data('rating');
                var comment = $(this).find('.rating-comment').val();
                var imageFile = $(this).find('.rating-image-input')[0].files[0];
                
                if (rating > 0) {
                    hasRating = true;
                    ratings.push({
                        product_id: productId,
                        rating: rating,
                        comment: comment,
                        image: imageFile
                    });
                }
            });
            
            if (!hasRating) {
                swal("Lỗi!", "Vui lòng chọn ít nhất 1 sao cho một sản phẩm", "error");
                return;
            }
            
            // Submit each rating
            var submittedCount = 0;
            var totalCount = ratings.length;
            
            ratings.forEach(function(ratingData) {
                var formData = new FormData();
                formData.append('product_id', ratingData.product_id);
                formData.append('order_id', orderId);
                formData.append('shop_id', shopId);
                formData.append('rating', ratingData.rating);
                formData.append('comment', ratingData.comment);
                formData.append('_token', $('input[name="_token"]').val());
                
                if (ratingData.image) {
                    formData.append('image', ratingData.image);
                }
                
                $.ajax({
                    url: '{{ route("rating_store") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        submittedCount++;
                        if (submittedCount === totalCount) {
                            swal("Thành công!", "Cảm ơn bạn đã đánh giá!", "success")
                            .then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        var errorMsg = "Có lỗi xảy ra khi lưu đánh giá";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        swal("Lỗi!", errorMsg, "error");
                    }
                });
            });
        }
        
        // Handle image upload and preview
        $(document).on('change', '.rating-image-input', function() {
            var file = this.files[0];
            var productId = $(this).attr('id').split('-')[2];
            var preview = $('#preview-' + productId);
            
            if (file) {
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    swal("Lỗi!", "Vui lòng chọn file hình ảnh", "error");
                    return;
                }
                
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    swal("Lỗi!", "Kích thước file không được vượt quá 2MB", "error");
                    return;
                }
                
                // Create preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.html('<img src="' + e.target.result + '" alt="Preview">');
                    preview.show();
                };
                reader.readAsDataURL(file);
            } else {
                preview.hide();
            }
        });
        
    });
</script>
</body>

</html>



