<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng Ký - Kênh Bán Hàng</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>">
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
<style>
    .custom-file-upload{
    border: 1px solid #ccc;
    display: inline-block;
    padding: 14px 12px;
    cursor: pointer;
    border-radius: 5px;
    background-color: #eee;
    color: #333;
    font-size: 13px;
    font-weight: 600;
   
}
input[type="file"]{
    display: none;
}

</style>
<body class="bg-gradient-primary">

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng Ký Bán Hàng</h1>
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
                            </div>
                            <form class="user" action="<?php echo e(route('registers_shop')); ?>" method="POST" enctype="multipart/form-data" id="form_register_shop" >
                                <?php echo csrf_field(); ?>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  name="shop_name" id="exampleFirstName"
                                            placeholder="Tên Shop">
                                    </div>
                                    <div class="col-sm-6" style="display:flex;" >
                                        <label for="up_img" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i> Đăng tải logo shop
                                        </label>
                                        <input  name="shopImg" type="file" id="up_img"  required>

                                        <img src="" id="logo_shop" style="width: 100px; height: 100px; display: none;" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input  required name="email"  type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input  name="password" type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Mật Khẩu" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input  name="password_confirm" type="password" class="form-control form-control-user" name="password_confirm"
                                            id="exampleRepeatPassword" placeholder="Nhập Lại Mật Khẩu">
                                    </div>
                                </div>
                                <button type="submit"  class="btn btn-primary btn-user btn-block">
                                        Đăng Ký Shop
                                </button>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Đăng Ký with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Đăng Ký with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Quên mật khẩu?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?php echo e(route('login_shop')); ?>">Bạn đã có tài khoản? Đăng nhập!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- include jQuery validate library -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#up_img').change(function(){
            var fileName = $(this).val();
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            if(ext == "jpg" || ext == "png" || ext == "jpeg"){
                $('#logo_shop').css('display','block');
                let file = $(this).prop('files')[0];
                let reader = new FileReader();
                reader.onload = function(){
                    $('#logo_shop').attr('src',reader.result);
                }
                reader.readAsDataURL(file);
            }
            else{
                alert('Chỉ được chọn file ảnh');
                $('#up_img').val('');
            }
        })
        })
    </script>
    <script>
    $("#form_register_shop").validate({
        rules: {
            "shop_name": {
                required: true,
                maxlength: 20,
            },
            "shop_logo": {
                required: true,
                image: true,
            },
            "email": {
                required: true,
                email: true,
            },
            "password": {
                required: true,
                minlength: 6,
            },
            "password_confirm": { 
                required: true,
                equalTo: "#exampleInputPassword"
            },
            "shopImg":{ 
                required: true,
                image: true,
            },
        },
        messages: {
            "shop_name": {
                required: "Vui lòng nhập tên người dùng",
                maxlength: "Tên người dùng không được vượt quá 20 ký tự",
            },
            "shop_logo": {
                required: "Vui lòng đăng tải ảnh ",
                image: "Vui lòng đăng tải đúng định dạng ảnh",
            },
            "email": {
                required: "Vui lòng nhập email ",
                email: "Vui lòng nhập đúng định dạng email",
            },
            "password": {
                required: "Vui lòng nhập mật khẩu",
                minlength: "Mật khẩu phải có ít nhất 6 ký tự",
            },
            "password_confirm": {
                required: "Vui lòng xác nhận lại mật khẩu",
                equalTo: "Mật khẩu xác nhận không khớp",
            },
            "shopImg":{ 
                required: "Vui lòng đăng tải logo shop ",
                image: "Vui lòng đăng tải đúng định dạng ảnh",
            },
        },
        submitHandler: function(form) {
            $(form).submit();
        }
    
    });
    </script>
</body>

</html><?php /**PATH D:\Ecommerce\resources\views/shop/register_shop.blade.php ENDPATH**/ ?>