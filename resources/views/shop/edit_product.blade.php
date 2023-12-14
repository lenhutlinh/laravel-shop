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
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}"  rel="stylesheet">
    <link href="{{asset('css/upfile.css')}}"  rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">
    <link href="/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

    <title>Chỉnh sửa sản phẩm</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <form action="{{route('update_product')}}" method="POST" enctype="multipart/form-data" id="edit_quantity_product">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="container-fluid">           
                    <!-- Page Heading -->
                   
                    <!-- DataTales Example -->
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Cập nhật thông tin sản phẩm</h4>
                        </div>                        
                        <div class="card-body">
                            
                            <!-- <div class="add_product_info"> 
                                <p class="text-gray-900 p-3 m-0">Hình ảnh sản phẩm (tối đa 5 hình)</p>
                                <div id="upfile">
                                    <div class="upfile" >
                                        <div class="uploadfile" id="uploadfile">
                                            <div class="image">
                                                <img src="" alt="Image" id="fileup" class="fileup" >
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
                                        <input id="default-btn" type="file" multiple="multiple" name="product_img" accept="image/jpeg, image/png, image/jpg" required hidden>
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
                            </div>      -->
                            <div class="add_product_info" style="display: flex;">
                                    <div class="add_product_info_t">
                                        <p class="text-gray-900 p-3 m-0" >Tên sản phẩm</p>
                                    </div>
                                        <input  type="text" value="{{$product->productName }}" name="product_name" id="product_name" class="product_name" placeholder="Nhập tên sản phẩm" required>
                                    </div>
                                    <div class="add_product_info" style="display: flex;">
                                        <div class="add_product_info_t">
                                            <p class="text-gray-900 p-3 m-0" >Giá sản phẩm</p>
                                        </div>
                                        <input  type="number" value="{{$product->price }}" min="1" max="999999999"  name="product_price" id="product_price" class="product_name number_cart" placeholder="Nhập giá sản phẩm" required>
                                    </div>
                                    <div class="add_product_info" style="display: flex;">
                                        <div class="add_product_info_t">
                                            <p class="text-gray-900 p-3 m-0" >Ngành hàng</p>
                                        </div>
                                        <select name="category"  id="category" class="product_name choose_category" required>
                                            <option value="">--- Chọn Ngành Hàng ---</option> 
                                            @foreach($category as $category)
                                                <option value="{{$category -> id }}">{{$category -> categoryName}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="add_product_info" style="display: flex;">
                                        <div class="add_product_info_t">
                                            <p class="text-gray-900 p-3 m-0" >Loại hàng</p>
                                        </div>
                                        <select name="subcategory" id="subcategory" class="product_name ">
                                            <option value="">--- Chọn Loại Hàng ---</option> 

                                        </select>
                                    </div>
                                    <div class="add_product_info" style="display: flex;">
                                        <div class="add_product_info_t">
                                            <p class="text-gray-900 p-3 m-0" >Mô tả sản phẩm</p>
                                        </div>
                                        <textarea  id="description"  class="description_product" name="description" type="textarea" resize="none" autosize="true"  style="resize: none; min-height: 209.6px; height: 209.6px;" >
                                            {{$product->description}}
                                        </textarea>   
                                    </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable"  cellspacing="0">
                               
                                    <thead>
                                        <tr>
                                            <td>Phân loại: </td>
                                            <td>Nhập số lượng kho</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($combination_string as $combination)
                                        <tr>
                                            <td>
                                                {{$combination->combination_string }}
                                            </td>
                
                                            <td>
                                                <input id="avaiable_stock" required name='avaiable_stock[]'  type="number" class="form-control form-control-sm" min="1" value="{{$combination->avaiable_stock}}" max="10000" aria-controls="dataTable">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4" style="">
                        <div class="card-body" style="text-align: center;">
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="text">Lưu Cập Nhật Sản Phẩm</span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- include jQuery validate library -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
$("#edit_quantity_product").validate({
    rules: {
		// "default-btn": {
		// 	required: true,
		// },
        "product_name": {
			required: true,
			maxlength: 150,
            minlength: 10,
		},
        "product_price": {
            required: true,
            number: true,
            min: 1000,
            max: 1000000000,
        },
        "category_id": {
            required: true,
        },
        "description": {
            required: true,
            minlength: 10,
            maxlength: 1000,
        },
        // "avaiable_stock": {
        //     required: true,
        //     number: true,
        //     'min': 1,
        //     'max': 100000,
	    // },
    },
    messages:{
        // "default-btn": {
        //     required: "Ít nhất phải có 1 ảnh",
        // },
        "product_name": {
			required: "Vui lòng nhập tên sản phẩm",
			maxlength: "Tên sản phẩm không được quá 150 ký tự",
            minlength: "Tên sản phẩm phải có ít nhất 10 ký tự",
		},
        "product_price": {
            required: "Vui lòng nhập giá sản phẩm",
            number: "Giá sản phẩm phải là số",
            min: "Giá sản phẩm phải lớn hơn 1000",
            max: "Giá sản phẩm phải nhỏ hơn 1000000000",
        },
        "category_id": {
            required: "Vui lòng chọn danh mục sản phẩm",
        },
        "description": {
            required: "Vui lòng nhập mô tả sản phẩm",
            maxlength: "Mô tả sản phẩm không được quá 1000 ký tự",
            minlength: "Mô tả sản phẩm phải có ít nhất 10 ký tự",
        },
    },
    submitHandler: function(form) {
        $(form).submit();
    }

});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.choose_category').on('change',function(){
            
            var category_id = $(this).val();
            $.ajax({
                url: '{{route('select_category')}}',
                method: 'GET',
                data:{category_id:category_id},
                success:function(data){
                    $('#subcategory').html('');
                    var select ='';
                    $.each(data,function(key,value){
                        select += '<option value="'+value.id+'">'+value.subCategoryName	+'</option>';
                    });
                    $('#subcategory').append(select);
                },
            });
        });
    })
</script>
</body>

</html>