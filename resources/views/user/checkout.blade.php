<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css " />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/fontawesome.min.css " />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/brands.min.css " />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/solid.min.css " />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/regular.min.css " />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript">
    </script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">

    <title>Đặt Hàng</title>
    <style>
    label.error {
        color: red;
        font-size: 14px;
        display: block;
        font-weight: 400;
    }
    
    .shipping-cost-display {
        font-weight: 700;
        color: #2c3e50;
        transition: all 0.3s ease;
    }
    
    .shipping-cost-display.has-distance {
        color: #27ae60;
        cursor: help;
    }
    
    .shipping-cost-display:hover {
        transform: scale(1.05);
    }

    .error {
        color: #5a5c69;
        /* font-size: 7rem; */
        font-size: 14px;
        line-height: 1;

    }
    </style>
</head>

<body>
    @include('header')
    <main>
        <div class="checkout-center">
            <div class="page-checkout">
                <div class="checkout-title">
                    <div id="checkout-title">
                        <h3 class="checkout-title-h">XÁC NHẬN - THANH TOÁN</h3>
                    </div>
                </div>
                <form method="POST" action="{{route('order')}}" class="checkout-table" id="form-checkout">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{$shop->id ?? ''}}">
                    <input type="hidden" name="shipping_cost" id="shipping_cost_input" value="0">
                    <div class="checkout-table">
                        <div class="checkout-table-left">
                            <div class="table-left-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                                <span class="checkout-table-left-span">Thông Tin Nhận Hàng</span>
                            </div>
                            <div class="table-left-info">
                                <div class="table-left-info-title colum-2-5">
                                    <div for="" id="table-left-info-title">
                                        Họ Tên Người Nhận
                                    </div>
                                </div>
                                <input type="text" class="colum-7-5 table-left-info-input" name="ship_name" required>

                            </div>
                            <div class="table-left-info">
                                <div class="table-left-info-title colum-2-5">
                                    <div for="" id="table-left-info-title">
                                        Số điện thoại
                                    </div>
                                </div>
                                <input type="text" class="colum-7-5 table-left-info-input" name="ship_phonenumber">
                            </div>
                            <div class="table-left-info">
                                <div class="table-left-info-title colum-2-5">
                                    <div for="" id="table-left-info-title">
                                        Tỉnh/Thành phố
                                    </div>
                                </div>
                                <select id="province" name="province" class="colum-7-5 table-left-info-input"></select>

                            </div>
                            <div class="table-left-info">
                                <div class="table-left-info-title colum-2-5">
                                    <div for="" id="table-left-info-title">
                                        Quận/Huyện
                                    </div>
                                </div>
                                <select id="district" name="district" class="colum-7-5 table-left-info-input">
                                    <option value="">Chọn Quận/Huyện</option>
                                </select>
                            </div>
                            <div class="table-left-info">
                                <div class="table-left-info-title colum-2-5">
                                    <div for="" id="table-left-info-title">
                                        Phường/Xã
                                    </div>
                                </div>
                                <select id="ward" name="ward" class="colum-7-5 table-left-info-input">
                                    <option value="">Chọn Phường/Xã</option>
                                </select>
                            </div>
                            <div class="table-left-info">
                                <div class="table-left-info-title colum-2-5">
                                    <div for="" id="table-left-info-title">
                                        Địa Chỉ Cụ Thể
                                    </div>
                                </div>

                                <input type="text" class="colum-7-5 table-left-info-input" name="detail_address">
                                <select hidden id="address" name="pre_address" class="colum-7-5 table-left-info-input">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="table-left-info">
                                <div class="table-left-info-title colum-2-5">
                                    <div for="" id="table-left-info-title">
                                        Email
                                    </div>
                                </div>
                                <input type="text" class="colum-7-5 table-left-info-input"
                                    placeholder="(Không bắt buộc)" name="ship_email">
                            </div>
                            <div class="table-left-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-truck" viewBox="0 0 16 16">
                                    <path
                                        d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg>
                                <span class="checkout-table-left-span">Phương Thức Thanh Toán</span>
                            </div>
                            <div class="table-left-info">

                                <span>
                                    <label class="pay">
                                        <input type="radio" name="payment_option" value="0" checked> Thanh Toán Khi Nhận
                                        Hàng
                                    </label>
                                </span>
                                <span>
                                    <label class="pay">
                                        <input type="radio" name="payment_option" value="1"> Thanh Toán chuyển khoản
                                    </label>
                                </span>

                            </div>
                        </div>
                        <div class="checkout-table-right">
                            <div class="table-right-title">
                                <svg width="20px" height="20px" viewBox="0 0 24 24">
                                    <defs>
                                        <path id="CartCheckIcon_icon_svg__a" d="M21 22V2H3v20z"></path>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <mask id="CartCheckIcon_icon_svg__b" fill="#fff">
                                            <use xlink:href="#CartCheckIcon_icon_svg__a"></use>
                                        </mask>
                                        <path fill="#348FE9"
                                            d="M10 18l-4-4 1.41-1.41L10 15.17l6.59-6.59L18 10l-8 8zm2-14c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm7 0h-4.18C14.4 2.84 13.3 2 12 2c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z"
                                            mask="url(#CartCheckIcon_icon_svg__b)"></path>
                                    </g>
                                </svg>
                                <span class="checkout-table-right-span">Thông Tin Đơn Hàng</span>
                            </div>
                            <div class="table-right-info">
                                <div class="table-right-info-shop">
                                    <span>Bán bởi shop:</span>
                                    <strong style="margin: 0 4px;">
                                        {{$shop->shopname ?? 'N/A'}}
                                    </strong>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        class="bi bi-shop" viewBox="0 0 16 16">
                                        <path
                                            d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                                    </svg>
                                </div>
                                @foreach($product_cart as $product)
                                <div class="table-right-info-item">
                                    <div class="table-left-info-product">
                                        <div class="table-left-info-img">
                                            <img id="table-left-info-img"
                                                src="{{asset('storage/'.$product->product_image)}}" alt="">
                                        </div>
                                        <div class="table-left-info-product-pro">
                                            <p class="table-left-info-product-pro-p">
                                                {{$product->productName}}
                                            </p>
                                            <div class="table-left-info-product-price">
                                                <strong
                                                    id="table-left-info-product-price">{{number_format($product->product_price, 0, ',', '.') }}
                                                </strong>
                                                <span class="">x {{$product->quantity}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-right-info-product-var">
                                        <span id="table-left-info-product-var" ::>{{$product->combination }}</span>
                                        <!-- <span style="border-right: 0.1px solid #979797; margin-right: 12px;"></span>
                                    <span id="table-left-info-product-var">đen</span> -->
                                    </div>
                                </div>
                                @endforeach
                                <div class="table-right-info-coupon">
                                    <div class="table-right-info-coupon-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                            fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                            <path
                                                d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z" />
                                            <path
                                                d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z" />
                                        </svg>
                                        <span id="table-right-info-coupon-title">Mã giảm giá</span>
                                    </div>
                                    <div class="table-right-info-coupon-choice" data-toggle="modal"
                                        data-target="#logoutModal">
                                        <span id="table-right-info-coupon-choice">Chọn/nhập mã</span>
                                    </div>
                                </div>
                                <div class="divider_14oT"></div>
                                <div>
                                    <textarea class="input_3p8-" name="note" placeholder="Ghi chú cho Shop"
                                        maxlength="1000" tabindex="5"></textarea>
                                </div>
                            </div>
                            <div class="table-right-info">
                                <div class="table-right-info-price-product">
                                    <div id="table-right-info-price-product">
                                        <span>Tiền hàng</span>
                                        <span
                                            style="font-weight: 700;">{{number_format($total_price, 0, ',', '.')}}đ</span>
                                    </div>
                                    <div id="table-right-info-price-product">
                                        <span>Phí ship</span>
                                        <span id="shipping-cost" style="font-weight: 700; color: #e74c3c;">Đang tính...</span>
                                    </div>
                                </div>
                                <div class="table-right-info-price-product">
                                    <div id="table-right-info-price-product" class="coupon_number_display">

                                    </div>
                                </div>
                                <div style="padding-top: 16px;">
                                    <div class="table-right-info-totalCost">
                                        <span>Tổng thanh toán</span>
                                        @php
                                        // Phí ship sẽ được tính động, không cộng cố định
                                        Session::put('total_price', $total_price);
                                        @endphp
                                        <span name="total_price" id="total-price"
                                            class="table-right-info-totalPrice">{{number_format($total_price, 0, ',', '.')}}đ</span>
                                    </div>
                                    <button class="button_1J3c" tabindex="6">ĐẶT HÀNG</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        @include('footer')
    </footer>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form style="height:100%; width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chọn hoặc nhập 1 mã giảm giá</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @csrf
                    <div class="modal-body">
                        <!-- Mã giảm giá chung -->
                        <div class="mb-3">
                            <label class="form-label"><strong>Mã giảm giá chung</strong></label>
                            <select class="form-control choose_coupon" data-total_price="{{$total_price}}" id="common_coupon">
                                <option value="">Chọn mã giảm giá chung</option>
                                @foreach ($coupon as $item)
                                <option value="{{$item->coupon_code}}">{{$item->coupon_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Mã giảm giá riêng -->
                        <div class="mb-3">
                            <label class="form-label"><strong>Mã giảm giá riêng</strong></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="input_private_coupon"
                                    placeholder="Nhập mã giảm giá riêng" id="input_private_coupon">
                                <button class="btn btn-success" type="button" id="apply_private_coupon" data-total_price="{{$total_price}}">
                                    Áp dụng
                                </button>
                            </div>
                            <small class="form-text text-muted">Mã giảm giá riêng có thể sử dụng cùng với mã chung</small>
                        </div>
                        
                        <!-- Hiển thị mã đã áp dụng -->
                        <div id="applied_coupons" class="mt-3">
                            <!-- Sẽ được cập nhật bằng JavaScript -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @extends('user.ajax_checkout')
    
    <!-- Include dual coupon JavaScript -->
    <script>
        // Set routes for JavaScript
        window.routes = {
            choose_coupon: '{{ route("choose_coupon") }}',
            private_coupons_check: '{{ route("private_coupons.check") }}'
        };
        window.totalPrice = {{$total_price}};
    </script>
    <script src="{{asset('js/dual-coupon.js')}}"></script>
    
    <script>
        // Hệ thống tính phí ship mới - đơn giản và hiệu quả
        let currentShippingCost = 0;
        let productPrice = {{ $total_price }};
        
        // Hàm lấy tọa độ từ địa chỉ
        function getCoordinatesFromAddress(address) {
            // Database tọa độ đầy đủ 63 tỉnh/thành phố Việt Nam
            const coordinatesDB = {
                // Thành phố trực thuộc Trung ương
                'Hà Nội': { lat: 21.0285, lng: 105.8542 },
                'TP. Hồ Chí Minh': { lat: 10.8231, lng: 106.6297 },
                'Hồ Chí Minh': { lat: 10.8231, lng: 106.6297 },
                'TP Hồ Chí Minh': { lat: 10.8231, lng: 106.6297 },
                'TP.HCM': { lat: 10.8231, lng: 106.6297 },
                'TPHCM': { lat: 10.8231, lng: 106.6297 },
                'Sài Gòn': { lat: 10.8231, lng: 106.6297 },
                'Đà Nẵng': { lat: 16.0544, lng: 108.2022 },
                'Hải Phòng': { lat: 20.8449, lng: 106.6881 },
                'Cần Thơ': { lat: 10.0452, lng: 105.7469 },
                
                // Vùng Đông Bắc Bộ
                'Hà Giang': { lat: 22.7662, lng: 104.9380 },
                'Cao Bằng': { lat: 22.6657, lng: 106.2577 },
                'Lào Cai': { lat: 22.3381, lng: 103.8440 },
                'Điện Biên': { lat: 21.3862, lng: 103.0230 },
                'Lai Châu': { lat: 22.3687, lng: 103.4400 },
                'Sơn La': { lat: 21.3257, lng: 103.9178 },
                'Yên Bái': { lat: 21.7168, lng: 104.8986 },
                'Hoà Bình': { lat: 20.8136, lng: 105.3382 },
                'Thái Nguyên': { lat: 21.5672, lng: 105.8252 },
                'Lạng Sơn': { lat: 21.8537, lng: 106.7613 },
                'Quảng Ninh': { lat: 21.0064, lng: 107.2925 },
                'Bắc Giang': { lat: 21.2733, lng: 106.1946 },
                'Phú Thọ': { lat: 21.3614, lng: 105.3131 },
                'Vĩnh Phúc': { lat: 21.3609, lng: 105.5474 },
                'Bắc Ninh': { lat: 21.1861, lng: 106.0763 },
                'Hải Dương': { lat: 20.9373, lng: 106.3146 },
                'Hưng Yên': { lat: 20.6534, lng: 106.0513 },
                'Thái Bình': { lat: 20.4465, lng: 106.3421 },
                'Hà Nam': { lat: 20.5411, lng: 105.9229 },
                'Nam Định': { lat: 20.4388, lng: 106.1621 },
                'Ninh Bình': { lat: 20.2506, lng: 105.9744 },
                
                // Vùng Bắc Trung Bộ
                'Thanh Hóa': { lat: 19.8077, lng: 105.7842 },
                'Nghệ An': { lat: 18.6792, lng: 105.6882 },
                'Hà Tĩnh': { lat: 18.3428, lng: 105.9059 },
                'Quảng Bình': { lat: 17.4683, lng: 106.6000 },
                'Quảng Trị': { lat: 16.7500, lng: 107.2000 },
                'Thừa Thiên Huế': { lat: 16.4637, lng: 107.5909 },
                'Huế': { lat: 16.4637, lng: 107.5909 },
                
                // Vùng Nam Trung Bộ
                'Quảng Nam': { lat: 15.8801, lng: 108.3380 },
                'Quảng Ngãi': { lat: 15.1167, lng: 108.8000 },
                'Bình Định': { lat: 13.8750, lng: 109.1119 },
                'Phú Yên': { lat: 13.0882, lng: 109.0929 },
                'Khánh Hòa': { lat: 12.2388, lng: 109.1967 },
                'Nha Trang': { lat: 12.2388, lng: 109.1967 },
                'Ninh Thuận': { lat: 11.5648, lng: 108.9881 },
                'Bình Thuận': { lat: 10.9289, lng: 108.1021 },
                
                // Vùng Tây Nguyên
                'Kon Tum': { lat: 14.3545, lng: 108.0076 },
                'Gia Lai': { lat: 13.9838, lng: 108.0006 },
                'Đắk Lắk': { lat: 12.6667, lng: 108.0500 },
                'Đắk Nông': { lat: 12.0042, lng: 107.6907 },
                'Lâm Đồng': { lat: 11.9404, lng: 108.4583 },
                'Đà Lạt': { lat: 11.9404, lng: 108.4583 },
                
                // Vùng Đông Nam Bộ
                'Bình Phước': { lat: 11.6471, lng: 106.6056 },
                'Tây Ninh': { lat: 11.3131, lng: 106.1093 },
                'Bình Dương': { lat: 11.3254, lng: 106.4774 },
                'Đồng Nai': { lat: 10.9574, lng: 106.8429 },
                'Bà Rịa - Vũng Tàu': { lat: 10.3460, lng: 107.0843 },
                'Bà Rịa Vũng Tàu': { lat: 10.3460, lng: 107.0843 },
                'Vũng Tàu': { lat: 10.3460, lng: 107.0843 },
                
                // Vùng Đồng bằng sông Cửu Long
                'Long An': { lat: 10.6086, lng: 106.6714 },
                'Tiền Giang': { lat: 10.3600, lng: 106.3600 },
                'Bến Tre': { lat: 10.2404, lng: 106.3756 },
                'Trà Vinh': { lat: 9.9347, lng: 106.3453 },
                'Vĩnh Long': { lat: 10.2401, lng: 105.9572 },
                'Sóc Trăng': { lat: 9.6004, lng: 105.9800 },
                'An Giang': { lat: 10.5216, lng: 105.1259 },
                'Kiên Giang': { lat: 9.8249, lng: 105.1259 },
                'Phú Quốc': { lat: 10.2899, lng: 103.9840 },
                'Cà Mau': { lat: 9.1767, lng: 105.1524 },
                'Bạc Liêu': { lat: 9.2945, lng: 105.7272 },
                'Hậu Giang': { lat: 9.7843, lng: 105.4701 },
                
                // Các tỉnh còn thiếu - Bắc Trung Bộ
                'Bắc Kạn': { lat: 22.1500, lng: 105.8333 },
                'Tuyên Quang': { lat: 21.8167, lng: 105.2167 },
                
                // Các tỉnh còn thiếu - Đông Nam Bộ
                'Bà Rịa Vũng Tàu': { lat: 10.3460, lng: 107.0843 },
                'BR-VT': { lat: 10.3460, lng: 107.0843 },
                
                // Các tỉnh còn thiếu - Tây Nguyên
                'Đắk Lắk': { lat: 12.6667, lng: 108.0500 },
                'Đắk Nông': { lat: 12.0042, lng: 107.6907 },
                
                // Các tỉnh còn thiếu - Đồng bằng sông Cửu Long
                'Đồng Tháp': { lat: 10.4500, lng: 105.6333 },
                
                // Các tên gọi khác của tỉnh
                'TP HCM': { lat: 10.8231, lng: 106.6297 },
                'TP.HCM': { lat: 10.8231, lng: 106.6297 },
                'TPHCM': { lat: 10.8231, lng: 106.6297 },
                'Sài Gòn': { lat: 10.8231, lng: 106.6297 },
                'Nha Trang': { lat: 12.2388, lng: 109.1967 },
                'Đà Lạt': { lat: 11.9404, lng: 108.4583 },
                'Huế': { lat: 16.4637, lng: 107.5909 },
                'Vũng Tàu': { lat: 10.3460, lng: 107.0843 },
                'Phú Quốc': { lat: 10.2899, lng: 103.9840 }
            };
            
            // Tìm tọa độ dựa trên địa chỉ
            for (const [province, coords] of Object.entries(coordinatesDB)) {
                if (address.includes(province)) {
                    return coords;
                }
            }
            
            return null;
        }
        
        // Tính phí ship
        function calculateShipping() {
            console.log('🚚 Bắt đầu tính phí ship...');
            
            const shopId = {{ $shop->id ?? 'null' }};
            if (!shopId) {
                console.log('❌ Không có shop ID');
                showShippingCost(0, 'Không có thông tin shop');
                return;
            }
            
            // Lấy địa chỉ
            let fullAddress = '';
            const detailAddress = document.querySelector('input[name="detail_address"]')?.value || '';
            const provinceSelect = document.querySelector('select[name="province"]');
            const districtSelect = document.querySelector('select[name="district"]');
            const wardSelect = document.querySelector('select[name="ward"]');
            
            if (provinceSelect?.value && districtSelect?.value && wardSelect?.value) {
                const provinceText = provinceSelect.options[provinceSelect.selectedIndex].text;
                const districtText = districtSelect.options[districtSelect.selectedIndex].text;
                const wardText = wardSelect.options[wardSelect.selectedIndex].text;
                fullAddress = `${detailAddress}, ${wardText}, ${districtText}, ${provinceText}`;
            }
            
            if (!fullAddress) {
                console.log('❌ Chưa chọn địa chỉ');
                showShippingCost(0, 'Vui lòng chọn địa chỉ');
                return;
            }
            
            console.log('📍 Địa chỉ:', fullAddress);
            
            // Lấy tọa độ
            const coords = getCoordinatesFromAddress(fullAddress);
            if (!coords) {
                console.log('❌ Không tìm thấy tọa độ');
                showShippingCost(0, 'Không xác định được vị trí');
                return;
            }
            
            console.log('🗺️ Tọa độ:', coords);
            
            // Tính phí ship nhanh (fallback)
            const instantCost = calculateFallbackShipping(coords);
            currentShippingCost = instantCost;
            showShippingCost(instantCost, 'Phí ship ước tính', null, false);
            
            // Gọi API tính phí ship chính xác (background)
            setTimeout(() => {
                fetch('{{ route("calculate.shipping") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        address: fullAddress,
                        shop_id: shopId,
                        latitude: coords.lat,
                        longitude: coords.lng
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('✅ Kết quả API:', data);
                    if (data.success) {
                        // Chỉ cập nhật nếu khác biệt đáng kể (>10%)
                        const difference = Math.abs(data.shipping_cost - instantCost) / instantCost;
                        if (difference > 0.1) {
                            currentShippingCost = data.shipping_cost;
                            showShippingCost(data.shipping_cost, data.message, data.distance, false);
                        }
                    }
                })
                .catch(error => {
                    console.error('❌ Lỗi API:', error);
                    // Giữ nguyên giá fallback
                });
            }, 100);
        }
        
        // Hiển thị phí ship
        function showShippingCost(cost, message, distance = null, isCalculating = false) {
            const element = document.getElementById('shipping-cost');
            if (!element) return;
            
            let displayText;
            if (cost === 0) {
                displayText = '0đ';
                element.style.color = '#27ae60'; // Xanh lá cho 0đ
            } else {
                displayText = new Intl.NumberFormat('vi-VN').format(cost) + 'đ';
                if (cost <= 20000) {
                    element.style.color = '#27ae60'; // Xanh lá cho phí thấp
                } else if (cost <= 40000) {
                    element.style.color = '#f39c12'; // Cam cho phí trung bình
                } else {
                    element.style.color = '#e74c3c'; // Đỏ cho phí cao
                }
            }
            
            element.textContent = displayText;
            element.title = message;
            
            // Cập nhật hidden input cho shipping cost
            const shippingInput = document.getElementById('shipping_cost_input');
            if (shippingInput) {
                shippingInput.value = cost;
            }
            
            // Cập nhật tổng tiền (chỉ khi không đang tính)
            if (!isCalculating) {
                updateTotalPrice();
            }
        }
        
        // Tính phí ship fallback (nhanh) - sử dụng tọa độ shop thực tế
        function calculateFallbackShipping(coords) {
            // Lấy tọa độ shop từ server (sẽ được truyền từ PHP)
            const shopId = {{ $shop->id ?? 'null' }};
            if (!shopId) {
                return 30000; // Phí mặc định nếu không có shop
            }
            
            // Kiểm tra shop có đăng ký vị trí không
            const shopHasLocation = {{ (isset($shop->latitude) && isset($shop->longitude) && $shop->latitude && $shop->longitude) ? 'true' : 'false' }};
            
            if (!shopHasLocation) {
                return 30000; // Shop chưa đăng ký vị trí = 30.000đ
            }
            
            // Lấy tọa độ shop thực tế từ PHP
            const shopCoords = { 
                lat: {{ $shop->latitude ?? 'null' }}, 
                lng: {{ $shop->longitude ?? 'null' }} 
            };
            
            if (!shopCoords.lat || !shopCoords.lng) {
                return 30000; // Shop chưa đăng ký vị trí = 30.000đ
            }
            
            // Tính khoảng cách đơn giản
            const distance = calculateSimpleDistance(shopCoords, coords);
            
            // Áp dụng bảng giá mới
            if (distance <= 5) return 15000;
            if (distance <= 20) return 20000;
            if (distance <= 50) return 25000;
            if (distance <= 100) return 30000;
            if (distance <= 200) return 40000;
            if (distance <= 500) return 50000;
            return 60000;
        }
        
        // Tính khoảng cách đơn giản
        function calculateSimpleDistance(coord1, coord2) {
            const R = 6371; // Bán kính Trái Đất (km)
            const dLat = (coord2.lat - coord1.lat) * Math.PI / 180;
            const dLng = (coord2.lng - coord1.lng) * Math.PI / 180;
            const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                      Math.cos(coord1.lat * Math.PI / 180) * Math.cos(coord2.lat * Math.PI / 180) *
                      Math.sin(dLng/2) * Math.sin(dLng/2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            return R * c;
        }
        
        // Cập nhật tổng tiền
        function updateTotalPrice() {
            const element = document.getElementById('total-price');
            if (element) {
                // Lấy giá trị coupon giảm giá
                let couponDiscount = 0;
                const couponElement = document.querySelector('.coupon_number_display');
                if (couponElement && couponElement.textContent.trim() !== '') {
                    const couponText = couponElement.textContent;
                    
                    // Tìm số tiền giảm giá trong text (ví dụ: "-20.000đ")
                    const match = couponText.match(/-(\d{1,3}(?:[.,]\d{3})*)/);
                    if (match) {
                        // Thay thế dấu phẩy và chấm để parse đúng
                        const cleanNumber = match[1].replace(/[.,]/g, '');
                        couponDiscount = parseInt(cleanNumber);
                    } else {
                        // Thử cách khác: tìm tất cả số và dấu chấm/phẩy
                        const numberMatch = couponText.match(/(\d{1,3}(?:[.,]\d{3})*)/);
                        if (numberMatch) {
                            const cleanNumber = numberMatch[1].replace(/[.,]/g, '');
                            couponDiscount = parseInt(cleanNumber);
                        }
                    }
                }
                
                // Tính tổng: tiền hàng + phí ship - giảm giá
                const total = productPrice + currentShippingCost - couponDiscount;
                element.textContent = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
            }
        }
        
        // Refresh tổng tiền
        function refreshTotalPrice() {
            // Delay một chút để đảm bảo DOM đã được cập nhật
            setTimeout(() => {
                updateTotalPrice();
            }, 100);
        }
        
        // Khởi tạo
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🎯 Khởi tạo hệ thống tính phí ship');
            
            // Set initial shipping cost to 0đ
            showShippingCost(0, 'Chưa chọn địa chỉ');
            
            // Tính phí ship ban đầu
            setTimeout(calculateShipping, 500);
            
            // Thêm event listeners
            const inputs = [
                'input[name="detail_address"]',
                'select[name="province"]',
                'select[name="district"]',
                'select[name="ward"]'
            ];
            
            inputs.forEach(selector => {
                const element = document.querySelector(selector);
                if (element) {
                    element.addEventListener('change', calculateShipping);
                    element.addEventListener('input', calculateShipping);
                }
            });
        });
        
        // Đăng ký global
        window.calculateShipping = calculateShipping;
        window.refreshTotalPrice = refreshTotalPrice;
        
        // Thêm observer để theo dõi thay đổi coupon
        document.addEventListener('DOMContentLoaded', function() {
            const couponElement = document.querySelector('.coupon_number_display');
            if (couponElement) {
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'childList' || mutation.type === 'characterData') {
                            // Delay một chút để đảm bảo DOM đã được cập nhật
                            setTimeout(() => {
                                updateTotalPrice();
                            }, 200);
                        }
                    });
                });
                observer.observe(couponElement, {
                    childList: true,
                    characterData: true,
                    subtree: true
                });
            }
        });
    </script>
</body>

</html>