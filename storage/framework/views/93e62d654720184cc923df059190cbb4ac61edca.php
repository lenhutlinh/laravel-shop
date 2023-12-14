<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>"  rel="stylesheet">
    <link href="<?php echo e(asset('css/upfile.css')); ?>"  rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/sweetalert.css')); ?>">
    <link href="/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

    <title>Lưu ảnh & nhập kho</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
           
        }
	</style>
</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php echo $__env->make('shop.sidebarshop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php echo $__env->make('shop.topbarshop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
            <form action="<?php echo e(route('add_product_quantitys')); ?>" method="POST" enctype="multipart/form-data" id="add_quantity_product">
                <?php echo csrf_field(); ?>
                <div class="container-fluid">           
                    <!-- Page Heading -->
                   
                    <!-- DataTales Example -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Chọn hình ảnh & nhập kho hàng</h4>
                        </div>
                        <?php

                            $products = Session::get('products');
                            $combination_string = Session::get('combination_string');
        
                        ?>
                        
                        <div class="card-body">
                            <div class="add_product_info"> 
                                <p class="text-gray-900 p-3 m-0">Hình ảnh sản phẩm (Ít nhất 1 hình)</p>
                                <div id="upfile">
                                    <div class="upfile" >
                                        <div class="uploadfile" id="uploadfile">
                                            <div class="image">
                                                <img src="" alt="Image"  id="fileup" class="fileup" required>
                                            </div>
                                            <div class="content">
                                                <div class="icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                    
                                            </div>
                                            <div id="cancel-btn" class="cancel-btn">
                                                <i class="fas fa-times"></i>
                                            </div>
                                    
                                        </div>
                                        <span onclick="defaultBtnActive()" class="custom-btn" id="custom-btn">Chọn Hình Ảnh</span>
                                        <input id="default-btn" required type="file" multiple="multiple" name="product_img" accept="image/jpeg, image/png, image/jpg"  hidden>
                                    </div>
                                    <div class="upfile" >
                                        <div class="uploadfile" id="uploadfile1">
                                            <div class="image">
                                                <img src="" alt="Image" id="fileup1" class="fileup">
                                            </div>
                                            <div class="content">
                                                <div class="icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                            </div>
                                            <div id="cancel-btn" class="cancel-btn1">
                                                <i class="fas fa-times"></i>
                                            </div>
                                    
                                        </div>
                                        <span onclick="defaultBtnActive1()" class="custom-btn" id="custom-btn1">Chọn Hình Ảnh</span>
                                        <input id="default-btn1" type="file"  accept="image/jpeg, image/png, image/jpg"  hidden name="product_img1">
                                    </div>
                                    <div class="upfile" >
                                        <div class="uploadfile" id="uploadfile2">
                                            <div class="image">
                                                <img src="" alt="Image" id="fileup2" >
                                            </div>
                                            <div class="content">
                                                <div class="icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                            </div>
                                            <div id="cancel-btn" class="cancel-btn2">
                                                <i class="fas fa-times"></i>
                                            </div>
                                    
                                        </div>
                                        <span onclick="defaultBtnActive2()" class="custom-btn" id="custom-btn2">Chọn Hình Ảnh</span>
                                        <input id="default-btn2" type="file" accept="image/jpeg, image/png, image/jpg"   hidden name="product_img2">
                                    </div>
                                    <div class="upfile" >
                                        <div class="uploadfile" id="uploadfile3">
                                            <div class="image">
                                                <img src="" alt="Image" id="fileup3" >
                                            </div>
                                            <div class="content">
                                                <div class="icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                            </div>
                                            <div id="cancel-btn" class="cancel-btn3">
                                                <i class="fas fa-times"></i>
                                            </div>
                                    
                                        </div>
                                        <span onclick="defaultBtnActive3()" class="custom-btn" id="custom-btn3">Chọn Hình Ảnh</span>
                                        <input id="default-btn3" type="file" accept="image/jpeg, image/png, image/jpg"  hidden name="product_img3">
                                    </div>
                                    <div class="upfile" >
                                        <div class="uploadfile" id="uploadfile4">
                                            <div class="image">
                                                <img src="" alt="Image" id="fileup4" >
                                            </div>
                                            <div class="content">
                                                <div class="icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                            </div>
                                            <div id="cancel-btn" class="cancel-btn4">
                                                <i class="fas fa-times"></i>
                                            </div>
                                    
                                        </div>
                                        <span onclick="defaultBtnActive4()" class="custom-btn" id="custom-btn4">Chọn Hình Ảnh</span>
                                        <input id="default-btn4" type="file" accept="image/jpeg, image/png, image/jpg" hidden name="product_img4">
                                    </div>
                                </div>
                            </div>     
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                  
                                    <thead>
                                        <tr>
                                            <td>Sản phẩm: <?php echo e($products['productName']); ?></td>
                                            <td>Nhập số lượng kho</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $combination_string; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e($combination); ?>

                                            </td>
                
                                            <td>
                                                <input id="avaiable_stock" name='avaiable_stock[]'  type="number" class="form-control form-control-sm" min="0" value="1" max="10000" aria-controls="dataTable">
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4" style="">
                        <div class="card-body" style="text-align: center;">
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="text">Lưu & Nhập Kho Hàng</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
   
<!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- include jQuery validate library -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    $('#fileup').css('display','none');
     const wrapper = document.querySelector("#uploadfile");
         const defaultBtn = document.querySelector("#default-btn");
         const customBtn = document.querySelector("#custom-btn");
         const cancelBtn = document.querySelector(".cancel-btn ");
         const img = document.querySelector("#fileup");
         let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
         function defaultBtnActive(){
           defaultBtn.click();
         }
         defaultBtn.addEventListener("change", function(){
           const file = this.files[0];
           if(file){
             const reader = new FileReader();
             reader.onload = function(){
               const result = reader.result;
               
               img.src = result;
               wrapper.classList.add("active");
               $('#fileup').css('display','block');
               

             }
             cancelBtn.addEventListener("click", function(){
                defaultBtn.value = "";
               img.src = "";
               wrapper.classList.remove("active");
               $('#fileup').css('display','none');
               })
             reader.readAsDataURL(file);
           }
           if(this.value){
             let valueStore = this.value.match(regExp);
             
           }
         });
    
</script>
<script>
    $('#fileup1').css('display','none');
    const wrapper1 = document.querySelector("#uploadfile1");
    const defaultBtn1 = document.querySelector("#default-btn1");
    const customBtn1 = document.querySelector("#custom-btn1");
    const cancelBtn1 = document.querySelector(".cancel-btn1");
    const img1 = document.querySelector("#fileup1");
    let regExp1 = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
    function defaultBtnActive1(){
        defaultBtn1.click();
    }
    defaultBtn1.addEventListener("change", function(){
        const file1 = this.files[0];
        if(file1){
            const reader1 = new FileReader();
            reader1.onload = function(){
                const result1 = reader1.result;
                img1.src = result1;
                wrapper1.classList.add("active");
                $('#fileup1').css('display','block');
            }
            cancelBtn1.addEventListener("click", function(){
                defaultBtn1.value = "";
                img1.src = "";
                wrapper1.classList.remove("active");
                $('#fileup1').css('display','none');
            })
            reader1.readAsDataURL(file1);
        }
           if(this.value){
             let valueStore1 = this.value.match(regExp1);
            
           }
         });
</script>
<script>
    $('#fileup2').css('display','none');
    const wrapper2 = document.querySelector("#uploadfile2");
    const defaultBtn2 = document.querySelector("#default-btn2");
    const customBtn2 = document.querySelector("#custom-btn2");
    const cancelBtn2 = document.querySelector(".cancel-btn2");
    const img2 = document.querySelector("#fileup2");
    let regExp2 = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
    function defaultBtnActive2(){
        defaultBtn2.click();
    }
    defaultBtn2.addEventListener("change", function(){
        const file2 = this.files[0];
        if(file2){
            const reader2 = new FileReader();
            reader2.onload = function(){
                const result2 = reader2.result;
                img2.src = result2;
                wrapper2.classList.add("active");
                $('#fileup2').css('display','block');
            }
            cancelBtn2.addEventListener("click", function(){
                defaultBtn2.value = "";
                img2.src = "";
                wrapper2.classList.remove("active");
                $('#fileup2').css('display','none');
            })
            reader2.readAsDataURL(file2);
        }
           if(this.value){
             let valueStore2 = this.value.match(regExp2);
            
           }
         });
</script>
<script>
    $('#fileup3').css('display','none');
    const wrapper3 = document.querySelector("#uploadfile3");
    const defaultBtn3 = document.querySelector("#default-btn3");
    const customBtn3 = document.querySelector("#custom-btn3");
    const cancelBtn3 = document.querySelector(".cancel-btn3");
    const img3 = document.querySelector("#fileup3");
    let regExp3 = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
    function defaultBtnActive3(){
        defaultBtn3.click();
    }
    defaultBtn3.addEventListener("change", function(){
        const file3 = this.files[0];
        if(file3){
            const reader3 = new FileReader();
            reader3.onload = function(){
                const result3 = reader3.result;
                img3.src = result3;
                wrapper3.classList.add("active");
                $('#fileup3').css('display','block');
            }
            cancelBtn3.addEventListener("click", function(){
                defaultBtn3.value = "";
                img3.src = "";
                wrapper3.classList.remove("active");
                $('#fileup3').css('display','none');
            })
            reader3.readAsDataURL(file3);
        }
           if(this.value){
             let valueStore3 = this.value.match(regExp3);
            
           }
         });
</script>
<script>
    $('#fileup4').css('display','none');
    const wrapper4 = document.querySelector("#uploadfile4");
    const defaultBtn4 = document.querySelector("#default-btn4");
    const customBtn4 = document.querySelector("#custom-btn4");
    const cancelBtn4 = document.querySelector(".cancel-btn4");
    const img4 = document.querySelector("#fileup4");
    let regExp4 = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
    function defaultBtnActive4(){
        defaultBtn4.click();
    }
    defaultBtn4.addEventListener("change", function(){
        const file4 = this.files[0];
        if(file4){
            const reader4 = new FileReader();
            reader4.onload = function(){
                const result4 = reader4.result;
                img4.src = result4;
                wrapper4.classList.add("active");
                $('#fileup4').css('display','block');
            }
            cancelBtn3.addEventListener("click", function(){
                defaultBtn4.value = "";
                img4.src = "";
                wrapper4.classList.remove("active");
                $('#fileup4').css('display','none');
            })
            reader4.readAsDataURL(file4);
        }
           if(this.value){
             let valueStore4 = this.value.match(regExp4);
            
           }
    });
</script>
<script>
$("#add_quantity_product").validate({
    rules: {
		"product_img"{
            required: true,
        },
        "avaiable_stock": {
            required: true,
            number: true,
            'min': 0,
            'max': 100000,
	    },
    },
    messages:{
        "product_img": {
            required: "Vui lòng chọn ảnh",
        },
        "available_stock": {
            required: "Vui lòng nhập số lượng",
            number: "Vui lòng nhập số",
            'min': "Số lượng phải lớn hơn hoặc bằng 0",
            'max': "Số lượng phải nhỏ hơn 100000",
        },
    },
    submitHandler: function(form) {
        $(form).submit();
    }

});
</script>

</body>

</html><?php /**PATH D:\Ecommerce\resources\views/shop/add_product_quantity.blade.php ENDPATH**/ ?>