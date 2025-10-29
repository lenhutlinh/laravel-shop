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
    <title>Danh sách cửa hàng</title>
    
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
            min-height: 140px;
            height: 140px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }
        
        .stats-card .card-body {
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            flex: 1;
        }
        
        .stats-card .text-xs {
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            line-height: 1.2;
            word-wrap: break-word;
            overflow-wrap: break-word;
            color: white !important;
            flex-shrink: 0;
        }
        
        .stats-card .h5 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0;
            line-height: 1;
            color: white !important;
            flex: 1;
            display: flex;
            align-items: center;
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
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            background: rgba(255,255,255,0.2);
            margin-left: auto;
            flex-shrink: 0;
            margin-top: auto;
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

        .stop_shop {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            color: white;
        }

        .stop_shop:hover {
            background: linear-gradient(135deg, #c82333 0%, #e55a00 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .edit_shop {
            background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
            color: white;
        }

        .edit_shop:hover {
            background: linear-gradient(135deg, #138496 0%, #5a32a3 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
        }

        /* Shop Image */
        .shop-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Revenue styling */
        .revenue-amount {
            font-weight: bold;
            color: #28a745;
            font-size: 1.1rem;
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
                                    <i class="fas fa-store mr-2"></i>
                                    Danh Sách Cửa Hàng
                                </h1>
                                <p class="text-white-50 mb-0">Quản lý các cửa hàng đang hoạt động</p>
                            </div>
                            <div class="col-auto">
                                <span class="badge badge-light badge-lg">
                                    <i class="fas fa-building mr-1"></i>
                                    {{ $shop->count() }} cửa hàng hoạt động
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
                                            Tổng Cửa Hàng
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $shop->count() }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stats-icon primary">
                                            <i class="fas fa-store"></i>
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
                                            Tổng Doanh Thu
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($shop->sum('order_total'), 0, ',', '.') }}đ</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stats-icon success">
                                            <i class="fas fa-dollar-sign"></i>
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
                                            Cửa Hàng Mới
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $shop->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stats-icon warning">
                                            <i class="fas fa-plus-circle"></i>
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
                                            Doanh Thu TB
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $shop->count() > 0 ? number_format($shop->avg('order_total'), 0, ',', '.') : 0 }}đ</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stats-icon info">
                                            <i class="fas fa-chart-line"></i>
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
                                Danh Sách Cửa Hàng Hoạt Động
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
                                            <th>Tên cửa hàng</th>
                                            <th>Logo cửa hàng</th>
                                            <th>Email đăng ký</th>
                                            <th>Ngày đăng ký</th>
                                            <th>Doanh thu</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Tên cửa hàng</th>
                                            <th>Logo cửa hàng</th>
                                            <th>Email đăng ký</th>
                                            <th>Ngày đăng ký</th>
                                            <th>Doanh thu</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($shop as $key => $item)
                                        <tr>
                                            <td>
                                                <a href="{{route('view_shop',$item->id)}}">
                                                {{$item->shopname }}
                                                </a>
                                            </td>
                                            <td>
                                                <img src="{{asset('storage/'.$item->shopImg)}}" style="height:100px; widght:auto;"/>
                                            </td>
                                            <td>{{$item->email }} </td>
                                            <td>
                                            {{date('d/m/Y  H:i:s', strtotime($item->created_at))}}
                                            </td>
                                            <td>
                                                {{number_format($item->order_total,0,',','.')}} VNĐ
                                            </td>
                                            <td style="justify-content: center; align-items: flex-start; text-align: center;">
                                                <a href="{{route('manage_shop_edit' ,$item->shopname)}}" class="table-left-product-tools">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>
                                                </a>
                                                <span  class="table-left-product-tools stop_shop"  data-id_product="{{$item->id}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sign-stop" viewBox="0 0 16 16">
                                                        <path d="M3.16 10.08c-.931 0-1.447-.493-1.494-1.132h.653c.065.346.396.583.891.583.524 0 .83-.246.83-.62 0-.303-.203-.467-.637-.572l-.656-.164c-.61-.147-.978-.51-.978-1.078 0-.706.597-1.184 1.444-1.184.853 0 1.386.475 1.436 1.087h-.645c-.064-.32-.352-.542-.797-.542-.472 0-.77.246-.77.6 0 .261.196.437.553.522l.654.161c.673.164 1.06.487 1.06 1.11 0 .736-.574 1.228-1.544 1.228Zm3.427-3.51V10h-.665V6.57H4.753V6h3.006v.568H6.587Z"/>
                                                        <path fill-rule="evenodd" d="M11.045 7.73v.544c0 1.131-.636 1.805-1.661 1.805-1.026 0-1.664-.674-1.664-1.805V7.73c0-1.136.638-1.807 1.664-1.807 1.025 0 1.66.674 1.66 1.807Zm-.674.547v-.553c0-.827-.422-1.234-.987-1.234-.572 0-.99.407-.99 1.234v.553c0 .83.418 1.237.99 1.237.565 0 .987-.408.987-1.237Zm1.15-2.276h1.535c.82 0 1.316.55 1.316 1.292 0 .747-.501 1.289-1.321 1.289h-.865V10h-.665V6.001Zm1.436 2.036c.463 0 .735-.272.735-.744s-.272-.741-.735-.741h-.774v1.485h.774Z"/>
                                                        <path fill-rule="evenodd" d="M4.893 0a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146A.5.5 0 0 0 11.107 0H4.893ZM1 5.1 5.1 1h5.8L15 5.1v5.8L10.9 15H5.1L1 10.9V5.1Z"/>
                                                    </svg>
                                                </span>
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
        $('.stop_shop').click(function(){
            var id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            console.log(id);
            swal("Xác nhận khóa cửa hàng?", {
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
                        url: '{{route('stop_shop')}}',
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