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
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>">
    <title><?php echo e($shop_info->shopname); ?> Cửa hàng trực tuyến</title>
    
</head>
<style>
    /* input[type="radio"] {
        display: none;
    } */
    /* input[type="radio"]:checked + label {
        color: var(--theme-color, #FBBC05);
    } */
</style>
<body>
    
    <header>
        <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <main >
        <input type="hidden" id="shop_id" value="<?php echo e($shop_info->id); ?>">
        <div class="shope-center">
            <div class="shop-page">
                <div class="shop-page__info">
                    <div class="section-seller-overview-horizontal container">
                        <div class="section-seller-overview-horizontal__leading">
                            <div class="section-seller-overview-horizontal__leading-background" style="background-image: url(&quot;https://images.unsplash.com/photo-1553095066-5014bc7b7f2d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=871&q=80&quot;);">
                            </div>
                            <div class="section-seller-overview-horizontal__leading-background-mask"></div>
                            <div class="section-seller-overview-horizontal__leading-content">
                                <div class="section-seller-overview-horizontal__seller-portrait -Pp4Kh">
                                    <a class="section-seller-overview-horizontal__seller-portrait-link" href="<?php echo e(route('view_shop', $shop_info ->id)); ?>">
                                        <div class="shopee-avatar _3jLQRv">
                                            <div class="shopee-avatar__placeholder">
                                                <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" class="shopee-svg-icon icon-headshot">
                                                    <g>
                                                        <circle cx="7.5" cy="4.5" fill="none" r="3.8" stroke-miterlimit="10"></circle>
                                                        <path d="m1.5 14.2c0-3.3 2.7-6 6-6s6 2.7 6 6" fill="none" stroke-linecap="round" stroke-miterlimit="10"></path>
                                                    </g>
                                                </svg>
                                            </div>
                                            <img class="shopee-avatar__img" src="<?php echo e(asset('storage/'.$shop_info -> shopImg)); ?>">
                                        </div>
                                        
                                    </a>
                                    <div class="section-seller-overview-horizontal__portrait-info">
                                        <h1 class="section-seller-overview-horizontal__portrait-name"><?php echo e($shop_info->shopname); ?></h1>
                                        <div class="section-seller-overview-horizontal__portrait-status">
                                            <div class="section-seller-overview-horizontal__active-time">Online 5 phút trước</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-seller-overview-horizontal__ s">
                                    <a class="section-seller-overview-horizontal__button" href="<?php echo e(route('show_chat',$shop_info->id)); ?>">
                                        <button class="shopee-button-outline shopee-button-outline--complement shopee-button-outline--fill">
                                            <span class="section-seller-overview-horizontal__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                                    <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                                    <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2"/>
                                                </svg>
                                            </span>nhắn tin
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="section-seller-overview-horizontal__seller-info-list">
                            <div class="section-seller-overview__item section-seller-overview__item--clickable">
                                <div class="section-seller-overview__item-icon-wrapper">
                                    <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" stroke-width="0" class="shopee-svg-icon">
                                        <path d="m13 1.9c-.2-.5-.8-1-1.4-1h-8.4c-.6.1-1.2.5-1.4 1l-1.4 4.3c0 .8.3 1.6.9 2.1v4.8c0 .6.5 1 1.1 1h10.2c.6 0 1.1-.5 1.1-1v-4.6c.6-.4.9-1.2.9-2.3zm-11.4 3.4 1-3c .1-.2.4-.4.6-.4h8.3c.3 0 .5.2.6.4l1 3zm .6 3.5h.4c.7 0 1.4-.3 1.8-.8.4.5.9.8 1.5.8.7 0 1.3-.5 1.5-.8.2.3.8.8 1.5.8.6 0 1.1-.3 1.5-.8.4.5 1.1.8 1.7.8h.4v3.9c0 .1 0 .2-.1.3s-.2.1-.3.1h-9.5c-.1 0-.2 0-.3-.1s-.1-.2-.1-.3zm8.8-1.7h-1v .1s0 .3-.2.6c-.2.1-.5.2-.9.2-.3 0-.6-.1-.8-.3-.2-.3-.2-.6-.2-.6v-.1h-1v .1s0 .3-.2.5c-.2.3-.5.4-.8.4-1 0-1-.8-1-.8h-1c0 .8-.7.8-1.3.8s-1.1-1-1.2-1.7h12.1c0 .2-.1.9-.5 1.4-.2.2-.5.3-.8.3-1.2 0-1.2-.8-1.2-.9z"></path>
                                    </svg>
                                </div>
                                <div class="section-seller-overview__item-text">
                                    <div class="section-seller-overview__item-text-name">Sản phẩm:&nbsp;</div>
                                    <div class="section-seller-overview__item-text-value"><?php echo e($product_count); ?></div>
                                </div>
                            </div>
                            <div class="section-seller-overview__item">
                                <div class="section-seller-overview__item-icon-wrapper">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16" x="0" y="0" class="shopee-svg-icon">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                                    </svg>
                                </div>
                                <div class="section-seller-overview__item-text">
                                    <div class="section-seller-overview__item-text-name">Người theo dõi:&nbsp;</div>
                                    <div class="section-seller-overview__item-text-value">10</div>
                                </div>
                            </div>
                            <div class="section-seller-overview__item">
                                <div class="section-seller-overview__item-icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus shopee-svg-icon" viewBox="0 0 16 16" >
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </div>
                                <div class="section-seller-overview__item-text">
                                    <div class="section-seller-overview__item-text-name">Đang Theo Dõi:&nbsp;</div>
                                    <div class="section-seller-overview__item-text-value">1</div>
                                </div>
                            </div>
                            <div class="section-seller-overview__item section-seller-overview__item--clickable">
                                <div class="section-seller-overview__item-icon-wrapper">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star shopee-svg-icon icon-rating" viewBox="0 0 16 16">
                                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                    </svg>
                                </div>
                                <div class="section-seller-overview__item-text">
                                    <div class="section-seller-overview__item-text-name">đánh giá:&nbsp;</div>
                                    <div class="section-seller-overview__item-text-value">4.6 </div>
                                </div>
                            </div>
                            <div class="section-seller-overview__item">
                                <div class="section-seller-overview__item-icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-dots shopee-svg-icon" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </div>
                                <div class="section-seller-overview__item-text">
                                    <div class="section-seller-overview__item-text-name">Tỉ lệ phản hồi Chat:&nbsp;</div>
                                    <div class="section-seller-overview__item-text-value">89% (trong vài giờ)
      
                                    </div>
                                </div>
                            </div>
                            <div class="section-seller-overview__item">
                                <div class="section-seller-overview__item-icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="shopee-svg-icon bi bi-person-check" viewBox="0 0 16 16">
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                        <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                                    </svg>
                                </div>
                                <div class="section-seller-overview__item-text">
                                    <div class="section-seller-overview__item-text-name">tham gia:&nbsp;</div>
                                    <div class="section-seller-overview__item-text-value"><?php echo e($created_at); ?> ngày trước</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-page-container">
                    <div class="shop-collection-view">
                        <div class="shopee-header-section--simple">
                            <div class="shopee-header-section__header">
                                <div class="shopee-header-section__header__title">GỢI Ý CHO BẠN</div>
                            </div>
                            <div class="shop-row-content">
                                <?php $__currentLoopData = $product_top_sale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="body-index-products colum-1-6">
                                    <a href="<?php echo e(route('detail_product',$product->id)); ?>">
                                        <div class="body-index-products-info">
                                            <div class="body-index-products-img ">
                                                <img src="<?php echo e(asset('storage/'.$product->previewImage)); ?>" alt="" class="product-img-index">
                                            </div>
                                            <div class="body-index-products-detail">
                                                <div class="body-index-products-detail-name">
                                                    <div id="body-index-products-detail-name-span">
                                                        <?php echo e($product->productName); ?>

                                                    </div>
                                                </div>
                                                <div class="body-index-products-detail-price">
                                                    <div id="body-index-products-detail-price-span">
                                                    <?php echo e(number_format($product->price, 0, ',', '.')); ?>đ
                                                    </div>
                                                </div>
                                                <div class="body-index-products-detail-sold">
                                                    <div id="body-index-products-detail-sold-span">
                                                        Đã bán <?php echo e($product->sales_quantity); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>      
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="shop-page__all-products-section" id="shop-page__all-products-section">
                        <div class="filter-panel">
                            <div class="filter_container">
                                <div  class="filter_menu">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                    <p class="filter_title">DANH MỤC</p>
                                </div>
                                <div class="filter_list">
                                    <?php $__currentLoopData = $shop_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="filter_item">    
                                        <label class="filter_item-checkbox-name">
                                            <input class="choose_subcategory" id="<?php echo e($category->subcategory_id); ?>"  type="radio" name="subCategory"data-shop-id="<?php echo e($shop_info->id); ?>" data-subcategory-id="<?php echo e($category->subcategory_id); ?>">
                                            <label class="shop_subcategory"  for="<?php echo e($category->subcategory_id); ?>"> <?php echo e($category->subCategoryName); ?></label> 
                                        </label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="body-category-item">
                            <div class="shopee-sort-bar">
                                <span class="shopee-sort-bar__label">Sắp xếp theo</span>
                                <div class="shopee-sort-by-options" >
                                    <input class="choose_arrange" id="popular" checked  type="radio" name="choose_arrange" data-shop-id="<?php echo e($shop_info->id); ?>" data-choose_id="popular">
                                    <label class=" shopee-sort-by-options__option "  for="popular"> Phổ Biến</label> 
                                    
                                    <input class="choose_arrange" id="newest"  type="radio" name="choose_arrange" data-shop-id="<?php echo e($shop_info->id); ?>" data-choose_id="newest">
                                    <label class=" shopee-sort-by-options__option "  for="newest"> Mới nhất</label>

                                    <input class="choose_arrange" id="best_sell"  type="radio" name="choose_arrange" data-shop-id="<?php echo e($shop_info->id); ?>" data-choose_id="best_sell">
                                    <label class="shopee-sort-by-options__option "  for="best_sell"> Bán Chạy</label>
                                    
                                    <input class="choose_arrange" id="high_low"  type="radio" name="choose_arrange" data-shop-id="<?php echo e($shop_info->id); ?>" data-choose_id="high_low">
                                    <label class="shopee-sort-by-options__option "  for="high_low"> Giá: Cao đến thấp</label>
                                    
                                    <input class="choose_arrange" id="low_high"  type="radio" name="choose_arrange" data-shop-id="<?php echo e($shop_info->id); ?>" data-choose_id="low_high">
                                    <label class="shopee-sort-by-options__option "  for="low_high"> Giá: Thấp đến cao</label>
                                    <!-- <div>
                                        <div class="select-with-status">
                                            <div class="select-with-status__holder select-with-status__box-shadow">
                                                <span class="select-with-status__placeholder">Giá</span>
                                                <div>
                                                </div>
                                                <span>
                                                    <svg viewBox="0 0 10 6" class="shopee-svg-icon icon-arrow-down-small">
                                                        <path d="M9.7503478 1.37413402L5.3649665 5.78112957c-.1947815.19574157-.511363.19651982-.7071046.00173827a.50153763.50153763 0 0 1-.0008702-.00086807L.2050664 1.33007451l.0007126-.00071253C.077901 1.18820749 0 1.0009341 0 .79546595 0 .35614224.3561422 0 .7954659 0c.2054682 0 .3927416.07790103.5338961.20577896l.0006632-.00066318.0226101.02261012a.80128317.80128317 0 0 1 .0105706.0105706l3.3619016 3.36190165c.1562097.15620972.4094757.15620972.5656855 0a.42598723.42598723 0 0 0 .0006944-.00069616L8.6678481.20650022l.0009529.0009482C8.8101657.07857935 8.9981733 0 9.2045341 0 9.6438578 0 10 .35614224 10 .79546595c0 .20495443-.077512.39180497-.2048207.53283641l.0003896.00038772-.0096728.00972053a.80044712.80044712 0 0 1-.0355483.03572341z" fill-rule="nonzero"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="body-category-items">
                                <div class="shop-search-result-view" >
                                    <?php $__currentLoopData = $product_shop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="body-index-products colum-1-9">
                                        <a href="<?php echo e(route('detail_product',$product->id)); ?>">
                                            <div class="body-index-products-info">
                                                <div class="body-index-products-img ">
                                                    <img src="<?php echo e(asset('storage/'.$product->previewImage)); ?>" alt="" class="product-img-index">
                                                </div>
                                                <div class="body-index-products-detail">
                                                    <div class="body-index-products-detail-name">
                                                        <div id="body-index-products-detail-name-span">
                                                            <?php echo e($product->productName); ?>

                                                        </div>
                                                    </div>
                                                    <div class="body-index-products-detail-price">
                                                        <div id="body-index-products-detail-price-span">
                                                            <?php echo e(number_format($product->price, 0, ',', '.')); ?>đ
                                                        </div>
                                                    </div>
                                                    <div class="body-index-products-detail-sold">
                                                        <div id="body-index-products-detail-sold-span">
                                                            <?php if($product->sales_quantity > 1): ?>
                                                                Đã bán <?php echo e($product->sales_quantity); ?>

                                                            <?php else: ?>
                                                                Đã bán 0
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                </div>
                                <div class="pagination">
                                    <?php echo e($product_shop->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
    <footer>
        
    </footer>
<?php echo $__env->make('user.shop_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>




<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecommerce\resources\views/user/shop.blade.php ENDPATH**/ ?>