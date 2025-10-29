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
    <link href="{{asset('css/sb-admin-2.min.css')}}"  rel="stylesheet">
    <link href="{{asset('css/upfile.css')}}"  rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

    <title>Thêm sản phẩm</title>
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
                
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-1 text-gray-800">Thông tin cơ bản</h1> -->
                    

                    <!-- Content Row -->
                    <div class="row">
                        
                        <!-- First Column -->
                    <form action="{{route('shop_add_products')}}" method="GET" enctype="multipart/form-data" id="form_add_product">
                        @csrf
                        <div class="col-lg-10"> 
                            
                            <!-- Custom Text Color Utilities -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h4 class="m-0 font-weight-bold text-primary">Thông Tin Cơ Bản</h4>
                                </div>
                                <div class="card-body " >
                                    <div class="add_product_info" style="display: flex;">
                                        <div class="add_product_info_t">
                                            <p class="text-gray-900 p-3 m-0" >Tên sản phẩm</p>
                                        </div>
                                        <input  type="text" name="product_name" id="product_name" class="product_name number_cart" placeholder="Nhập tên sản phẩm" required>
                                    </div>
                                    <div class="add_product_info" style="display: flex;">
                                        <div class="add_product_info_t">
                                            <p class="text-gray-900 p-3 m-0" >Giá sản phẩm</p>
                                        </div>
                                        <input  type="number" min="1" max="999999999"  name="product_price" id="product_price" class="product_name" placeholder="Nhập giá sản phẩm" required>
                                    </div>
                                    <div class="add_product_info" style="display: flex;">
                                        <div class="add_product_info_t">
                                            <p class="text-gray-900 p-3 m-0" >Ngành hàng</p>
                                        </div>
                                        <select name="category" id="category" class="product_name choose_category" required>
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
                                        <textarea  id="description" class="description_product" name="description" type="textarea" resize="none" autosize="true"  style="resize: none; min-height: 209.6px; height: 209.6px;" >
                                        </textarea>   
                                    </div>                          
                                </div>
                            </div>

                            <!-- Custom Font Size Utilities -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3" style="display:flex; text-align: center;">
                                    <h4 class="m-0 font-weight-bold text-primary">Thông Tin Bán Hàng (không bắt buộc)</h4>
                                    
                                </div>
                                <div class="card-body"> 
                                    <div class="add_product_info" style="display: flex;">
                                        <div class="add_product_info_t">
                                            <p class="text-gray-900 p-3 m-0" >Phân Loại Hàng</p>
                                        </div>
                                        <div class="add_product_variations">
                                        <div class="add_product_var p-3 ">
                                                <div class="variation_panel">
                                                    <div class="variation_panel_left">
                                                        Nhóm phân loại 1
                                                    </div>
                                                    <div class="variation_panel_right">
                                                        <input name="variation_option" id="variation_option" class="variation_panel_right_normals" placeholder="Ví dụ: màu sắc v.v">
                                                        
                                                    </div>
                                                </div>   
                                                <div class="add_product_var_bot">
                                                    <div class="variation_panel_left">
                                                        Tên loại hàng
                                                    </div>
                                                    <div class="variation_panel_right">
                                                        <div class="variation_panel_right_item" >
                                                            <div class="variation_panel_right_items" id="variation_div" style="display:flex;">
                                                                <input id="variation_name" class="variation_panel_right_normal" placeholder="Ví dụ: Trắng, Đỏ v.v"  name="variation_option_name">
                                                            </div>
                                                            <div class="variation_panel_right_items" id="variation_div"  >
                                                                <input id="variation_name1" class="variation_panel_right_normal" placeholder="Ví dụ: Trắng, Đỏ v.v"  name="variation_option_name1">
                                                            </div>
                                                            <div class="variation_panel_right_items" id="variation_div"  >
                                                                <input id="variation_name2" class="variation_panel_right_normal" placeholder="Ví dụ: Trắng, Đỏ v.v"  name="variation_option_name2">
                                                            </div>
                                                            <div class="variation_panel_right_items" id="variation_div" >
                                                                <input id="variation_name3" class="variation_panel_right_normal" placeholder="Ví dụ: Trắng, Đỏ v.v"  name="variation_option_name3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="add_product_var p-3 ">
                                                <div class="variation_panel">
                                                    <div class="variation_panel_left">
                                                        Nhóm phân loại 2
                                                    </div>
                                                    <div class="variation_panel_right">
                                                        <input id="variations_options" name="variations_options" class="variation_panel_right_normals" placeholder="Ví dụ: Size v.v">
                                                    </div>
                                                </div>   
                                                <div class="add_product_var_bot">
                                                    <div class="variation_panel_left">
                                                        Tên loại hàng
                                                    </div>
                                                    <div class="variation_panel_right">
                                                        <div class="variation_panel_right_item">
                                                            <div class="variation_panel_right_items">
                                                                <input id="variations_name" class="variation_panel_right_normal" placeholder="Ví dụ: S, M v.v" name="variations_options_name">
                                                            </div>
                                                            <div class="variation_panel_right_items">
                                                                <input id="variations_name1" class="variation_panel_right_normal" placeholder="Ví dụ: S, M v.v" name="variations_options_name1">
                                                            </div>
                                                            <div class="variation_panel_right_items">
                                                                <input id="variations_name2" class="variation_panel_right_normal" placeholder="Ví dụ: S, M v.v" name="variations_options_name2">
                                                            </div>
                                                            <div class="variation_panel_right_items">
                                                                <input id="variations_name3" class="variation_panel_right_normal" placeholder="Ví dụ: S, M v.v" name="variations_options_name3">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                       
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4" style="">
                                
                                <div class="card-body" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-icon-split">
                                        <!-- <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span> -->
                                        <span class="text">Lưu & Nhập Kho Hàng</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>

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


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
   
<!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- include jQuery validate library -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<script>
$("#form_add_product").validate({
    rules: {
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
        "variation_option":{
            maxlength: 14,
        },
        "variation_name":{
            maxlength: 14,
        },
        "variation_name1":{
            maxlength: 14,
        },
        "variation_name2":{
            maxlength: 14,
        },
        "variation_name3":{
            maxlength: 14,
        },
        "variations_options":{
            maxlength: 14,
        },
        "varations_name":{
            maxlength: 14,
        },
        "varations_name1":{
            maxlength: 14,
        },
        "varations_name2":{
            maxlength: 14,
        },
        "varations_name3":{
            maxlength: 14,
        },
	},
    messages: {
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
        "variation_option":{
            maxlength: "Tên nhóm phân loại không được quá 14 ký tự",
        },
        "variation_name":{
            maxlength: "Tên phân loại không được quá 14 ký tự",
        },
        "variation_name1":{
            maxlength: "Tên phân loại không được quá 14 ký tự",
        },
        "variation_name2":{
            maxlength: "Tên phân loại không được quá 14 ký tự",
        },
        "variation_name3":{
            maxlength: "Tên phân loại không được quá 14 ký tự",
        },
        "variations_options":{
            maxlength: "Tên nhóm phân loại không được quá 14 ký tự",
        },
        "varations_name":{
            maxlength: "Tên phân loại không được quá 14 ký tự",
        },
        "varations_name1":{
            maxlength: "Tên phân loại không được quá 14 ký tự",
        },
        "varations_name2":{
            maxlength: "Tên phân loại không được quá 14 ký tự",
        },
        "varations_name3":{
            maxlength: "Tên phân loại không được quá 14 ký tự",
        },
    },
    submitHandler: function(form) {
        $(form).submit();
    }

});
</script>
</body>

</html>