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
    
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">    
    <title>Hồ sơ người dùng</title>
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
            position: relative;
            width: 100%;
        }
	</style>
</head>
<body>
    
    <header>
        <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <main >
        <?php echo csrf_field(); ?> 
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
                            <?php
                            $user_img = Session::get('user_img');
                            ?>
                            <?php if(Session::get('user_img') != null): ?>
                            <img class="shopee-avatar__img" src="<?php echo e(asset('storage/'.$user_img)); ?>">
                            <?php else: ?>
                            <img class="shopee-avatar__img" src="<?php echo e(asset('storage/users_img/user.png')); ?>">
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="miwGmI">
                        <div class="mC1Llc"><?php echo e(Session::get('user_name')); ?></div>
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
                        <div class="stardust-dropdown stardust-dropdown--open">
                            <div class="stardust-dropdown__item-header">
                                <a class="+1U02e wkLUkx" href="<?php echo e(route('user_account')); ?>">
                                    <div class="bfikuD">
                                        <img src="https://down-vn.img.susercontent.com/file/ba61750a46794d8847c3f463c5e71cc4">
                                    </div>
                                    <div class="DlL0zX">
                                        <span class="adF7Xs">Tài khoản của tôi</span>
                                    </div>
                                </a>
                            </div>
                           
                        </div>
                        <div class="stardust-dropdown ">
                            <div class="stardust-dropdown__item-header">
                                <a class="+1U02e " href="<?php echo e(route('user_purchase')); ?>">
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
                                <a class="+1U02e" href="<?php echo e(route('chat_user')); ?>">
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
                                <a class="+1U02e" href="<?php echo e(route('user_password')); ?>">
                                    <div class="bfikuD">
                                        <img src="https://down-vn.img.susercontent.com/file/84feaa363ce325071c0a66d3c9a88748">
                                    </div>
                                    <div class="DlL0zX">
                                        <span class="adF7Xs">Đổi Mật Khẩu</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xMDeox">
                    <div class="Hvae38" role="main">
                        <div style="display: contents;">
                        <div class="b7wtmP">
                            <div class="_66hYBa">
                                <h1 class="SbCTde">Hồ sơ của tôi</h1>
                                <div class="zptdmA">Thay đổi thông tin người dùng</div>
                            </div>
                            <?php
                            $message = Session::get('message');
                            $error = Session::get('error');
                            if(isset($message)){
                                echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
                                Session::put('message',null);
                            }
                            if(isset($error)){
                                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                                Session::put('error',null);
                            }
                            ?>
                            <form action="<?php echo e(route('change_profile_user')); ?>" method="POST" enctype="multipart/form-data" id="form_post">
                                <?php echo csrf_field(); ?>
                            <div class="R-Gpdg">
                                <div class="volt8A">
                                    <table class="Zj7UK+">
                                        <tr>
                                            <td class="espR83">
                                                <label>Họ</label>
                                            </td>
                                            <td class="Tmj5Z6">
                                                <div>
                                                    <div class="W50dp5">
                                                        <input type="text" placeholder="" class="CMyrTJ" value="<?php echo e($user->firstname); ?>" name="first_name">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="espR83">
                                                <label>Tên</label>
                                            </td>
                                            <td class="Tmj5Z6">
                                                <div>
                                                    <div class="W50dp5">
                                                        <input type="text" placeholder="" class="CMyrTJ" value="<?php echo e($user->lastname); ?>" name="last_name">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="espR83">
                                                <label>Email</label>
                                            </td>
                                            <td class="Tmj5Z6">
                                                <div class="W50dp5">
                                                    <input type="email" placeholder="" class="CMyrTJ" value="<?php echo e($user->email); ?>" name="email">
                                                </div>
                                            </td>
                                        </tr>
                                       
                                        <tr>
                                            <td class="espR83">
                                                <label></label>
                                            </td>
                                            <td class="Tmj5Z6">
                                                <button type="submit" id="sub_button" class="btn btn-solid-primary btn--m btn--inline" aria-disabled="false">Lưu</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="IQPHvE">
                                    <div class="scvgOW">
                                        <div class="XWsmVn">
                                            <?php if(Session::get('user_img') != null): ?>
                                            <div class="LoNm4g" style="background-image: url(&quot;<?php echo e(asset('storage/'.$user_img)); ?>&quot;);"></div>
                                            <?php else: ?>
                                            <div class="LoNm4g" style="background-image: url(&quot;<?php echo e(asset('storage/users_img/user.png')); ?>&quot;);"></div>
                                            <?php endif; ?>
                                        </div>
                                        <input class="bMWDYw" type="file" accept=".jpg,.jpeg,.png" name="user_img">
                                        <label  class="btn btn-light btn--m btn--inline" id="button_img">Chọn ảnh</label>
                                        <div class="L4SAGB">
                                            <div class="SlaeTm">Dụng lượng file tối đa 1 MB</div>
                                            <div class="SlaeTm">Định dạng:.JPEG, .PNG</div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                </div>
        </div>
    </main>
    <footer>
       <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </footer>
    <!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- include jQuery validate library -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- include Ajax  library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- include jQuery validate library -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $("#form_post").validate({
        rules: {
            "first_name": {
                required: true,
                maxlength: 20,
                minlength: 2,
            },
            "last_name": {
                required: true,
                maxlength: 20,
                minlength: 2,
            },
            "email": {
                required: true,
                email: true,
            },
        },
        messages: {
            "first_name": {
                required: "Vui lòng nhập tên người dùng",
                maxlength: "Họ người dùng không được vượt quá 20 ký tự",
                minlength: "Họ người dùng phải có ít nhất 2 ký tự",
            },
            "last_name": {
                required: "Vui lòng nhập họ người dùng",
                maxlength: "Tên của người dùng không được vượt quá 20 ký tự",
                minlength: "Tên của người dùng phải có ít nhất 2 ký tự",
            },
            "email": {
                required: "Vui lòng nhập email người dùng",
                email: "Vui lòng nhập đúng định dạng email",

            },
        },
        submitHandler: function(form) {
            $(form).submit();
        }
    
    });
    </script>

<script>
    const first_name = document.querySelector('input[name="first_name"]');
    const last_name = document.querySelector('input[name="last_name"]');
    const email = document.querySelector('input[name="email"]');
    const button = document.getElementById('sub_button');
    button.addEventListener('click', function(){
        if(first_name.value == ''){
            
            swal("Vui lòng nhập họ người dùng");
            return false;
        }
        if(first_name.value.length < 2){    
            swal("Họ người dùng phải có ít nhất 2 ký tự");
            return false;
        }
        if(first_name.value.length > 20){
            swal("Họ người dùng không được vượt quá 20 ký tự");
            return false;
        }
        if(last_name.value == ''){
            swal("Vui lòng nhập tên người dùng");
            return false;
        }
        if(last_name.value.length < 2){
            swal("Tên của người dùng phải có ít nhất 2 ký tự");
            return false;
        }
        if(last_name.value.length > 20){
            swal("Tên của người dùng không được vượt quá 20 ký tự");
            return false;
        }
        if(email.value == ''){
            swal("Vui lòng nhập email người dùng");
            return false;
        }
        if(email.value.length < 2){
            swal("Vui lòng nhập đúng định dạng email");
            return false;
        }
    });
</script>
<script>
    const button_img = document.getElementById('button_img');
    const input_img = document.querySelector('.bMWDYw');
    const img = document.querySelector('.LoNm4g');
    
    button_img.addEventListener('click', function(){
        input_img.click();
    });
    input_img.addEventListener('change', function(){
        const file = this.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(){
                const result = reader.result;
                img.style.backgroundImage = `url(${result})`;
                
            }
            reader.readAsDataURL(file);
        }
        else{
            img.style.backgroundImage = `url("<?php echo e(asset('storage/users_img/user.png')); ?>")`;
        }
    });
</script>
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
                        url: '<?php echo e(route('user_cancel_order')); ?>',
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



<?php /**PATH D:\Ecommerce\resources\views/user/user_account.blade.php ENDPATH**/ ?>