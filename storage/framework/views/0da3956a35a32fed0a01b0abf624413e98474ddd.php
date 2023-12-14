<div class="detail-top">
            <div class="nav-bar-top">
                <div class="nav-bar-top-left colum-5">
                    <div class="nav-bar-top-left-select colum-2-5">
                        <a href="<?php echo e(route('index_shop')); ?>" class="nav-bar-top-left-select-a">
                            Kênh Người Bán
                        </a>
                    </div>
                    <div class="nav-bar-top-left-select colum-3">
                        <a href="#" class="nav-bar-top-left-select-a">
                            Chăm sóc khách hàng
                        </a>
                    </div>
                    <div class="nav-bar-top-left-select colum-3">
                        <a href="#" class="nav-bar-top-left-select-a">
                            Về Kenji
                        </a>
                    </div>
                </div>
                <div class="nav-bar-top-right colum-5">
                    <div class="nav-bar-top-right-connect colum-5">
                    <?php
                        $user = Session::get('user_id');
                        $user_img = Session::get('user_img');
                        if ($user == NULL){
                        ?>
                            <div class="nav-bar-top-right-connects colum-3">
                                <a href="<?php echo e(route('registers')); ?>" class="span-user-login">
                                    <span id="span-user-login">Đăng Ký</span>
                                </a>
                            </div>
                            <div class="nav-bar-top-right-connects colum-3 ">
                                <a href="<?php echo e(route('login')); ?>" class="span-user-login">
                                    <span id="span-user-login" >Đăng Nhập</span>
                                </a>
                            </div>
                        <?php
                            }
                            else{
                        ?>   
                            <div class="nav-bar-top-right-connects colum-10">
                                <div class="btn-group" style="" >
                                    <div class="menu-bar"style="height:100%; "  id="dropdownMenuButton" data-bs-toggle="dropdown" >
                                        <div class="shopee-avatar_header">
                                            
                                            <?php if($user_img != null): ?>
                                            <img class="shopee-avatar__img_header" src="<?php echo e(asset('storage/'.$user_img)); ?>">
                                            <?php else: ?>
                                            <img class="shopee-avatar__img_header" src="<?php echo e(asset('storage/users_img/user.png')); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <a href="#" class="span-user-login">
                                            <span id="span-user-login"> <?php echo e(Session::get('user_name')); ?></span>
                                        </a>
                                    </div>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="<?php echo e(route('user_account')); ?>">Hồ Sơ</a></li>
                                        <li><a class="dropdown-item" href="<?php echo e(route('user_purchase')); ?>">Đơn Mua</a></li>
                                        <li><a class="dropdown-item" href="<?php echo e(route('chat_user')); ?>">Tin Nhắn</a></li>
                                        <li><a class="dropdown-item" href="<?php echo e(route('user_password')); ?>">Đổi mật khẩu</a></li>
                                        <li><a class="dropdown-item" href="<?php echo e(route('logout_user')); ?>">Đăng Xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                           
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="nav-bar-bottom">
                <div class="nav-bar-bottom-with-search">
                    <div class="nav-bar-bottom-left">
                        <a href="<?php echo e(route('index')); ?>">
                            <img src="<?php echo e(asset('img/icon.jpg')); ?>" alt="" class="icon-ecommerce">
                        </a>
                    </div>
                    <form class="form-search" method="GET" action="<?php echo e(route('search_products')); ?>">
                       
                    <div class="nav-bar-bottom-center">
                        <div class="nav-bar-bottom-center-menu colum-0-5">
                            <div class="colum-10">
                                <svg  class="icon-menu" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide" viewBox="0 0 16 16">
                                    <path  d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
                                    <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="nav-bar-bottom-center-search colum-9-5">
                            <div class="colum-9">
                                <?php if(isset($keyword)): ?>
                                <input type="text" name="keyword" class="input-search" placeholder=" Tìm kiếm trên Kenji..." value="<?php echo e($keyword); ?>">
                                <?php else: ?>
                                <input type="text" name="keyword" class="input-search" placeholder=" Tìm kiếm trên Kenji...">

                                <?php endif; ?>
                            </div>
                            <div class="colum-1">
                                <button type="submit" value="Submit" aria-label="button submit" class="button-icon-search">
                                    <svg width="24" height="24"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" class="d7ed-SwZDZ2 d7ed-w34diS"><path d="M10 2a8 8 0 0 1 6.32 12.905l5.387 5.388-1.414 1.414-5.388-5.386A8 8 0 1 1 10 2Zm0 2a6 6 0 1 0 0 12 6 6 0 0 0 0-12Z" fill="#6F787E" fill-rule="nonzero" ></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="nav-bar-bottom-right">
                        <div class="nav-bar-bottom-right-cart colum-10">
                            <a  class="cart-drawer" href="<?php echo e(route('show_cart_ajax')); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-check icon-cart" viewBox="0 0 16 16">
                                    <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                                <?php
                                    $user_id= Session::get('user_id');
                                    $count_cart=Session::get('count_cart');
                                ?>
                                <?php if($user_id!= NULL): ?>
                                    <label class="cart-number-badge" id="count" ><?php echo e($count_cart); ?></label>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div><?php /**PATH D:\Ecommerce\resources\views/header.blade.php ENDPATH**/ ?>