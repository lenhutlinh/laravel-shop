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
    <title>Danh mục sản phẩm</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <style>
        /* Sidebar Dark Theme */
        .sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%) !important;
        }
        
        .sidebar-brand {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
            border-radius: 10px;
            margin: 10px;
            transition: all 0.3s ease;
        }
        
        .sidebar-brand:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
        
        .sidebar-brand-text {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .sidebar-brand-icon {
            color: #ffffff !important;
        }
        
        .sidebar-heading {
            color: #bdc3c7 !important;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .nav-link {
            color: #ecf0f1 !important;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 8px;
        }
        
        .nav-link:hover {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
            color: #ffffff !important;
            transform: translateX(5px);
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
            color: #ffffff !important;
        }
        
        .nav-link i {
            color: #bdc3c7 !important;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover i,
        .nav-link.active i {
            color: #ffffff !important;
        }
        
        .sidebar-divider {
            border-color: #34495e !important;
            margin: 1rem 0;
        }
        
        /* Dark theme for dropdown content */
        .sidebar .collapse-inner {
            background: #2c3e50 !important;
            border-radius: 8px !important;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
        }
        
        .sidebar .collapse-item {
            color: #ecf0f1 !important;
            transition: all 0.3s ease;
            border-radius: 6px;
            margin: 2px 8px;
        }
        
        .sidebar .collapse-item:hover {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
            color: #ffffff !important;
            transform: translateX(5px);
        }
        
        .sidebar .collapse-item.active {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
            color: #ffffff !important;
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Danh sách danh mục sản phẩm</h1>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                            <i class="fas fa-plus"></i> Thêm Danh mục chính
                        </button>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên danh mục</th>
                                            <th>Logo danh mục</th>
                                            <th>Số danh mục phụ</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên danh mục</th>
                                            <th>Logo danh mục</th>
                                            <th>Số danh mục phụ</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($category as $key => $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                {{$item->categoryName }}
                                            </td>
                                            <td>
                                                <img src="{{asset('storage/'.$item->categoryIcon)}}" style="height:100px; width:auto;"/>
                                            </td>
                                            <td>{{$item->count }} </td>
                                           
                                            
                                            <td style="justify-content: center; align-items: flex-start; text-align: center;">
                                                <a href="{{route('manage_category_edit',$item->id)}}" class="btn btn-sm btn-warning mr-1" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{route('manage_subcategory',$item->id)}}" class="btn btn-sm btn-info mr-1" title="Xem danh mục phụ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger delete-category" data-id="{{$item->id}}" title="Xóa">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Thêm Danh mục chính</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="addCategoryForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="categoryName">Tên danh mục <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả danh mục</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả cho danh mục (tùy chọn)"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categoryIcon">Logo danh mục <span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" id="categoryIcon" name="categoryIcon" accept="image/*" required>
                            <small class="form-text text-muted">Chọn file ảnh (JPG, PNG, GIF)</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                        <button class="btn btn-primary" type="submit">Thêm danh mục</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
    <script>
    $(document).ready(function(){
        // Add Category Form
        $('#addCategoryForm').on('submit', function(e){
            e.preventDefault();
            
            var formData = new FormData(this);
            var _token = $('input[name="_token"]').val();
            
            $.ajax({
                url: '{{route("add_category")}}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status == true){
                        swal("Thành công!", "Đã thêm danh mục mới", "success");
                        $('#addCategoryModal').modal('hide');
                        $('#addCategoryForm')[0].reset();
                        location.reload();
                    } else {
                        swal("Thất bại!", data.message || "Có lỗi xảy ra", "error");
                    }
                },
                error: function(data){
                    var errors = data.responseJSON;
                    if(errors.errors){
                        var errorMessage = '';
                        $.each(errors.errors, function(key, value){
                            errorMessage += value[0] + '\n';
                        });
                        swal("Lỗi validation!", errorMessage, "error");
                    } else {
                        swal("Thất bại!", "Có lỗi xảy ra khi thêm danh mục", "error");
                    }
                }
            });
        });

        // Delete Category
        $(document).on('click', '.delete-category', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var _token = $('input[name="_token"]').val();
            
            console.log('Delete category clicked, ID:', id);
            
            swal({
                title: "Xác nhận xóa danh mục?",
                text: "Bạn có chắc chắn muốn xóa danh mục này? Tất cả danh mục phụ và sản phẩm thuộc về danh mục này cũng sẽ bị xóa vĩnh viễn!",
                icon: "warning",
                buttons: {
                    cancel: "Không",
                    confirm: {
                        text: "Xác nhận xóa",
                        value: true
                    }
                },
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    console.log('Proceeding with delete for ID:', id);
                    
                    $.ajax({
                        url: '{{route("delete_category")}}',
                        method: 'POST',
                        data:{
                            id: id,
                            _token: _token,
                        },
                        success: function(data){
                            console.log('Delete response:', data);
                            if(data.status == true){
                                swal("Thành công!", "Đã xóa danh mục", "success");
                                location.reload();
                            } else {
                                swal("Thất bại!", data.message || "Có lỗi xảy ra", "error");
                            }
                        },
                        error: function(xhr, status, error){
                            console.log('Delete error:', xhr.responseText);
                            var errors = xhr.responseJSON;
                            swal("Thất bại!", errors.message || "Có lỗi xảy ra khi xóa danh mục", "error");
                        }
                    });
                } else {
                    swal("Đã hủy", "Danh mục không bị xóa", "info");
                }
            });
        });
    });
</script>
</body>

</html>