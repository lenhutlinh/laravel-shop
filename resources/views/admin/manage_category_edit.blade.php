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
    <title>Cập nhật danh mục</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}"  rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}"  rel="stylesheet">

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
        #fileup{
            width: 125px;
            height: 125px;
            object-fit: cover;
        }
      
	</style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.sidebaradmin')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.topbaradmin')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Cửa hàng đang hoạt động</h1> -->
                    

                    <div class="row" style="justify-content: center;">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Chỉnh sửa danh mục</h1>
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
                                <form class="user" action="{{route('manage_category_edits')}}" method="POST" enctype="multipart/form-data" id="manage_category_edits">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$category->id}}">
                                    
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="categoryName"
                                            placeholder="Nhập tên danh mục " name="categoryName" value="{{$category->categoryName }}">
                                    </div>
                                    <!-- <img src="{{asset('storage/'.$category->categoryIcon)}}" style="height:100px; widght:auto;"/> -->
                                    <div class="form-group" id="uploadfile">
                                        <input type="file" class="form-control-file" id="default-btn" name="categoryIcon" value="{{$category->categoryIcon }}">
                                        <label for="default-btn" id="custom-btn">Chọn hình ảnh</label>
                                        <img src="" alt="" id="fileup">
                                        <button type="button" class="cancel-btn">Xóa</button>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Cập Nhật
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
                        <span>Copyright &copy; Your Website 2025</span>
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
    $("#manage_category_edits").validate({
        rules: {
            "categoryName": {
                required: true,
                minlength: 5,
            },
            "categoryIcon": {
                required: true,
            },
        },
        messages: {
            
            "categoryName": {
                required: "Vui lòng nhập tên danh mục",
                minlength: "Tên danh mục phải có ít nhất 5 ký tự",
            },
            "categoryIcon": {
                required: "Vui lòng chọn hình ảnh",
            },
        },
        submitHandler: function(form) {
            $(form).submit();
        }
    });
    </script>
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
</body>

</html>