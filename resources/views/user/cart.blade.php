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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
    
    <title>Giỏ Hàng</title>
    <style>
		label.error{
			color: red;
            font-size: 14px;
            display: block;
            font-weight: 400;
		}
        .error {
            color: #5a5c69;
            /* font-size: 7rem; */
            font-size: 16px;
            line-height: 1;
           
        }
	</style>
</head>
<body>
    
    <header>
        @include('header')  
    </header>
    <main >
        <div class="cart-center">
        @if(Session::get('count_cart') != 0)
            <div class="page-cart">

                <div class="cart-title">
                    <h2 class="cart-title-h">Giỏ hàng của bạn </h2>
                </div>
                <form method="GET" action="{{route('checkout')}}" class="cart-form" id="cart-form">
                    
                <div class="cart-table">
                    <div class="cart-table-left" id="cart-table-left">
                        @foreach($shop_sum as $shop_cart)
                        <div class="cart-table-left-all">
                            <div class="cart-table-left-shop">
                                <div class="cart-table-left-shop-info">
                                    <div class="cart-table-left-shop-icon">
                                        <div class="cart-table-left-shop-img">
                                            <a href="{{route('view_shop',$shop_cart -> shop_id)}}">
                                                <img id="cart-table-left-shop-img" src="{{asset('storage/'.$shop_cart->product_cart[0]->shopImg )}}" alt="">
                                            </a>    
                                        </div>
                                        <div class="cart-table-left-shop-name">
                                            <a  id="cart-table-left-shop-name" href="{{route('view_shop',$shop_cart -> shop_id)}}">
                                                <span >{{$shop_cart->product_cart[0]->shopname }}</span>
                                            </a>
                                        </div>   
                                    </div>
                                    <div class="cart-table-left-shop-choice">
                                        <input type="radio" name="choice-shop" class="choose_shop_cart" id="shop_id_{{$shop_cart -> shop_id}}" value="{{$shop_cart->shop_id}}" data-shop_id="{{$shop_cart->shop_id}}" style="width:16px; height:16px;" required>
                                        <span class="cart-choice-shop">
                                            Chọn tất cả sản phẩm  
                                        </span>
                                        
                                    </div>
                                </div>
                                @foreach($shop_cart->product_cart as $product)
                                <input type="hidden" id="cart_id_{{$product -> id}}" value="{{$product->id}}">
                                <div class="cart-table-left-product">
                                    <div class="table-left-product">

                                        <div class="table-left-product-info colum-5">
                                            <div class="table-left-product-img">
                                                <a href="{{route('detail_product',$product -> product_id)}}">
                                                    <img id="table-left-product-img" src="{{asset('storage/'.$product->product_image)}}" alt="">
                                                </a>
                                            </div>
                                            <div class="table-left-product-name">
                                                <a id="table-left-product-name" href="{{route('detail_product',$product -> product_id)}}">
                                                    <span>{{$product->productName}}</span>
                                                </a>
                                                <div class="table-left-product-type">
                                                    @if($product->combination == "")
                                                        <span id="table-left-product-type">Mặc định</span>
                                                    @else
                                                    Phân Loại: <span id="table-left-product-type">{{$product->combination}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-left-product-price colum-2">
                                            <span id="table-left-product-price">{{$product->product_price}}</span> 
                                        </div>
                                        <div class="table-left-product-quantity colum-2">
                                        <form method="POST" class="cart-form" >
                                            @csrf
                                            <div class="Z+JGL3 shopee-input-quantity">
                                                <!-- Giam so luong -->
                                                <span id="minus_cart_{{$product -> id}}" class="EquXA8 minus_cart" data-avai_stock="{{$product->avaiable_stock }}"  data-id_cart="{{$product->id }}">
                                                    <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0" class="shopee-svg-icon">
                                                        <polygon points="4.5 4.5 3.5 4.5 0 4.5 0 5.5 3.5 5.5 4.5 5.5 10 5.5 10 4.5"></polygon>
                                                    </svg>
                                                </span>

                                                <input id="number_cart_{{$product -> id}}" type="number" data-id_cart="{{$product->id }}" data-avai_stock="{{$product->avaiable_stock }}" class="EquXA8 Wrmraq quantity367 number_cart"  aria-valuenow="1" value="{{$product->quantity}}" required >
                                                <!-- Tang so luong -->
                                                <span id="plus_cart_{{$product -> id}}" class="EquXA8 plus_cart" data-avai_stock="{{$product->avaiable_stock }}"  data-id_cart="{{$product->id }}">
                                                    <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0" class="shopee-svg-icon icon-plus-sign">
                                                        <polygon points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5"></polygon>
                                                    </svg>
                                                </span>
                                            </div>
                                            </form>
                                        </div>
                                        <div class="table-left-product-tool colum-1">
                                            <a href="#" class="table-left-product-tools">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                            <span  class="table-left-product-tools delete_cart"  data-id_cart="{{$product->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                      
                        @endforeach
                    </div>
                    <div class="cart-table-right">
                        <div class="cart-table-right-top">
                            <div class="cart-table-right-coupon">
                                <div class="cart-table-right-coupon-name">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                        <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                      </svg>
                                    <span id="cart-table-right-coupon-name">
                                        Mã giảm giá
                                    </span>
                                </div>
                                <div class="cart-table-right-coupon-choice">
                                    <span>
                                        Chọn mã
                                    </span>
                                </div>
                            </div>  
                        </div>
                        <div class="cart-table-right-bot">
                            <span class="cart-table-right-bot-span">
                                Tạm tính : 
                            </span>
                            <div class="cart-table-right-bot-price">
                                <div class="cart-table-right-bot-price-new">
                                    <span id="cart-table-right-bot-price-new"> </span>đ
                                </div>
                                <!-- <div class="cart-table-right-bot-price-old">
                                    <span id="cart-table-right-bot-price-old">300.000đ</span>
                                </div> -->
                            </div>
                        </div>
                        <div class="cart-table-right-bot">
                            <div class="cart-table-right-bot-btn">
                                <button type="submit" id="cart-table-right-bot-btn">
                                    <span id="table-right-bot-btn-span">Mua ngay</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        @else
        <div class="review_payment">
            <div class="thankfororder">
                <div class="tick">
                    <img src="https://cdn-icons-png.flaticon.com/512/4539/4539472.png" class="tickcheck">
                </div>
                <div class="thanks">
                    <p>
                        Bạn chưa có sản phẩm nào trong giỏ hàng <span class="shopname"> </span>
                    </p>
                </div>
            </div>

            <div class="footer_payment">
                    <a href="{{route('index')}}" class="back-a" alt="Trang Chủ">
                        <i class="fa-solid fa-angle-left"></i>TIẾP TỤC MUA SẮM
                    </a>
            </div> 
        </div>
        @endif
       </div>
    </main>
    <footer>
       @include('footer')
    </footer>

@include('user.ajax_cart')

</body>
</html>



