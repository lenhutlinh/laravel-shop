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
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>">
    <title><?php echo e($products->productName); ?></title>
</head>
<style>
    input[type="radio"] {
        display: none;
    }
    input[type="radio"]:checked + label {
        color: #FBBC05;
        color: var(--theme-color, #FBBC05);
        border-color: #FBBC05;
        border-color: var(--theme-color, #FBBC05);
    }
</style>
<body>
    
    <header>
        <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <main >
        <div class="detail-center">
            <form id="form-detail">
                <?php echo csrf_field(); ?>
                <div class="page-product">
                <div class="page-product-detail">
                    <div class="page-product-detail-left">
                        <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="mySwiper"
                            thumbs-swiper=".mySwiper2" space-between="10" navigation="true">
                            <?php $__currentLoopData = $products_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <swiper-slide>
                                <img src="<?php echo e(asset('storage/'.$image->imageProduct)); ?>" style="height:525px"/>
                            </swiper-slide>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </swiper-container>

                        <swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true"
                            watch-slides-progress="true">
                            <?php $__currentLoopData = $products_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <swiper-slide>
                                <img src="<?php echo e(asset('storage/'.$image->imageProduct)); ?>" style="height:100px"/>
                            </swiper-slide> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </swiper-container>
                    </div>
                    <div class="flex flex-auto RBf1cu">
                    
                        <div class="flex-auto flex-column swTqJe ">
                            <div class="product-detail-title">
                                <span>
                                    <?php echo e($products->productName); ?>

                                </span>
                            </div>
                            <div class="product-detail-proper">
                                <div class="product-detail-rate">
                                    <span class="checked" style="font-size: 16px"><u>5</u></span> 
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <div class="product-detail-number-review">
                                    <div style="font-size: 17px; margin-right: 5px;">
                                        <u>100 </u>
                                    </div>
                                    <div style="color:darkgrey; ">
                                        Đánh Giá
                                    </div>
                                </div>
                                <div class="product-detail-number-review">
                                    <div style="font-size: 17px; margin-right: 5px;">
                                        <u><?php echo e($product_sale->sales_quantity); ?> </u>
                                    </div>
                                    <div style="color:darkgrey;  ">
                                        Đã Bán
                                    </div>
                                </div>
                            </div>
                            <div class="product-detail-price">
                                <div id="product-detail-price">
                                    <?php echo e(number_format($products->price, 0, ',', '.')); ?>đ
                                
                                </div>
                            </div>
                            <div class="h-y3ij">
                                <div class="flex flex-column">
                                    <div class="flex rY0UiC j9be9C">
                                        <div class="flex flex-column">
                                            <?php if(isset($var_option)): ?>
                                                <div class="flex items-center" style="margin-bottom: 8px; align-items: baseline;">
                                                    <label class="oN9nMU">
                                                        <?php $__currentLoopData = $var_option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $var_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($var_option->variationName); ?>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </label>
                                                    <div class="flex items-center bR6mEk">
                                                        <?php if(($combination_string[0]->combination_string)==''): ?>
                                                            <?php $__currentLoopData = $combination_string; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <input hidden checked type="radio" data-avai_stock="<?php echo e($combination -> avaiable_stock); ?>" data-combi_id="<?php echo e($combination -> id); ?>"  id="<?php echo e($combination->combination_string); ?>" value="<?php echo e($combination->combination_string); ?>" name="combination" class="choose_variation" >
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <?php $__currentLoopData = $combination_string; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <input type="radio" data-avai_stock="<?php echo e($combination -> avaiable_stock); ?>" data-combi_id="<?php echo e($combination -> id); ?>" id="<?php echo e($combination->combination_string); ?>" value="<?php echo e($combination->combination_string); ?>" name="combination" class="choose_variation" required>
                                                                <label class="product-variation"  for="<?php echo e($combination->combination_string); ?>" name="combination" required> <?php echo e($combination->combination_string); ?></label>
                                                                <input type="hidden" name="avaiable_stock"  value="<?php echo e($combination->avaiable_stock); ?>" class="avaiable_stock_<?php echo e($combination -> id); ?>">
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
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
                                                            <input id="number"  class="EquXA8 Wrmraq quantity<?php echo e($products -> id); ?>" type="text" role="spinbutton" aria-valuenow="1" value="1" required number>
                                                            <span id="plus" class="EquXA8">
                                                                <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0" class="shopee-svg-icon icon-plus-sign">
                                                                    <polygon points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5"></polygon>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <span class="show_avaiable"><?php echo e($sum_avaialbe); ?> sản phẩm có sẵn</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>               
                                </div>
                            </div>
                            <div style="margin-top: 15px;">
                                <div class="ThEIyI">
                                    <div class="p+UZsF">
                                        <button type="button" data-id_product="<?php echo e($products->id); ?>" class="btn btn-tinted btn--l iFo-rx QA-ylc add-to-cart" aria-disabled="false" >
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
                                            
                                            <input type="hidden"  value="<?php echo e($products->shop_id); ?>" class="shop_id_<?php echo e($products -> id); ?>">
                                            <input type="hidden"  value="<?php echo e($products->id); ?>" class="product_id_<?php echo e($products -> id); ?>">
                                            <input type="hidden"  value="<?php echo e($products->productName); ?>" class="productName<?php echo e($products -> id); ?>">
                                            <input type="hidden"  value="<?php echo e($products -> previewImage); ?>" class="previewImage<?php echo e($products -> id); ?>">
                                            <input type="hidden"  value="<?php echo e($products->price); ?>" class="price<?php echo e($products -> id); ?>">
                                            
                                            <span>Thêm Vào Giỏ Hàng</span>
                                        </button>
                                        <span type="button" class="btn btn-solid-primary btn--l iFo-rx " id="buy_now" aria-disabled="false" data-id_product="<?php echo e($products->id); ?>" >Mua Ngay
                                            <input type="hidden"  value="<?php echo e($products->shop_id); ?>" class="shop_id_<?php echo e($products -> id); ?>">
                                            <input type="hidden"  value="<?php echo e($products->id); ?>" class="product_id_<?php echo e($products -> id); ?>">
                                            <input type="hidden"  value="<?php echo e($products->productName); ?>" class="productName<?php echo e($products -> id); ?>">
                                            <input type="hidden"  value="<?php echo e($products -> previewImage); ?>" class="previewImage<?php echo e($products -> id); ?>">
                                            <input type="hidden"  value="<?php echo e($products->price); ?>" class="price<?php echo e($products -> id); ?>">
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
                        <a class="W0LQye" href="<?php echo e(route('view_shop',$shop->id)); ?>">
                            <div class="shopee-avatar UadQpu" data-testid="shop_avatar_image_pdp">
                                <div class="shopee-avatar__placeholder">
                                    <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon icon-headshot">
                                        <g>
                                            <circle cx="7.5" cy="4.5" fill="none" r="3.8" stroke-miterlimit="10"></circle>
                                            <path d="m1.5 14.2c0-3.3 2.7-6 6-6s6 2.7 6 6" fill="none" stroke-linecap="round" stroke-miterlimit="10"></path>
                                        </g>
                                    </svg>
                                </div>
                                <img class="shopee-avatar__img" src="<?php echo e(asset('storage/'.$shop -> shopImg)); ?>">
                            </div>
                        </a>
                        <div class="oAVg4E">
                            <div class="VlDReK" data-testid="shop_name_pdp"><?php echo e($shop->shopname); ?></div>
                            <div class="TaEoi4">
                                <div class="zSXxlI" data-testid="seller_active_time_pdp">Online 3 giờ trước</div>
                            </div>
                            <div class="Uwka-w">
                                <a href="<?php echo e(route('show_chat',$shop->id)); ?>" class="btn btn-tinted btn--s btn--inline Q-sdJs" data-testid="shop_chat_now_button_pdp">
                                    <svg viewBox="0 0 16 16" class="shopee-svg-icon JWAQyX">
                                        <g fill-rule="evenodd">
                                        <path d="M15 4a1 1 0 01.993.883L16 5v9.932a.5.5 0 01-.82.385l-2.061-1.718-8.199.001a1 1 0 01-.98-.8l-.016-.117-.108-1.284 8.058.001a2 2 0 001.976-1.692l.018-.155L14.293 4H15zm-2.48-4a1 1 0 011 1l-.003.077-.646 8.4a1 1 0 01-.997.923l-8.994-.001-2.06 1.718a.5.5 0 01-.233.108l-.087.007a.5.5 0 01-.492-.41L0 11.732V1a1 1 0 011-1h11.52zM3.646 4.246a.5.5 0 000 .708c.305.304.694.526 1.146.682A4.936 4.936 0 006.4 5.9c.464 0 1.02-.062 1.608-.264.452-.156.841-.378 1.146-.682a.5.5 0 10-.708-.708c-.185.186-.445.335-.764.444a4.004 4.004 0 01-2.564 0c-.319-.11-.579-.258-.764-.444a.5.5 0 00-.708 0z"></path>
                                        </g>
                                    </svg>Chat ngay
                                </a>
                                <a class="btn btn-light btn--s btn--inline btn-light--link Vf+pt4" data-testid="btn_light" href="<?php echo e(route('view_shop',$shop->id)); ?>">
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
                            <a class="p48aHT _07yPll" data-testid="shop_products_section_pdp" href="<?php echo e(route('view_shop', $shop->id)); ?>">
                                <label class="siK1qW">Sản phẩm</label>
                                <span class="Xkm22X vUG3KX"><?php echo e($product_count); ?></span>
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
                                <span class="Xkm22X"><?php echo e($created_at); ?> Ngày</span>
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
                                        <a class="akCPfg KvmvO1" href="<?php echo e(route('index')); ?>">Kenji</a>
                                        <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="shopee-svg-icon xprSzi icon-arrow-right">
                                            <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path>
                                        </svg>
                                        <a class="akCPfg KvmvO1" href="<?php echo e(route('category_products',$category->categoryName)); ?>"><?php echo e($category->categoryName); ?></a>
                                        <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="shopee-svg-icon xprSzi icon-arrow-right">
                                            <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path>
                                        </svg>
                                        <a class="akCPfg KvmvO1" href="<?php echo e(route('category_products',$category->categoryName)); ?>"><?php echo e($subcategory->subCategoryName); ?></a>
                
                                    </div>
                                </div>
                                <!-- <div class="dR8kXc">
                                    <label class="zquA4o">Địa chỉ tổ chức chịu trách nhiệm sản xuất</label>
                                    <div>Đang cập nhật</div>
                                </div>
                                <div class="dR8kXc">
                                    <label class="zquA4o">Chất liệu</label>
                                    <div>Nỉ, Da</div>
                                </div> -->
                                <div class="dR8kXc">
                                    <label class="zquA4o">Tồn kho</label>
                                    <div><?php echo e($sum_avaialbe); ?></div>
                                </div>
                                <div class="dR8kXc">
                                    <label class="zquA4o">Mô tả</label>
                                    <div><?php echo e($products->description); ?></div>
                                </div>
                               
                    </div>
                </div>
                <div class="page-product__content--right colum-2-5">
                    <div style="display: contents;">
                        <div class="product-shop-vouchers page-product__shop-voucher"><div class="product-shop-vouchers__header">Mã giảm giá của Shop</div><div class="product-shop-vouchers__list" tabindex="-1" style="max-height: 23.25rem;"><div class="vc_Card_container vc_product-detail-page-vouchers_pcProductVoucher nBBX45 Y56Uu-"><div class="vc_Card_card"><div class="vc_Card_left"><div class="vc_Card_sawtooth"></div></div><div class="vc_Card_right"></div><div class="vc_VoucherStandardTemplate_hideOverflow"></div><div class="vc_VoucherStandardTemplate_template"><div class="vc_product-detail-page-vouchers_pcProductVoucherMiddle vc_VoucherStandardTemplate_middle"><div class="vc_MainTitle_mainTitle"><div class="vc_MainTitle_text">Giảm ₫3k</div></div><div class="vc_Subtitle_subTitle">Đơn Tối Thiểu ₫150k</div><div class="vc_Label_label"></div><div class="vc_ProgressBarExpiry_progressBarExpiry"><div class="vc_ProgressBarExpiry_usageLimitedText"><span class="vc_ProgressBarExpiry_validUntil vc_ProgressBarExpiry_capitalize">HSD: 17.03.2023</span></div></div></div><div class="vc_product-detail-page-vouchers_pcProductVoucherRight vc_VoucherStandardTemplate_right"><div></div><div class="vc_VoucherStandardTemplate_center"><div class="vc_RectButton_rectButton"><div class="vc_RectButton_btn vc_RectButton_claim">Lưu</div></div></div><div></div></div></div></div></div><div class="vc_Card_container vc_product-detail-page-vouchers_pcProductVoucher nBBX45 Y56Uu-"><div class="vc_Card_card"><div class="vc_Card_left"><div class="vc_Card_sawtooth"></div></div><div class="vc_Card_right"></div><div class="vc_VoucherStandardTemplate_hideOverflow"></div><div class="vc_VoucherStandardTemplate_template"><div class="vc_product-detail-page-vouchers_pcProductVoucherMiddle vc_VoucherStandardTemplate_middle"><div class="vc_MainTitle_mainTitle"><div class="vc_MainTitle_text">Giảm ₫5k</div></div><div class="vc_Subtitle_subTitle">Đơn Tối Thiểu ₫250k</div><div class="vc_Label_label"></div><div class="vc_ProgressBarExpiry_progressBarExpiry"><div class="vc_ProgressBarExpiry_usageLimitedText"><span class="vc_ProgressBarExpiry_validUntil vc_ProgressBarExpiry_capitalize">HSD: 18.03.2023</span></div></div></div><div class="vc_product-detail-page-vouchers_pcProductVoucherRight vc_VoucherStandardTemplate_right"><div></div><div class="vc_VoucherStandardTemplate_center"><div class="vc_RectButton_rectButton"><div class="vc_RectButton_btn vc_RectButton_claim">Lưu</div></div></div><div></div></div></div></div></div></div></div></div></div>
            </div>
        
        </div>

    </main>
    <footer>
        <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </footer>

<?php echo $__env->make('detail_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body> 
</html>



<?php /**PATH D:\Ecommerce\resources\views/detail_product.blade.php ENDPATH**/ ?>