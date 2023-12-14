<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>"  rel="stylesheet">
    <link href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>"  rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>">
 
    <title>Đặt Hàng</title>
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
            font-size: 14px;
            line-height: 1;
           
        }
	</style>
</head>
<body>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main >
       <div class="checkout-center">
            <div class="page-checkout">
                <div class="checkout-title">
                    <div id="checkout-title">
                        <h3 class="checkout-title-h">XÁC NHẬN - THANH TOÁN</h3>
                    </div>
                </div>
                <form method="POST" action="<?php echo e(route('order_now')); ?>" class="checkout-table" id="form-checkout">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="shop_id" value="<?php echo e($shop->id); ?>">
                    <input type="hidden" name="product_id" value="<?php echo e($product_buy->id); ?>">
                    <input type="hidden" name="quantity" value="<?php echo e($quantity); ?>">
                    <input type="hidden" name="combination" value="<?php echo e($combination); ?>">
                    <input type="hidden" name="combination_id" value="<?php echo e($combination_id); ?>">
                    <input type="hidden" name="price" value="<?php echo e($product_buy->price); ?>">
                    <input type="hidden" name="productName" value="<?php echo e($product_buy->productName); ?>">
                <div class="checkout-table">
                    <div class="checkout-table-left">
                        <div class="table-left-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            </svg>
                            <span class="checkout-table-left-span">Thông Tin Nhận Hàng</span>
                        </div>
                        <div class="table-left-info">
                            <div class="table-left-info-title colum-2-5" >
                                <div for="" id="table-left-info-title" >
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
                            <select  id="province" name="province" class="colum-7-5 table-left-info-input" ></select>
                            
                        </div>
                        <div class="table-left-info">
                            <div class="table-left-info-title colum-2-5">
                                <div for="" id="table-left-info-title">
                                    Quận/Huyện
                                </div>
                            </div>
                            <select  id="district" name="district" class="colum-7-5 table-left-info-input" >
                                <option  value="">Chọn Quận/Huyện</option>
                            </select>
                        </div>
                        <div class="table-left-info">
                            <div class="table-left-info-title colum-2-5">
                                <div for="" id="table-left-info-title">
                                    Phường/Xã
                                </div>
                            </div>
                            <select id="ward" name="ward" class="colum-7-5 table-left-info-input" >
                                <option   value="">Chọn Phường/Xã</option>
                            </select>
                        </div>
                        <div class="table-left-info">
                            <div class="table-left-info-title colum-2-5">
                                <div for="" id="table-left-info-title">
                                    Địa Chỉ Cụ Thể
                                </div>
                            </div>
                            
                            <input type="text"  class="colum-7-5 table-left-info-input" name="detail_address" >
                            <select hidden id="address" name="pre_address" class="colum-7-5 table-left-info-input" >
                                <option  value=""></option>
                            </select>
                        </div>
                        <div class="table-left-info">
                            <div class="table-left-info-title colum-2-5">
                                <div for="" id="table-left-info-title">
                                    Email  
                                </div>
                            </div>
                            <input type="text" class="colum-7-5 table-left-info-input" placeholder="(Không bắt buộc)" name="ship_email">
                        </div>
                        <div class="table-left-title">
                            <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                              </svg>
                            <span class="checkout-table-left-span">Phương Thức Thanh Toán</span>
                        </div>
                        <div class="table-left-info">
                           
                            <span>
                                <label class="pay"><input type="radio" name="payment_option" value="0" checked> Thanh Toán Khi Nhận Hàng</label name="payment_method">
                            </span>
                            <span>
                                <label class="pay"><input type="radio" name="payment_option" value="1" > Thanh Toán PayPal</label>
                            </span>
                        </div>
                    </div>
                    <div class="checkout-table-right">
                        <div class="table-right-title">
                            <svg width="20px" height="20px" viewBox="0 0 24 24"><defs><path id="CartCheckIcon_icon_svg__a" d="M21 22V2H3v20z"></path></defs><g fill="none" fill-rule="evenodd"><mask id="CartCheckIcon_icon_svg__b" fill="#fff"><use xlink:href="#CartCheckIcon_icon_svg__a"></use></mask><path fill="#348FE9" d="M10 18l-4-4 1.41-1.41L10 15.17l6.59-6.59L18 10l-8 8zm2-14c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm7 0h-4.18C14.4 2.84 13.3 2 12 2c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z" mask="url(#CartCheckIcon_icon_svg__b)"></path></g></svg>
                            <span class="checkout-table-right-span">Thông Tin Đơn Hàng</span>
                        </div>
                        <div class="table-right-info">
                            <div class="table-right-info-shop">
                                <span>Bán bởi shop:</span>
                                <strong style="margin: 0 4px;">
                                    <?php echo e($shop->shopname); ?>

                                </strong>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                </svg>
                            </div>
                            
                            <div class="table-right-info-item">
                                <div class="table-left-info-product">
                                    <div class="table-left-info-img">
                                        <img id="table-left-info-img" src="<?php echo e(asset('storage/'.$product_buy->previewImage)); ?>" alt="">
                                    </div>
                                    <div class="table-left-info-product-pro">
                                        <p class="table-left-info-product-pro-p">
                                            <?php echo e($product_buy->productName); ?>

                                        </p>
                                        <div class="table-left-info-product-price">
                                            <strong id="table-left-info-product-price"><?php echo e(number_format($product_buy->price, 0, ',', '.')); ?> </strong>
                                            <span class="">x <?php echo e($quantity); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-right-info-product-var">
                                    <span id="table-left-info-product-var" ::><?php echo e($combination); ?></span>
                                    <!-- <span style="border-right: 0.1px solid #979797; margin-right: 12px;"></span>
                                    <span id="table-left-info-product-var">đen</span> -->
                                </div>
                            </div>
                         
                            <div class="table-right-info-coupon">
                                <div class="table-right-info-coupon-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                        <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                    </svg>
                                    <span id="table-right-info-coupon-title">Mã giảm giá</span>
                                </div>
                                <div class="table-right-info-coupon-choice " data-toggle="modal" data-target="#logoutModal">
                                    <span id="table-right-info-coupon-choice">Chọn/nhập mã</span>
                                    
                                </div>
                            </div>
                            <div class="divider_14oT"></div>
                            <div>
                                <textarea class="input_3p8-" name="note" placeholder="Ghi chú cho Shop" maxlength="1000" tabindex="5"></textarea>
                            </div>
                        </div>
                        <div class="table-right-info" >
                            <div class="table-right-info-price-product">
                                <div id="table-right-info-price-product">
                                    <span>Tiền hàng</span>
                                    <span style="font-weight: 700;" id="price_order" ><?php echo e(number_format($total_price, 0, ',', '.')); ?>đ</span>
                                </div>
                                <div id="table-right-info-price-product">
                                    <span>Phí ship</span>
                                    <span style="font-weight: 700;"><?php echo e(number_format(30000, 0, ',', '.')); ?>đ</span>
                                </div>
                            </div>
                            <div class="table-right-info-price-product" >
                                <div id="table-right-info-price-product" class="coupon_number_display">
                                    
                                </div>
                            </div>
                            <div style="padding-top: 16px;">
                                <div class="table-right-info-totalCost">
                                    <span>Tổng thanh toán</span>
                                    <?php
                                        $total_price = $total_price + 30000;
                                        Session::put('total_price_now_', $total_price);
                                    ?>
                                    <span name="total_price" class="table-right-info-totalPrice"><?php echo e(number_format($total_price, 0, ',', '.')); ?>đ</span>
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
        <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                    <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <select class="form-control choose_coupon_now" data-total_price="<?php echo e($total_price); ?>">
                        <option value="" >Chọn mã giảm giá</option>
                        <?php $__currentLoopData = $coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->coupon_code); ?>" ><?php echo e($item->coupon_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="modal-footer row" >
                    <input type="text" class="form-control col-8" name="input_coupon" placeholder="Nhập mã giảm giá"  id="input_coupon">
                    <span class="btn btn-primary col-3" id="import_coupon_now" data-total_price="<?php echo e($total_price); ?>">Dùng Mã </span>
                </div>
            </div>
            </form>
        </div>
    </div>


</body>
</html>




<?php echo $__env->make('user.ajax_checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecommerce\resources\views/user/checkout_now.blade.php ENDPATH**/ ?>