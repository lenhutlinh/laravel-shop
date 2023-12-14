<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>"  rel="stylesheet">
    <link href="<?php echo e(asset('css/upfile.css')); ?>"  rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/sweetalert.css')); ?>">
    
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <title>Thêm mã giảm</title>

    <!-- Custom fonts for this template -->
    <link href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>"  rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.css')); ?>"  rel="stylesheet">

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
        <?php echo $__env->make('admin.sidebaradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php echo $__env->make('admin.topbaradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Cửa hàng đang hoạt động</h1> -->
                    

                    <div class="row" style="justify-content: center;">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Thêm mã giảm giá</h1>
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
                                <form class="user" action="<?php echo e(route('add_coupons')); ?>" method="POST" enctype="multipart/form-data" id="add_subcategorys">
                                    <?php echo csrf_field(); ?>
                                    
                                    <div class="form-group row" >
                                        <div class="col-sm-3 mb-3 mb-sm-0" >
                                            <label for="category">Tên mã giảm giá</label>
                                        </div>
                                        <div class="col-sm-9 mb-3 mb-sm-0">
                                            <input type="text" class="form-control " id="" name="coupon_name" placeholder="vd: Khuyến mãi tháng 12">
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <div class="col-sm-3 mb-3 mb-sm-0" >
                                            <label for="category">Mã giảm giá</label>
                                        </div>
                                        <div class="col-sm-9 mb-3 mb-sm-0">
                                            <input type="text" class="form-control " id="" name="coupon_code" placeholder="vd: CTU10">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row" >
                                        <div class="col-sm-3 mb-3 mb-sm-0" >
                                            <label for="category">Loại giảm giá</label>
                                        </div>
                                        <div class="col-sm-9 mb-3 mb-sm-0">
                                            <select class="form-control" name="coupon_type" id="coupon_type">
                                                <option value="1">Giảm theo tiền hàng</option>
                                                <option value="2">Giảm theo % đơn hàng</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <div class="col-sm-3 mb-3 mb-sm-0" >
                                            <label for="category">Số % hoặc tiền giảm</label>
                                        </div>
                                        <div class="col-sm-9 mb-3 mb-sm-0">
                                            <input type="number" class="form-control " id="coupon_value" name="coupon_value" placeholder="vd: 10 or 200000">
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <div class="col-sm-3 mb-3 mb-sm-0" >
                                            <label for="category">Điều kiện giảm</label>
                                        </div>
                                        <div class="col-sm-9 mb-3 mb-sm-0">
                                            <input type="number" class="form-control " id="coupon_condition" name="coupon_condition" placeholder="vd: 1000000 (đơn hàng trên 1 triệu VNĐ)">
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <div class="col-sm-3 mb-3 mb-sm-0" >
                                            <label for="category">Số lượng</label>
                                        </div>
                                        <div class="col-sm-9 mb-3 mb-sm-0">
                                            <input type="number" class="form-control " id="coupon_amount" name="coupon_amount" placeholder="vd: 50">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" id="button_form">
                                        Thêm
                                    </button>
                                </form>
                                <hr>
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
    <script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo e(asset('js/sb-admin-2.min.js')); ?>"></script>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(asset('js/demo/datatables-demo.js')); ?>"></script>
    <!-- include jQuery library -->
    <!-- include jQuery validate library -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <!-- include Ajax  library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- include jQuery library -->
    <script src="" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- include jQuery validate library -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
    const coupon_type = document.querySelector('input[name="coupon_type"]');
    const coupon_value = document.querySelector('input[name="coupon_value"]');
    const button = document.getElementById('button_form');
    console.log(coupon_type);
    button.addEventListener('click', function(){
        if (coupon_type==2 && coupon_value >= 100){
            swal("Số tiền giảm không được lớn hơn 100%"); 
            return false;
        }
        
    });
</script>
    <script>
    jQuery.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != param;
    }, "Vui lòng chọn loại giảm giá");
    $("#add_subcategorys").validate({
        rules: {
            
            "coupon_type": {
                required: true,
                notEqual: "0",
            },
            "coupon_name": {
                required: true,
                minlength: 4,
            },
            "coupon_code": {
                required: true,
                minlength: 4,
            },
            "coupon_value": {
                required: true,
                number: true,
                min: 1,
            },
            "coupon_condition": {
                required: true,
                number: true,
                min: 1,
            },
            "coupon_amount": {
                required: true,
                number: true,
                min: 1,
            },
        },
        messages: {
            
            "coupon_type": {
                required: "Vui lòng chọn loại giảm giá",
                notEqual: "Vui lòng chọn loại giảm giá",
            },
            "coupon_name": {
                required: "Vui lòng nhập tên mã giảm giá",
                minlength: "Tên mã giảm giá phải có ít nhất 4 ký tự",
            },
            "coupon_code": {
                required: "Vui lòng nhập mã giảm giá",
                minlength: "Mã giảm giá phải có ít nhất 4 ký tự",
            },
            "coupon_value": {
                required: "Vui lòng nhập số % hoặc tiền giảm",
                number: "Vui lòng nhập số % hoặc tiền giảm",
                min: "Số % hoặc tiền giảm không được nhỏ hơn 1",
            },
            "coupon_condition": {
                required: "Vui lòng nhập điều kiện giảm",
                number: "Vui lòng nhập điều kiện giảm",
                min: "Điều kiện giảm không được nhỏ hơn 1",
            },
            "coupon_amount": {
                required: "Vui lòng nhập số lượng",
                number: "Vui lòng nhập số lượng",
                min: "Số lượng không được nhỏ hơn 1",
            },
            
        },
        submitHandler: function(form) {
            $(form).submit();
        }

    });
    </script>

</body>

</html>

<?php /**PATH D:\Ecommerce\resources\views/admin/add_coupon.blade.php ENDPATH**/ ?>