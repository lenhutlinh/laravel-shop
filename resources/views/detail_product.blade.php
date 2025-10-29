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
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
    <title>{{$products->productName}}</title>
</head>
<style>
    input[type="radio"] {
        display: none;
    }
    input[type="radio"]:checked + label {
    color: #0b4f6c;
    color: var(--theme-color, #0b4f6c);
    border-color: #0b4f6c;
    border-color: var(--theme-color, #0b4f6c);
    }
    
    /* Star rating styles */
    .fa-star-o {
        color: #ddd !important;
    }
    
    .fa-star-half-o {
        color: #ffc107 !important;
    }
    
    .product-detail-rate .fa {
        font-size: 16px;
        margin-right: 2px;
    }
    
    
    /* Comment Section Styles */
    .comment-section-container {
        width: 100%;
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .comment-section {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        border-radius: 20px;
        padding: 30px;
        margin: 20px 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 900px;
        border: 1px solid rgba(238, 77, 45, 0.1);
        position: relative;
        overflow: hidden;
        margin-left: auto;
        margin-right: auto;
    }
    
    .comment-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ee4d2d 0%, #ff6b35 50%, #ee4d2d 100%);
    }
    
    .comment-section-header {
        font-size: 24px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #ee4d2d;
        text-align: center;
        position: relative;
        background: linear-gradient(135deg, #1a1a1a 0%, #ee4d2d 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .comment-section-header::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #ee4d2d 0%, #ff6b35 100%);
        border-radius: 2px;
    }
    
    .comment-item {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        border: 1px solid #e9ecef;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        border-left: 5px solid #ee4d2d;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .comment-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(180deg, #ee4d2d 0%, #ff6b35 100%);
    }
    
    .comment-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .comment-user-info {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .comment-user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 15px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .comment-user-name {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 15px;
        margin-right: 15px;
    }
    
    .comment-date {
        color: #666;
        font-size: 13px;
        background: #f8f9fa;
        padding: 4px 8px;
        border-radius: 10px;
    }
    
    .comment-content {
        color: #333;
        line-height: 1.6;
        font-size: 15px;
        margin-top: 10px;
        padding-left: 55px;
    }
    
    .no-comments {
        text-align: center;
        padding: 60px 30px;
        color: #666;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        border: 2px dashed #ccc;
        margin: 20px 0;
    }
    
    .no-comments-icon {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.6;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }
    
    .no-comments-text {
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: 600;
    }
    
    .no-comments-subtext {
        font-size: 15px;
        color: #999;
    }
    
    /* Responsive Design for Comment Section */
    @media (max-width: 768px) {
        .comment-section-container {
            padding: 0 15px;
            margin: 30px auto;
            width: 100%;
            max-width: 100%;
        }
        
        .comment-section {
            padding: 20px;
            border-radius: 15px;
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }
        
        .comment-section-header {
            font-size: 20px;
            margin-bottom: 20px;
        }
        
        .comment-item {
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .comment-user-avatar {
            width: 35px;
            height: 35px;
            margin-right: 12px;
        }
        
        .comment-user-name {
            font-size: 14px;
            margin-right: 12px;
        }
        
        .comment-content {
            font-size: 14px;
            padding-left: 47px;
        }
    }
    
    @media (max-width: 480px) {
        .comment-section-container {
            padding: 0 10px;
            margin: 20px auto;
            width: 100%;
            max-width: 100%;
        }
        
        .comment-section {
            padding: 15px;
            border-radius: 12px;
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }
        
        .comment-section-header {
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .comment-item {
            padding: 12px;
            margin-bottom: 12px;
        }
        
        .comment-user-avatar {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
        
        .comment-user-name {
            font-size: 13px;
            margin-right: 10px;
        }
        
        .comment-content {
            font-size: 13px;
            padding-left: 40px;
        }
    }
    
    /* Additional centering for all screen sizes */
    @media (min-width: 1200px) {
        .comment-section-container {
            max-width: 1000px;
        }
        
        .comment-section {
            max-width: 1000px;
        }
    }
    
    @media (min-width: 1400px) {
        .comment-section-container {
            max-width: 1200px;
        }
        
        .comment-section {
            max-width: 1200px;
        }
    }
    
    /* Rating Filter Styles */
    .rating-filters {
        display: flex;
        gap: 12px;
        margin-bottom: 25px;
        flex-wrap: wrap;
        justify-content: center;
        padding: 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    
    .filter-btn {
        padding: 12px 20px;
        border: 2px solid #e9ecef;
        background: #fff;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
        min-width: 100px;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .filter-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }
    
    .filter-btn:hover::before {
        left: 100%;
    }
    
    .filter-btn:hover {
        border-color: #ee4d2d;
        color: #ee4d2d;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(238, 77, 45, 0.3);
    }
    
    .filter-btn.active {
        background: linear-gradient(135deg, #ee4d2d 0%, #ff6b35 100%);
        color: white;
        border-color: #ee4d2d;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(238, 77, 45, 0.4);
    }
    
    .filter-btn .star-icon {
        font-size: 16px;
        filter: drop-shadow(0 1px 2px rgba(0,0,0,0.1));
    }
    
    .filter-btn .count {
        background: rgba(255,255,255,0.25);
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        margin-left: 6px;
        min-width: 20px;
        text-align: center;
        backdrop-filter: blur(10px);
    }
    
    .filter-btn:not(.active) .count {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #666;
        border: 1px solid #dee2e6;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .rating-filters {
            gap: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .filter-btn {
            padding: 10px 16px;
            font-size: 13px;
            min-width: 80px;
        }
        
        .filter-btn .star-icon {
            font-size: 14px;
        }
        
        .filter-btn .count {
            padding: 3px 6px;
            font-size: 11px;
        }
    }
    
    @media (max-width: 480px) {
        .rating-filters {
            gap: 6px;
            padding: 12px;
        }
        
        .filter-btn {
            padding: 8px 12px;
            font-size: 12px;
            min-width: 70px;
        }
        
        .filter-btn .star-icon {
            font-size: 12px;
        }
        
        .filter-btn .count {
            padding: 2px 5px;
            font-size: 10px;
        }
    }
    
    /* Zoom scaling */
    @media (min-resolution: 1.5dppx) {
        .rating-filters {
            transform: scale(0.95);
        }
    }
    
    @media (min-resolution: 2dppx) {
        .rating-filters {
            transform: scale(0.9);
        }
    }
    
    /* Enhanced Rating Items */
    .rating-item {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        border: 1px solid #e9ecef;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .rating-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #ee4d2d 0%, #ff6b35 100%);
    }
    
    .rating-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .rating-user {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .user-info {
        flex: 1;
    }
    
    .user-name {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 15px;
        margin-bottom: 5px;
    }
    
    .rating-stars {
        display: flex;
        gap: 3px;
        margin-bottom: 5px;
    }
    
    .rating-stars span {
        font-size: 16px;
        filter: drop-shadow(0 1px 2px rgba(0,0,0,0.1));
    }
    
    .rating-date {
        color: #999;
        font-size: 12px;
        background: #f8f9fa;
        padding: 3px 8px;
        border-radius: 8px;
    }
    
    .rating-comment {
        color: #333;
        line-height: 1.6;
        font-size: 15px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 15px;
        border-radius: 10px;
        border-left: 4px solid #ee4d2d;
        margin-top: 10px;
    }
    
    /* Responsive for Rating Items */
    @media (max-width: 768px) {
        .rating-item {
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
        }
        
        .user-name {
            font-size: 14px;
        }
        
        .rating-stars span {
            font-size: 14px;
        }
        
        .rating-comment {
            font-size: 14px;
            padding: 12px;
        }
    }
    
    @media (max-width: 480px) {
        .rating-item {
            padding: 12px;
            margin-bottom: 12px;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
        }
        
        .user-name {
            font-size: 13px;
        }
        
        .rating-stars span {
            font-size: 12px;
        }
        
        .rating-comment {
            font-size: 13px;
            padding: 10px;
        }
    }
</style>
<body>
    
    <header>
        @include('header')
    </header>
    <main >
        <div class="detail-center">
            <form id="form-detail">
                @csrf
                <div class="page-product">
                <div class="page-product-detail">
                    <div class="page-product-detail-left">
                        <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="mySwiper"
                            thumbs-swiper=".mySwiper2" space-between="10" navigation="true">
                            @foreach($products_images as $key => $image)
                            <swiper-slide>
                                <img src="{{asset('storage/'.$image->imageProduct)}}" style="height:525px"/>
                            </swiper-slide>
                            @endforeach
                        </swiper-container>

                        <swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true"
                            watch-slides-progress="true">
                            @foreach($products_images as $key => $image)
                            <swiper-slide>
                                <img src="{{asset('storage/'.$image->imageProduct)}}" style="height:100px"/>
                            </swiper-slide> 
                            @endforeach
                        </swiper-container>
                    </div>
                    <div class="flex flex-auto RBf1cu">
                    
                        <div class="flex-auto flex-column swTqJe ">
                            <div class="product-detail-title">
                                <span>
                                    {{$products->productName}}
                                </span>
                            </div>
                            <div class="product-detail-proper">
                                <div class="product-detail-rate">
                                    @if($totalRatings > 0)
                                        <span class="checked" style="font-size: 16px"><u>{{number_format($averageRating, 1)}}</u></span> 
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $averageRating)
                                                <span class="fa fa-star checked"></span>
                                            @elseif($i - 0.5 <= $averageRating)
                                                <span class="fa fa-star-half-o checked"></span>
                                            @else
                                                <span class="fa fa-star-o"></span>
                                            @endif
                                        @endfor
                                    @else
                                        <span class="checked" style="font-size: 16px"><u>0.0</u></span> 
                                        <span class="fa fa-star-o"></span>
                                        <span class="fa fa-star-o"></span>
                                        <span class="fa fa-star-o"></span>
                                        <span class="fa fa-star-o"></span>
                                        <span class="fa fa-star-o"></span>
                                    @endif
                                </div>
                                <div class="product-detail-number-review">
                                    <div style="font-size: 17px; margin-right: 5px;">
                                        <u>{{$totalRatings}}</u>
                                    </div>
                                    <div style="color:darkgrey; ">
                                        Đánh Giá
                                    </div>
                                </div>
                                <div class="product-detail-number-review">
                                    <div style="font-size: 17px; margin-right: 5px;">
                                        <u>{{$product_sale->sales_quantity}} </u>
                                    </div>
                                    <div style="color:darkgrey;  ">
                                        Đã Bán
                                    </div>
                                </div>
                            </div>
                            <div class="product-detail-price">
                                <div id="product-detail-price">
                                    {{number_format($products->price, 0, ',', '.')}}đ
                                
                                </div>
                            </div>
                            <div class="h-y3ij">
                                <div class="flex flex-column">
                                    <div class="flex rY0UiC j9be9C">
                                        <div class="flex flex-column">
                                            @if(isset($var_option))
                                                <div class="flex items-center" style="margin-bottom: 8px; align-items: baseline;">
                                                    <label class="oN9nMU">
                                                        @foreach($var_option as $key => $var_option)
                                                            {{$var_option->variationName}}
                                                        @endforeach
                                                    </label>
                                                    <div class="flex items-center bR6mEk">
                                                        @if(($combination_string[0]->combination_string)=='')
                                                            @foreach($combination_string as $key => $combination)
                                                                <input hidden checked type="radio" data-avai_stock="{{$combination -> avaiable_stock}}" data-combi_id="{{$combination -> id}}"  id="{{$combination->combination_string}}" value="{{$combination->combination_string}}" name="combination" class="choose_variation" >
                                                            @endforeach
                                                        @else
                                                            @foreach($combination_string as $key => $combination)
                                                                <input type="radio" data-avai_stock="{{$combination -> avaiable_stock}}" data-combi_id="{{$combination -> id}}" id="{{$combination->combination_string}}" value="{{$combination->combination_string}}" name="combination" class="choose_variation" required>
                                                                <label class="product-variation"  for="{{$combination->combination_string}}" name="combination" required> {{$combination->combination_string}}</label>
                                                                <input type="hidden" name="avaiable_stock"  value="{{$combination->avaiable_stock}}" class="avaiable_stock_{{$combination -> id}}">
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="flex items-center _6lioXX">
                                                <div class="oN9nMU">Số lượng</div>
                                                <div class="flex items-center">
                                                    <div style="margin-right: 15px;">
                                                        <div class="Z+JGL3 shopee-input-quantity">
                                                            <span id="minus" class="EquXA8" >
                                                                <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0" class="shopee-svg-icon">
                                                                    <polygon points="4.5 4.5 3.5 4.5 0 4.5 0 5.5 3.5 5.5 4.5 5.5 10 5.5 10 4.5"></polygon>
                                                                </svg>
                                                            </span>
                                                            <input id="number"  class="EquXA8 Wrmraq quantity{{$products -> id}}" type="text" role="spinbutton" aria-valuenow="1" value="1" required number>
                                                            <span id="plus" class="EquXA8">
                                                                <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0" class="shopee-svg-icon icon-plus-sign">
                                                                    <polygon points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5"></polygon>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <span class="show_avaiable">{{$sum_avaialbe}} sản phẩm có sẵn</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>               
                                </div>
                            </div>
                            <div style="margin-top: 15px;">
                                <div class="ThEIyI">
                                    <div class="p+UZsF">
                                        <button type="button" data-id_product="{{$products->id }}" class="btn btn-tinted btn--l iFo-rx QA-ylc add-to-cart" aria-disabled="false" >
                                            <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon tDviDD icon-add-to-cart">
                                                <g>
                                                    <g>
                                                        <polyline fill="none" points=".5 .5 2.7 .5 5.2 11 12.4 11 14.5 3.5 3.7 3.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"></polyline>
                                                        <circle cx="6" cy="13.5" r="1" stroke="none"></circle>
                                                        <circle cx="11.5" cy="13.5" r="1" stroke="none"></circle>
                                                    </g>
                                                    <line fill="none" stroke-linecap="round" stroke-miterlimit="10" x1="7.5" x2="10.5" y1="7" y2="7"></line>
                                                    <line fill="none" stroke-linecap="round" stroke-miterlimit="10" x1="9" x2="9" y1="8.5" y2="5.5"></line>
                                                </g>
                                            </svg>
                                            
                                            <input type="hidden"  value="{{$products->shop_id}}" class="shop_id_{{$products -> id}}">
                                            <input type="hidden"  value="{{$products->id}}" class="product_id_{{$products -> id}}">
                                            <input type="hidden"  value="{{$products->productName }}" class="productName{{$products -> id }}">
                                            <input type="hidden"  value="{{ $products -> previewImage}}" class="previewImage{{$products -> id }}">
                                            <input type="hidden"  value="{{$products->price}}" class="price{{$products -> id }}">
                                                
                                            <span>Thêm Vào Giỏ Hàng</span>
                                        </button>
                                        <span type="button" class="btn btn-solid-primary btn--l iFo-rx " id="buy_now" aria-disabled="false" data-id_product="{{$products->id }}" >Mua Ngay
                                            <input type="hidden"  value="{{$products->shop_id}}" class="shop_id_{{$products -> id}}">
                                            <input type="hidden"  value="{{$products->id}}" class="product_id_{{$products -> id}}">
                                            <input type="hidden"  value="{{$products->productName }}" class="productName{{$products -> id }}">
                                            <input type="hidden"  value="{{ $products -> previewImage}}" class="previewImage{{$products -> id }}">
                                            <input type="hidden"  value="{{$products->price}}" class="price{{$products -> id }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            </form>
            <div class=" page-product-shop">
                <div class="NLeTwo page-product__shop" data-testid="product_shop_pdp">
                    <div class="jwlMoy">
                        <a class="W0LQye" href="{{route('view_shop',$shop->id)}}">
                            <div class="shopee-avatar UadQpu" data-testid="shop_avatar_image_pdp">
                                <div class="shopee-avatar__placeholder">
                                    <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon icon-headshot">
                                        <g>
                                            <circle cx="7.5" cy="4.5" fill="none" r="3.8" stroke-miterlimit="10"></circle>
                                            <path d="m1.5 14.2c0-3.3 2.7-6 6-6s6 2.7 6 6" fill="none" stroke-linecap="round" stroke-miterlimit="10"></path>
                                        </g>
                                    </svg>
                                </div>
                                <img class="shopee-avatar__img" src="{{asset('storage/'.$shop -> shopImg)}}">
                            </div>
                        </a>
                        <div class="oAVg4E">
                            <div class="VlDReK" data-testid="shop_name_pdp">{{$shop->shopname }}</div>
                            <div class="TaEoi4">
                                <div class="zSXxlI" data-testid="seller_active_time_pdp">Online 3 giờ trước</div>
                            </div>
                            <div class="Uwka-w">
                                <a href="{{route('show_chat',$shop->id)}}" class="btn btn-tinted btn--s btn--inline Q-sdJs" data-testid="shop_chat_now_button_pdp">
                                    <svg viewBox="0 0 16 16" class="shopee-svg-icon JWAQyX">
                                        <g fill-rule="evenodd">
                                        <path d="M15 4a1 1 0 01.993.883L16 5v9.932a.5.5 0 01-.82.385l-2.061-1.718-8.199.001a1 1 0 01-.98-.8l-.016-.117-.108-1.284 8.058.001a2 2 0 001.976-1.692l.018-.155L14.293 4H15zm-2.48-4a1 1 0 011 1l-.003.077-.646 8.4a1 1 0 01-.997.923l-8.994-.001-2.06 1.718a.5.5 0 01-.233.108l-.087.007a.5.5 0 01-.492-.41L0 11.732V1a1 1 0 011-1h11.52zM3.646 4.246a.5.5 0 000 .708c.305.304.694.526 1.146.682A4.936 4.936 0 006.4 5.9c.464 0 1.02-.062 1.608-.264.452-.156.841-.378 1.146-.682a.5.5 0 10-.708-.708c-.185.186-.445.335-.764.444a4.004 4.004 0 01-2.564 0c-.319-.11-.579-.258-.764-.444a.5.5 0 00-.708 0z"></path>
                                        </g>
                                    </svg>Chat ngay
                                </a>
                                <a class="btn btn-light btn--s btn--inline btn-light--link Vf+pt4" data-testid="btn_light" href="{{route('view_shop',$shop->id)}}">
                                    <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" stroke-width="0" class="shopee-svg-icon _9Sz-n3">
                                        <path d="m13 1.9c-.2-.5-.8-1-1.4-1h-8.4c-.6.1-1.2.5-1.4 1l-1.4 4.3c0 .8.3 1.6.9 2.1v4.8c0 .6.5 1 1.1 1h10.2c.6 0 1.1-.5 1.1-1v-4.6c.6-.4.9-1.2.9-2.3zm-11.4 3.4 1-3c .1-.2.4-.4.6-.4h8.3c.3 0 .5.2.6.4l1 3zm .6 3.5h.4c.7 0 1.4-.3 1.8-.8.4.5.9.8 1.5.8.7 0 1.3-.5 1.5-.8.2.3.8.8 1.5.8.6 0 1.1-.3 1.5-.8.4.5 1.1.8 1.7.8h.4v3.9c0 .1 0 .2-.1.3s-.2.1-.3.1h-9.5c-.1 0-.2 0-.3-.1s-.1-.2-.1-.3zm8.8-1.7h-1v .1s0 .3-.2.6c-.2.1-.5.2-.9.2-.3 0-.6-.1-.8-.3-.2-.3-.2-.6-.2-.6v-.1h-1v .1s0 .3-.2.5c-.2.3-.5.4-.8.4-1 0-1-.8-1-.8h-1c0 .8-.7.8-1.3.8s-1.1-1-1.2-1.7h12.1c0 .2-.1.9-.5 1.4-.2.2-.5.3-.8.3-1.2 0-1.2-.8-1.2-.9z"></path>
                                    </svg>xem shop
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="Po6c6I">
                        <div class="Odudp+">
                            <div class="R7Q8ES _07yPll" data-testid="shop_ratings_section_pdp">
                                <label class="siK1qW">Đánh giá</label>
                                <span class="Xkm22X">chưa rõ</span>
                            </div>
                            <a class="p48aHT _07yPll" data-testid="shop_products_section_pdp" href="{{route('view_shop', $shop->id)}}">
                                <label class="siK1qW">Sản phẩm</label>
                                <span class="Xkm22X vUG3KX">{{$product_count}}</span>
                            </a>
                        </div>
                        <div class="Odudp+">
                            <div class="R7Q8ES _07yPll" data-testid="shop_response_rate_section_pdp">
                                <label class="siK1qW">tỉ lệ phản hồi</label>
                                <span class="Xkm22X">tốt</span>
                            </div>
                            <div class="R7Q8ES _07yPll" data-testid="shop_response_time_section_pdp">
                                <label class="siK1qW">thời gian phản hồi</label>
                                <span class="Xkm22X">trong vài giờ</span>
                            </div>
                        </div>
                        <div class="Odudp+">
                            <div class="R7Q8ES _07yPll" data-testid="shop_joined_section_pdp">
                                <label class="siK1qW">tham gia</label>
                                <span class="Xkm22X">{{$created_at}} Ngày</span>
                            </div>
                            <div class="R7Q8ES _07yPll" data-testid="shop_follower_section_pdp">
                                <label class="siK1qW">Người theo dõi</label>
                                <span class="Xkm22X">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="page-product__content">
                <div class="page-product__content--left colum-7-5">
                    <div class="product-detail page-product__detail">
                        <div class="U9rGd1">
                            <div class="Iv7FJp">CHI TIẾT SẢN PHẨM</div>
                            <div class="MCCLkq">
                                <div class="dR8kXc">
                                    <label class="zquA4o">Danh Mục</label>
                                    <div class="flex items-center RnKf-X">
                                        <a class="akCPfg KvmvO1" href="{{route('index')}}">VieS</a>
                                        <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="shopee-svg-icon xprSzi icon-arrow-right">
                                            <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path>
                                        </svg>
                                        <a class="akCPfg KvmvO1" href="{{route('category_products',$category->categoryName)}}">{{$category->categoryName}}</a>
                                        <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="shopee-svg-icon xprSzi icon-arrow-right">
                                            <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path>
                                        </svg>
                                        <a class="akCPfg KvmvO1" href="{{route('category_products',$category->categoryName)}}">{{$subcategory->subCategoryName}}</a>
                
                                    </div>
                                </div>
                                <!-- <div class="dR8kXc">
                                    <label class="zquA4o">Địa chỉ tổ chức chịu trách nhiệm sản xuất</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Chất liệu</label>
                                        <div>Nỉ, Da</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Xuất xứ</label>
                                        <div>Việt Nam</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Thương hiệu</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Dòng sản phẩm</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Năm sản xuất</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Model</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Kích thước</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Màu sắc</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Trọng lượng</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Bảo hành</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Hướng dẫn sử dụng</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Hướng dẫn bảo quản</label>
                                        <div>Đang cập nhật</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Lưu ý khác</label>
                                        <div>Đang cập nhật</div>
                                    </div> -->
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Tồn kho</label>
                                        <div>{{$sum_avaialbe}}</div>
                                    </div>
                                    <div class="dR8kXc">
                                        <label class="zquA4o">Mô tả</label>
                                        <div>{{$products->description}}</div>
                                    </div>
                                   
                    </div>
                </div>
                <div class="page-product__content--right colum-2-5">
                    <div style="display: contents;">
                        <div class="product-shop-vouchers page-product__shop-voucher"><div class="product-shop-vouchers__header">Mã giảm giá của Shop</div><div class="product-shop-vouchers__list" tabindex="-1" style="max-height: 23.25rem;"><div class="vc_Card_container vc_product-detail-page-vouchers_pcProductVoucher nBBX45 Y56Uu-"><div class="vc_Card_card"><div class="vc_Card_left"><div class="vc_Card_sawtooth"></div></div><div class="vc_Card_right"></div><div class="vc_VoucherStandardTemplate_hideOverflow"></div><div class="vc_VoucherStandardTemplate_template"><div class="vc_product-detail-page-vouchers_pcProductVoucherMiddle vc_VoucherStandardTemplate_middle"><div class="vc_MainTitle_mainTitle"><div class="vc_MainTitle_text">Giảm ₫3k</div></div><div class="vc_Subtitle_subTitle">Đơn Tối Thiểu ₫150k</div><div class="vc_Label_label"></div><div class="vc_ProgressBarExpiry_progressBarExpiry"><div class="vc_ProgressBarExpiry_usageLimitedText"><span class="vc_ProgressBarExpiry_validUntil vc_ProgressBarExpiry_capitalize">HSD: 17.03.2023</span></div></div></div><div class="vc_product-detail-page-vouchers_pcProductVoucherRight vc_VoucherStandardTemplate_right"><div></div><div class="vc_VoucherStandardTemplate_center"><div class="vc_RectButton_rectButton"><div class="vc_RectButton_btn vc_RectButton_claim">Lưu</div></div></div><div></div></div></div></div></div><div class="vc_Card_container vc_product-detail-page-vouchers_pcProductVoucher nBBX45 Y56Uu-"><div class="vc_Card_card"><div class="vc_Card_left"><div class="vc_Card_sawtooth"></div></div><div class="vc_Card_right"></div><div class="vc_VoucherStandardTemplate_hideOverflow"></div><div class="vc_VoucherStandardTemplate_template"><div class="vc_product-detail-page-vouchers_pcProductVoucherMiddle vc_VoucherStandardTemplate_middle"><div class="vc_MainTitle_mainTitle"><div class="vc_MainTitle_text">Giảm ₫5k</div></div><div class="vc_Subtitle_subTitle">Đơn Tối Thiểu ₫250k</div><div class="vc_Label_label"></div><div class="vc_ProgressBarExpiry_progressBarExpiry"><div class="vc_ProgressBarExpiry_usageLimitedText"><span class="vc_ProgressBarExpiry_validUntil vc_ProgressBarExpiry_capitalize">HSD: 18.03.2023</span></div></div></div><div class="vc_product-detail-page-vouchers_pcProductVoucherRight vc_VoucherStandardTemplate_right"><div></div><div class="vc_VoucherStandardTemplate_center"><div class="vc_RectButton_rectButton"><div class="vc_RectButton_btn vc_RectButton_claim">Lưu</div></div></div><div></div></div></div></div></div></div></div></div></div>
            </div>
        
        </div>
        
        
        </div>
        

        <!-- Comment Section - Inside main, at the bottom -->
        <div class="comment-section-container">
            <div class="comment-section">
                <div class="comment-section-header">Đánh giá và bình luận sản phẩm</div>
                
                <!-- Rating Summary -->
                @if($totalRatings > 0)
                <div class="rating-summary" style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                    <div class="average-rating" style="display: flex; align-items: center; gap: 10px;">
                        <div class="rating-stars" style="display: flex; gap: 2px;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $averageRating)
                                    <span style="color: #ffc107; font-size: 20px;">★</span>
                                @elseif($i - 0.5 <= $averageRating)
                                    <span style="color: #ffc107; font-size: 20px;">☆</span>
                                @else
                                    <span style="color: #ddd; font-size: 20px;">★</span>
                                @endif
                            @endfor
                        </div>
                        <span style="font-size: 18px; font-weight: 600; color: #1a1a1a;">{{number_format($averageRating, 1)}}</span>
                    </div>
                    <div class="rating-count" style="color: #666; font-size: 14px;">
                        Dựa trên {{$totalRatings}} đánh giá
                    </div>
                </div>
                
                <!-- Rating Distribution -->
                <div class="rating-distribution" style="margin-bottom: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                    <h4 style="margin: 0 0 15px 0; color: #1a1a1a; font-size: 16px;">Phân phối đánh giá</h4>
                    @for($star = 5; $star >= 1; $star--)
                    <div class="rating-bar" style="display: flex; align-items: center; margin-bottom: 8px;">
                        <span style="width: 20px; font-size: 14px; color: #666;">{{$star}}★</span>
                        <div style="flex: 1; height: 8px; background: #e9ecef; border-radius: 4px; margin: 0 10px; overflow: hidden;">
                            <div style="height: 100%; background: #ffc107; width: {{$totalRatings > 0 ? ($ratingCounts[$star] / $totalRatings) * 100 : 0}}%; transition: width 0.3s ease;"></div>
                        </div>
                        <span style="width: 30px; font-size: 12px; color: #666; text-align: right;">{{$ratingCounts[$star]}}</span>
                    </div>
                    @endfor
                </div>
                @endif
                
                <!-- Rating Filters -->
                @if($totalRatings > 0)
                <div class="rating-filters">
                    <button class="filter-btn active" data-rating="all">
                        Tất cả
                        <span class="count">{{$totalRatings}}</span>
                    </button>
                    <button class="filter-btn" data-rating="5">
                        <span class="star-icon">★</span> 5 sao
                        <span class="count">{{$ratingCounts[5]}}</span>
                    </button>
                    <button class="filter-btn" data-rating="4">
                        <span class="star-icon">★</span> 4 sao
                        <span class="count">{{$ratingCounts[4]}}</span>
                    </button>
                    <button class="filter-btn" data-rating="3">
                        <span class="star-icon">★</span> 3 sao
                        <span class="count">{{$ratingCounts[3]}}</span>
                    </button>
                    <button class="filter-btn" data-rating="2">
                        <span class="star-icon">★</span> 2 sao
                        <span class="count">{{$ratingCounts[2]}}</span>
                    </button>
                    <button class="filter-btn" data-rating="1">
                        <span class="star-icon">★</span> 1 sao
                        <span class="count">{{$ratingCounts[1]}}</span>
                    </button>
                </div>
                @endif
                
                <!-- Ratings List -->
                @if($totalRatings > 0)
                <div class="ratings-list" id="ratings-list" style="display: flex; flex-direction: column; gap: 20px; margin-bottom: 30px;">
                    @foreach($ratings as $rating)
                    <div class="rating-item" data-rating="{{$rating->rating}}" style="background: #fff; border: 1px solid #e9ecef; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <div class="rating-user" style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                            <div class="user-avatar" style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden;">
                                @if($rating->userImg)
                                    <img src="{{asset('storage/'.$rating->userImg)}}" alt="User" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="{{asset('storage/users_img/user.png')}}" alt="User" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <div class="user-info">
                                <div class="user-name" style="font-weight: 600; color: #1a1a1a; font-size: 14px;">{{$rating->firstname}} {{$rating->lastname}}</div>
                                <div class="rating-stars" style="display: flex; gap: 2px; margin-top: 2px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $rating->rating)
                                            <span style="color: #ffc107; font-size: 14px;">★</span>
                                        @else
                                            <span style="color: #ddd; font-size: 14px;">★</span>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div class="rating-date" style="margin-left: auto; color: #999; font-size: 12px;">
                                {{date('d/m/Y', strtotime($rating->created_at))}}
                            </div>
                        </div>
                        @if($rating->comment)
                        <div class="rating-comment" style="color: #333; line-height: 1.6; font-size: 14px; background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #ee4d2d;">
                            {{$rating->comment}}
                        </div>
                        @endif
                        @if(isset($rating->image) && $rating->image)
                        <div class="rating-image" style="margin-top: 10px;">
                            <img src="{{asset('storage/'.$rating->image)}}" alt="Rating image" style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer;" onclick="openImageModal('{{asset('storage/'.$rating->image)}}')">
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <div class="no-ratings-message" style="text-align: center; padding: 60px 20px; color: #999; background: #f8f9fa; border-radius: 12px; margin-bottom: 30px;">
                    <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">⭐</div>
                    <div style="font-size: 16px;">Chưa có đánh giá nào cho sản phẩm này</div>
                    <div style="font-size: 14px; margin-top: 8px;">Hãy là người đầu tiên đánh giá sản phẩm!</div>
                </div>
                @endif
                
        
            </div>
        </div>

    </main>
    
    <!-- Image Modal -->
    <div id="imageModal" class="image-modal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8);">
        <div class="modal-content" style="position: relative; margin: auto; padding: 0; width: 90%; max-width: 800px; top: 50%; transform: translateY(-50%);">
            <span class="close" onclick="closeImageModal()" style="position: absolute; top: 15px; right: 35px; color: #fff; font-size: 40px; font-weight: bold; cursor: pointer; z-index: 10000;">&times;</span>
            <img id="modalImage" src="" alt="Rating image" style="width: 100%; height: auto; border-radius: 8px;">
        </div>
    </div>
    
    <footer>
        @include('footer')
    </footer>

@include('detail_js')
</body> 
</html>



