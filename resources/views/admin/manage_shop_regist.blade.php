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
    <title>Cửa hàng chờ duyệt</title>
    
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
        
        /* Dashboard Improvements */
        body {
            background-color: #f8f9fc;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .page-header h1 {
            color: white !important;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        /* Stats Cards */
        .stats-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 1.5rem;
            min-height: 120px;
            padding: 1.5rem;
        }
        
        .stats-card .card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        
        .stats-card .text-xs {
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            line-height: 1.2;
            word-wrap: break-word;
            overflow-wrap: break-word;
            color: white !important;
        }
        
        .stats-card .h5 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            line-height: 1;
            color: white !important;
        }
        
        /* Force all text in stats cards to be white */
        .stats-card * {
            color: white !important;
        }
        
        .stats-card .card-body * {
            color: white !important;
        }
        
        .stats-card .text-xs,
        .stats-card .h5,
        .stats-card .text-primary,
        .stats-card .text-success,
        .stats-card .text-info,
        .stats-card .text-warning {
            color: white !important;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .stats-card.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stats-card.success {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stats-card.warning {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stats-card.info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: white;
            background: rgba(255,255,255,0.2);
            margin-left: auto;
            flex-shrink: 0;
        }

        .stats-icon.primary {
            background: rgba(255,255,255,0.2);
        }

        .stats-icon.success {
            background: rgba(255,255,255,0.2);
        }

        .stats-icon.warning {
            background: rgba(255,255,255,0.2);
        }

        .stats-icon.info {
            background: rgba(255,255,255,0.2);
        }

        /* Table Card */
        .card.shadow.mb-4 {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 1.5rem;
        }

        .card-header h6 {
            color: white !important;
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }

        .card-body {
            padding: 2rem;
            background: white;
        }

        /* Table Styling */
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8f9fc 0%, #e3e6f0 100%);
            border: none;
            color: #5a5c69;
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr {
            border-bottom: 1px solid #f8f9fc;
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fc;
            transform: scale(1.01);
        }

        /* Action Buttons */
        .table-left-product-tools {
            display: inline-block;
            margin: 0 5px;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .accept_shop {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .accept_shop:hover {
            background: linear-gradient(135deg, #218838 0%, #1ea085 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .delete_shop {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            color: white;
        }

        .delete_shop:hover {
            background: linear-gradient(135deg, #c82333 0%, #e55a00 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        /* Shop Image */
        .shop-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Topbar */
        .topbar {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Content Wrapper */
        #content-wrapper {
            background-color: #f8f9fc;
        }

        /* Footer */
        .sticky-footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 0.5rem;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        .stats-card:nth-child(1) { animation-delay: 0.1s; }
        .stats-card:nth-child(2) { animation-delay: 0.2s; }
        .stats-card:nth-child(3) { animation-delay: 0.3s; }
        .stats-card:nth-child(4) { animation-delay: 0.4s; }
    </style>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>

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

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="h3 mb-0 text-white">
                                    <i class="fas fa-clock mr-2"></i>
                                    Cửa Hàng Chờ Duyệt
                                </h1>
                                <p class="text-white-50 mb-0">Quản lý các cửa hàng đang chờ phê duyệt</p>
                            </div>
                            <div class="col-auto">
                                <span class="badge badge-light badge-lg">
                                    <i class="fas fa-store mr-1"></i>
                                    {{ $shop->count() }} cửa hàng chờ duyệt
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="stats-card primary">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Tổng Chờ Duyệt
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $shop->count() }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stats-icon primary">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card success">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Đăng Ký Hôm Nay
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $shop->where('created_at', '>=', today())->count() }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stats-icon success">
                                            <i class="fas fa-calendar-day"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card warning">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Tuần Này
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $shop->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stats-icon warning">
                                            <i class="fas fa-calendar-week"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card info">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Tháng Này
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $shop->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stats-icon info">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-list mr-2"></i>
                                Danh Sách Cửa Hàng Chờ Duyệt
                            </h6>
                        </div>
                        <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Thông Tin Cửa Hàng</th>
                                            <th>Logo</th>
                                            <th>Thông Tin Liên Hệ</th>
                                            <th>Ngày Đăng Ký</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Thông Tin Cửa Hàng</th>
                                            <th>Logo</th>
                                            <th>Thông Tin Liên Hệ</th>
                                            <th>Ngày Đăng Ký</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($shop as $key => $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="mb-1 font-weight-bold text-primary">{{ $item->shopname }}</h6>
                                                        <small class="text-muted">
                                                            <i class="fas fa-id-badge mr-1"></i>
                                                            ID: {{ $item->id }}
                                                        </small>
                                                        <div class="small text-info">
                                                            <i class="fas fa-calendar mr-1"></i>
                                                            Đăng ký: {{ $item->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <img src="{{asset('storage/'.$item->shopImg)}}" class="shop-image" alt="Logo cửa hàng"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="mb-1">
                                                        <i class="fas fa-envelope text-primary mr-1"></i>
                                                        <strong>{{ $item->email }}</strong>
                                                    </div>
                                                    <div class="small text-muted">
                                                        <i class="fas fa-store mr-1"></i>
                                                        Cửa hàng mới
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="font-weight-bold">{{ date('d/m/Y', strtotime($item->created_at)) }}</div>
                                                    <small class="text-muted">{{ date('H:i:s', strtotime($item->created_at)) }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning badge-lg">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Chờ Duyệt
                                                </span>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <span class="table-left-product-tools accept_shop" data-id_shop="{{$item->id}}" title="Duyệt cửa hàng">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <span class="table-left-product-tools delete_shop" data-id_product="{{$item->id}}" title="Từ chối">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                </div>
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
        $('.accept_shop').click(function(){
            var id = $(this).data('id_shop');
            var _token = $('input[name="_token"]').val();
            console.log(id);
            swal("Xác nhận duyệt đăng ký cửa hàng?", {
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
                        url: '{{route('accept_shop')}}',
                        method: 'POST',
                        data:{
                            id: id,
                            _token: _token,
                        },
                        success: function(data){
                            $status = data.status;
                            if($status == true){
                                location.reload();
                            }
                            else{
                                swal("Thất bại!", "error");
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
    $(document).ready(function(){
        $('.delete_shop').click(function(){
            var id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            console.log(id);
            swal("Xác nhận hủy đăng ký cửa hàng?", {
                buttons: {
                    cancel: "Không",
                    catch: {
                    text: " Xác Nhận",
                    value: "catch",
                    },
                },
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                    $.ajax({
                        url: '{{route('delete_shop')}}',
                        method: 'POST',
                        data:{
                            id: id,
                            _token: _token,
                        },
                        success: function(data){
                            $status = data.status;
                            if($status == true){
                                location.reload();
                            }
                            else{
                                swal("Thất bại!", "error");
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