<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/fontawesome.min.css "/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/brands.min.css "/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/solid.min.css "/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/regular.min.css "/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">    
    <title>Đơn mua</title>
</head>
<body>
    
    <header>
        @include('header')
    </header>
    <main >
        @csrf 
        <div class="container pIHdXn">
            <div class="kul4+s">
                <div class="AmWkJQ">
                    <a class="_1O4r+C" href="/user/account/profile">
                        <div class="shopee-avatar">
                            <div class="shopee-avatar__placeholder">
                                <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon icon-headshot">
                                    <g>
                                        <circle cx="7.5" cy="4.5" fill="none" r="3.8" stroke-miterlimit="10"></circle>
                                        <path d="m1.5 14.2c0-3.3 2.7-6 6-6s6 2.7 6 6" fill="none" stroke-linecap="round" stroke-miterlimit="10"></path>
                                    </g>
                                </svg>
                            </div>
                            @php
                            $user_img = Session::get('user_img');
                            @endphp
                            @if(Session::get('user_img') != null)
                            <img class="shopee-avatar__img" src="{{asset('storage/'.$user_img)}}">
                            @else
                            <img class="shopee-avatar__img" src="{{asset('storage/users_img/user.png')}}">
                            @endif
                        </div>
                    </a>
                    <div class="miwGmI">
                        <div class="mC1Llc">{{Session::get('user_name') }}</div>
                            <div>
                                <a class="_78QHr1" href="">
                                    <svg width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" style="margin-right: 4px;">
                                        <path d="M8.54 0L6.987 1.56l3.46 3.48L12 3.48M0 8.52l.073 3.428L3.46 12l6.21-6.18-3.46-3.48" fill="#9B9B9B" fill-rule="evenodd"></path>
                                    </svg>Sửa hồ sơ
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="rhmIbk">
                        <div class="stardust-dropdown">
                            <div class="stardust-dropdown__item-header">
                                <a class="+1U02e" href="{{route('user_account')}}">
                                    <div class="bfikuD">
                                        <img src="https://down-vn.img.susercontent.com/file/ba61750a46794d8847c3f463c5e71cc4">
                                    </div>
                                    <div class="DlL0zX">
                                        <span class="adF7Xs">Tài khoản của tôi</span>
                                    </div>
                                </a>
                            </div>
                           
                        </div>
                        <div class="stardust-dropdown stardust-dropdown--open">
                            <div class="stardust-dropdown__item-header">
                                <a class="+1U02e wkLUkx" href="{{route('user_purchase')}}">
                                    <div class="bfikuD">
                                        <img src="https://down-vn.img.susercontent.com/file/f0049e9df4e536bc3e7f140d071e9078">
                                    </div>
                                    <div class="DlL0zX">
                                        <span class="adF7Xs">Đơn Mua</span>
                                    </div>
                                </a>
                            </div>
                          
                        </div>
                        <div class="stardust-dropdown">
                            <div class="stardust-dropdown__item-header">
                                <a class="+1U02e" href="{{route('chat_user')}}">
                                    <div class="bfikuD">
                                        <img src="https://down-vn.img.susercontent.com/file/e10a43b53ec8605f4829da5618e0717c">
                                    </div>
                                    <div class="DlL0zX">
                                        <span class="adF7Xs">Tin Nhắn</span>
                                    </div>
                                </a>
                            </div>
                            
                        </div>
                        <div class="stardust-dropdown">
                            <div class="stardust-dropdown__item-header">
                                <a class="+1U02e" href="{{route('user_password')}}">
                                    <div class="bfikuD">
                                        <img src="https://down-vn.img.susercontent.com/file/84feaa363ce325071c0a66d3c9a88748">
                                    </div>
                                    <div class="DlL0zX">
                                        <span class="adF7Xs">Đổi mật khẩu</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xMDeox">
                    <div style="display: contents;">
                        <div class="--tO6n">
                            <div class="VYJdTQ">
                                <a class="OFl2GI gAImis" href="">
                                    <span class="_20hgQK">Tất cả</span>
                                </a>
                                <a class="OFl2GI" href="">
                                    <span class="_20hgQK">Chờ thanh toán</span>
                                </a>
                                <a class="OFl2GI" href="">
                                    <span class="_20hgQK">Vận chuyển</span>
                                </a>
                                <a class="OFl2GI" href="">
                                    <span class="_20hgQK">Đang giao</span>
                                </a><a class="OFl2GI" href="">
                                    <span class="_20hgQK">Hoàn thành</span>
                                </a><a class="OFl2GI" href="">
                                    <span class="_20hgQK">Đã hủy</span>
                                </a>
                                <a class="OFl2GI" href="">
                                    <span class="_20hgQK">Trả hàng/Hoàn tiền</span>
                                </a>
                            </div>
                            <div></div>
                            <div class="VrgkXA">
                                <svg width="19px" height="19px" viewBox="0 0 19 19">
                                    <g id="Search-New" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="my-purchase-copy-27" transform="translate(-399.000000, -221.000000)" stroke-width="2">
                                            <g id="Group-32" transform="translate(400.000000, 222.000000)">
                                                <circle id="Oval-27" cx="7" cy="7" r="7"></circle>
                                                <path d="M12,12 L16.9799555,16.919354" id="Path-184" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <input autocomplete="off" placeholder="Bạn có thể tìm kiếm theo tên Shop, ID đơn hàng hoặc Tên Sản phẩm" value="">
                            </div>
                            <div>
                                @foreach($orders as $key => $order)
                                <div class="hiXKxx">
                                    <div>
                                        <div class="x0QT2k">
                                            <div class="KrPQEI">
                                                <div class="qCUYY8">
                                                    <div>
                                                        <div class="cart-table-left-shop-img">
                                                            <a href="{{route('view_shop',$order -> shop_id)}}">
                                                                <img id="cart-table-left-shop-img" src="{{asset('storage/'.$order->shopImg )}}" alt="">
                                                            </a>    
                                                        </div>
                                                    </div>
                                                    <div class="_9Ro5mP">{{$order->shopname }} </div>
                                                    <a class="yHlRfY" href="{{route('show_chat',$order -> shop_id)}}">
                                                        <button class="stardust-button stardust-button--primary">
                                                            <svg viewBox="0 0 17 17" class="shopee-svg-icon icon-btn-chat" style="fill: white;">
                                                                <g fill-rule="evenodd">
                                                                    <path d="M13.89 0C14.504 0 15 .512 15 1.144l-.003.088-.159 2.117.162.001c.79 0 1.46.558 1.618 1.346l.024.15.008.154v9.932a1.15 1.15 0 01-1.779.963l-.107-.08-1.882-1.567-7.962.002a1.653 1.653 0 01-1.587-1.21l-.036-.148-.021-.155-.071-.836h-.01L.91 13.868a.547.547 0 01-.26.124L.556 14a.56.56 0 01-.546-.47L0 13.429V1.144C0 .512.497 0 1.11 0h12.78zM15 4.65l-.259-.001-.461 6.197c-.045.596-.527 1.057-1.106 1.057L4.509 11.9l.058.69.01.08a.35.35 0 00.273.272l.07.007 8.434-.001 1.995 1.662.002-9.574-.003-.079a.35.35 0 00-.274-.3L15 4.65zM13.688 1.3H1.3v10.516l1.413-1.214h10.281l.694-9.302zM4.234 5.234a.8.8 0 011.042-.077l.187.164c.141.111.327.208.552.286.382.131.795.193 1.185.193s.803-.062 1.185-.193c.225-.078.41-.175.552-.286l.187-.164a.8.8 0 011.042 1.209c-.33.33-.753.579-1.26.753A5.211 5.211 0 017.2 7.4a5.211 5.211 0 01-1.706-.28c-.507-.175-.93-.424-1.26-.754a.8.8 0 010-1.132z" fill-rule="nonzero"></path>
                                                                </g>
                                                            </svg>
                                                            <span>chat</span>
                                                        </button>
                                                    </a>
                                                    <a class="_7wKGws" href="{{route('view_shop',$order -> shop_id)}}">
                                                        <button class="stardust-button">
                                                            <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon icon-btn-shop">
                                                                <path d="m15 4.8c-.1-1-.8-2-1.6-2.9-.4-.3-.7-.5-1-.8-.1-.1-.7-.5-.7-.5h-8.5s-1.4 1.4-1.6 1.6c-.4.4-.8 1-1.1 1.4-.1.4-.4.8-.4 1.1-.3 1.4 0 2.3.6 3.3l.3.3v3.5c0 1.5 1.1 2.6 2.6 2.6h8c1.5 0 2.5-1.1 2.5-2.6v-3.7c.1-.1.1-.3.3-.3.4-.8.7-1.7.6-3zm-3 7c0 .4-.1.5-.4.5h-8c-.3 0-.5-.1-.5-.5v-3.1c.3 0 .5-.1.8-.4.1 0 .3-.1.3-.1.4.4 1 .7 1.5.7.7 0 1.2-.1 1.6-.5.5.3 1.1.4 1.6.4.7 0 1.2-.3 1.8-.7.1.1.3.3.5.4.3.1.5.3.8.3zm.5-5.2c0 .1-.4.7-.3.5l-.1.1c-.1 0-.3 0-.4-.1s-.3-.3-.5-.5l-.5-1.1-.5 1.1c-.4.4-.8.7-1.4.7-.5 0-.7 0-1-.5l-.6-1.1-.5 1.1c-.3.5-.6.6-1.1.6-.3 0-.6-.2-.9-.8l-.5-1-.7 1c-.1.3-.3.4-.4.6-.1 0-.3.1-.3.1s-.4-.4-.4-.5c-.4-.5-.5-.9-.4-1.5 0-.1.1-.4.3-.5.3-.5.4-.8.8-1.2.7-.8.8-1 1-1h7s .3.1.8.7c.5.5 1.1 1.2 1.1 1.8-.1.7-.2 1.2-.5 1.5z"></path>
                                                            </svg>
                                                            <span>xem shop</span>
                                                        </button>
                                                    </a>
                                                </div>
                                                @if($order -> order_status == 0)
                                                <div class="EQko8g">
                                                    <div class="qP6Mvo">
                                                        <a class="KmBIg2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="shopee-svg-icon icon-free-shipping-line1" viewBox="0 0 16 16">
                                                                <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z"/>
                                                            </svg>
                                                            <span class="nkmfr2"> Đang chờ xác nhận</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                @elseif($order->order_status == 1)
                                                <div class="EQko8g">
                                                    <div class="qP6Mvo">
                                                        <a class="KmBIg2" >
                                                            <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon icon-free-shipping-line">
                                                                <g>
                                                                    <line fill="none" stroke-linejoin="round" stroke-miterlimit="10" x1="8.6" x2="4.2" y1="9.8" y2="9.8"></line>
                                                                    <circle cx="3" cy="11.2" fill="none" r="2" stroke-miterlimit="10"></circle>
                                                                    <circle cx="10" cy="11.2" fill="none" r="2" stroke-miterlimit="10"></circle>
                                                                    <line fill="none" stroke-miterlimit="10" x1="10.5" x2="14.4" y1="7.3" y2="7.3"></line>
                                                                    <polyline fill="none" points="1.5 9.8 .5 9.8 .5 1.8 10 1.8 10 9.1" stroke-linejoin="round" stroke-miterlimit="10"></polyline>
                                                                    <polyline fill="none" points="9.9 3.8 14 3.8 14.5 10.2 11.9 10.2" stroke-linejoin="round" stroke-miterlimit="10"></polyline>
                                                                </g>
                                                            </svg>
                                                            <span class="nkmfr21"> Đã được xác nhận</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                @elseif($order->order_status == 2)
                                                <div class="EQko8g">
                                                    <div class="qP6Mvo">
                                                        <a class="KmBIg2" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" shopee-svg-icon icon-free-shipping-line2" viewBox="0 0 16 16">
                                                                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                            <span class="nkmfr22"> Đã bị hủy</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="FycaKn"></div>
                                            @foreach($order->order_product as $product)
                                            <div> 
                                                <div class="_0OiaZ-">
                                                    <div class="FbLutl">
                                                        <div>
                                                            <span class="x7nENX">
                                                                <div></div>
                                                                <div class="aybVBK">
                                                                    <div class="rGP9Yd">
                                                                        <div class="shopee-image__wrapper">
                                                                            <div class="shopee-image__place-holder">
                                                                                <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon icon-loading-image">
                                                                                    <g>
                                                                                        <rect fill="none" height="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" width="10" x="1" y="4.5"></rect>
                                                                                        <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="1" x2="11" y1="6.5" y2="6.5"></line>
                                                                                        <rect fill="none" height="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" width="3" x="11" y="6.5"></rect>
                                                                                        <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="1" x2="11" y1="14.5" y2="14.5"></line>
                                                                                        <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="6" x2="6" y1=".5" y2="3"></line>
                                                                                        <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="3.5" x2="3.5" y1="1" y2="3"></line>
                                                                                        <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="8.5" x2="8.5" y1="1" y2="3"></line>
                                                                                    </g>
                                                                                </svg>
                                                                            </div>
                                                                            <a href="{{route('detail_product',$product -> product_id)}}">
                                                                                <img class="shopee-image__content" style="background-image: url({{asset('storage/'.$product->previewImage)}});">
                                                                            </a>
                                                                            <div class="shopee-image__content--blur"> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="_7uZf6Q">
                                                                    <div>
                                                                        <div class="iJlxsT">
                                                                            <span class="x5GTyN">{{$product->product_name }}</span>
                                                                        </div>
                                                                    </div>
                                                                    @if($product->product_combination != null)
                                                                    <div>
                                                                        <div class="vb0b-P">Phân loại hàng: {{$product->product_combination }}</div>
                                                                        <div class="_3F1-5M">x{{$product->product_quantity}}</div>
                                                                        <!-- <span class="_8ex9dW">7 ngày trả hàng</span> -->
                                                                    </div>
                                                                    @else
                                                                        <div class="_3F1-5M">x{{$product->product_quantity}}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="_9UJGhr"><div>
                                                                <!-- <span class="j2En5+">₫169.000</span> -->
                                                                <span class="-x3Dqh OkfGBc">{{number_format($product->product_price, 0, ',', '.')}}₫</span>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                                    <div class="Cde7Oe"></div>
                                                </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="O2KPzo"><div class="mn7INg xFSVYg"> </div><div class="mn7INg EfbgJE"> </div></div>

                                    <div class="kvXy0c">
                                        <div class="-78s2g">
                                            
                                            <div class="_0NMXyN">Thành tiền:</div>
                                            <div class="DeWpya">{{number_format($order->order_total, 0, ',', '.')}}₫</div>
                                        </div>
                                    </div>
                                    @if($order->order_status == 0)
                                    <div class="AM4Cxf">
                                        <div class="qtUncs">
                                        </div>
                                        <div class="EOjXew">
                                            <div class="PF0-AU">
                                                <button   data-order_id="{{$order->id}}"  class="stardust-button stardust-button--primary WgYvse user_cancel_order">Hủy Đơn Hàng</button>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    @elseif($order->order_status == 1 )
                                    <div class="AM4Cxf">
                                        <div class="qtUncs">
                                            <span class="OwGaHA">Đánh giá sản phẩm trước 
                                                <div class="shopee-drawer" id="pc-drawer-id-82" tabindex="0">
                                                    <u class="M7wYu+">10-05-2023</u>
                                                </div>
                                            </span>
                                            <span class="an9g3V">Đánh giá ngay và nhận 200 Xu</span>
                                        </div>
                                        <div class="EOjXew">
                                            <div class="PF0-AU">
                                                <button class="stardust-button stardust-button--primary WgYvse">Đánh giá</button>
                                            </div>
                                            <div class="PgtIur">
                                                <button class="stardust-button stardust-button--secondary WgYvse">Liên hệ Người bán</button>
                                            </div>
                                            <div class="PgtIur">
                                                <button class="stardust-button stardust-button--secondary WgYvse">Mua lại</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- include Ajax  library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function(){
        $('.user_cancel_order').click(function(){
            var order_id = $(this).data('order_id');
            var _token = $('input[name="_token"]').val();
            console.log(order_id);
            swal("Xác Nhận Hủy Đơn Hàng?", {
                buttons: {
                    cancel: "Không",
                    catch: {
                    text: "Xác Nhận",
                    value: "catch",
                    },
                },
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                    $.ajax({
                        url: '{{route('user_cancel_order')}}',
                        method: 'POST',
                        data:{
                            order_id: order_id,
                            _token: _token,
                        },
                        success: function(data){
                            $status = data.status; 
                            $product = data.product;
                            if($status == true){
                                location.reload();
                            }
                            else{
                                swal("");
                            }
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                    break;
                    default:
                      
                }
            });
        });
    });
   
</script>
</body>

</html>



