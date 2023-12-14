@extends('user.ajax_cart')

@foreach($shop_sum as $shop_cart)
                        <div class="cart-table-left-all">
                            <div class="cart-table-left-shop">
                                <div class="cart-table-left-shop-info">
                                    <div class="cart-table-left-shop-icon">
                                        <div class="cart-table-left-shop-img">
                                            <a href="#">
                                                <img id="cart-table-left-shop-img" src="{{asset('storage/'.$shop_cart->product_cart[0]->shopImg )}}" alt="">
                                            </a>    
                                            </div>
                                        <div class="cart-table-left-shop-name">
                                            <a  id="cart-table-left-shop-name" href="#">
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
                                                <a href="#">
                                                    <img id="table-left-product-img" src="{{asset('storage/'.$product->product_image)}}" alt="">
                                                </a>
                                            </div>
                                            <div class="table-left-product-name">
                                                <a id="table-left-product-name" href="#">
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
                                        <form method="POST" class="cart-form" id="cart-form">
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
