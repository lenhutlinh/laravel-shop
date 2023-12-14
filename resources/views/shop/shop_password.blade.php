<!DOCTYPE html>
<html lang="en">

<head>

        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('css/sb-admin-2.min.css')}}"  rel="stylesheet">
    <link href="{{asset('css/upfile.css')}}"  rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">
    
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <title>Đổi mật khẩu</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}"  rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}"  rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">    

    <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('shop.sidebarshop')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('shop.topbarshop')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="xMDeox">
                        <div class="Hvae38" role="main">
                            <div style="display: contents;">
                            <div class="b7wtmP">
                                <div class="_66hYBa">
                                    <h1 class="SbCTde">Đổi mật khẩu người dùng</h1>
                                    <div class="zptdmA">Nhập theo form để đổi mật khẩu</div>
                                </div>
                                @php
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
                                @endphp
                                <form action="{{route('change_password_shop')}}" method="POST" enctype="multipart/form-data" id="form_post">
                                    @csrf
                                <div class="R-Gpdg">
                                    <div class="volt8A">
                                        <table class="Zj7UK+">
                                            <tr>
                                                <td class="espR83">
                                                    <label>Mật khẩu cũ</label>
                                                </td>
                                                <td class="Tmj5Z6">
                                                    <div>
                                                        <div class="W50dp5">
                                                            <input type="password" placeholder="" class="CMyrTJ" value="" name="pre_password" id="pre_password">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="espR83">
                                                    <label>Mật khẩu mới</label>
                                                </td>
                                                <td class="Tmj5Z6">
                                                    <div>
                                                        <div class="W50dp5">
                                                            <input type="password" placeholder="" class="CMyrTJ" value="" name="password" id="password">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="espR83">
                                                    <label>Xác nhận</label>
                                                </td>
                                                <td class="Tmj5Z6">
                                                    <div class="W50dp5">
                                                        <input type="password" placeholder="" class="CMyrTJ" value="" name="repassword">
                                                    </div>
                                                </td>
                                            </tr>
                                        
                                            <tr>
                                                <td class="espR83">
                                                    <label></label>
                                                </td>
                                                <td class="Tmj5Z6">
                                                    <button type="submit" id="sub_button" class="btn btn-solid-primary btn--m btn--inline" aria-disabled="false">Xác nhận đổi</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    
                

                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

         <!-- Bootstrap core JavaScript-->
         <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    <!-- include jQuery library -->
    <!-- include jQuery validate library -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <!-- include Ajax  library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- include jQuery validate library -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
    jQuery.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != param;
    }, "Please specify a different (non-default) value");
    $("#form_post").validate({
        rules: {
            "pre_password": {
                required: true,
                
            },
            "password": {
                required: true,
                minlength: 6,
                notEqual: "pre_password",
                
            },
            "repassword": {
                required: true,
                equalTo: "#password",
            },
        },
       
        submitHandler: function(form) {
            $(form).submit();
        }
    
    });
    </script>

<script>
    const pre_password = document.querySelector('input[name="pre_password"]');
    const password = document.querySelector('input[name="password"]');
    const repassword = document.querySelector('input[name="repassword"]');
    const button = document.getElementById('sub_button');
    button.addEventListener('click', function(){
        if (pre_password.value == '' || password.value == '' || repassword.value == '') {
            swal("Vui lòng nhập mật khẩu đầy đủ thông tin");
            return false;
        }
        else if(password.value != repassword.value){
            swal("Mật khẩu xác nhận không khớp");
            return false;
        }
        else if(password.value.length < 6){
            swal("Mật khẩu phải có ít nhất 6 ký tự");
            return false;
        }
        // else if(password.value == pre_password.value){
        //     swal("Mật khẩu mới không được trùng với mật khẩu cũ");
        //     return false;
        // }
        else{
            return true;
            
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
            img.style.backgroundImage = `url("{{asset('storage/users_img/user.png')}}")`;
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