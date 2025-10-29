<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">
    
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <title>Chi tiết hoa hồng - {{ $shop->shopname }}</title>
    
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

        .commission-summary-card {
            border-left: 4px solid #4e73df;
            transition: all 0.3s ease;
        }

        .commission-summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .commission-amount {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .pending-commission {
            color: #f39c12;
        }

        .paid-commission {
            color: #27ae60;
        }

        .total-commission {
            color: #3498db;
        }

        .order-commission {
            color: #e74c3c;
        }

        .commission-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .commission-table .text-primary {
            color: #007bff !important;
        }

        .commission-table .text-info {
            color: #17a2b8 !important;
        }

        .commission-table .text-warning {
            color: #ffc107 !important;
        }

        .commission-table .text-success {
            color: #28a745 !important;
        }

        .commission-table .order-commission {
            color: #dc3545 !important;
            font-weight: bold;
        }
    </style>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Chi tiết hoa hồng</h1>
                        <a href="{{ route('manage_commission') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
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

                    <!-- Shop Info Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Thông tin cửa hàng</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    @if($shop->shopImg)
                                        <img src="{{ asset('storage/' . $shop->shopImg) }}" class="img-fluid rounded" alt="Shop Image">
                                    @else
                                        <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded" style="width: 100px; height: 100px;">
                                            <i class="fas fa-store fa-3x"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <h4 class="font-weight-bold">{{ $shop->shopname }}</h4>
                                    <p class="text-muted mb-1"><i class="fas fa-envelope"></i> {{ $shop->email }}</p>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-percentage"></i> 
                                        Tỷ lệ hoa hồng: <span class="font-weight-bold text-primary">{{ $shop->commissionRate->rate ?? 4.00 }}%</span>
                                    </p>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-calendar"></i> 
                                        Ngày tạo: {{ $shop->created_at->format('d/m/Y H:i:s') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Commission Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tổng hoa hồng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 total-commission">
                                                {{ number_format($shop->commissionRate->total_commission ?? 0, 0, ',', '.') }} VNĐ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Chưa thanh toán</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 pending-commission">
                                                {{ number_format($shop->commissionRate->pending_commission ?? 0, 0, ',', '.') }} VNĐ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Đã thanh toán</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 paid-commission">
                                                {{ number_format($shop->commissionRate->paid_commission ?? 0, 0, ',', '.') }} VNĐ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Tổng đơn hàng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $totalOrders }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Commission Calculation Info -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cách tính hoa hồng</h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Công thức tính hoa hồng mới:</h5>
                                <p class="mb-2"><strong>1. Tổng tiền khách phải trả = (Giá sản phẩm gốc - Giảm giá) + Phí ship</strong></p>
                                <p class="mb-2"><strong>2. Giá trị tính hoa hồng = Giá sản phẩm gốc - Giảm giá</strong></p>
                                <p class="mb-2"><strong>3. Hoa hồng sàn = Giá trị tính hoa hồng × {{ $shop->commissionRate->rate ?? 4.00 }}%</strong></p>
                                <p class="mb-2"><strong>4. Số tiền shop nhận = Giá trị tính hoa hồng - Hoa hồng sàn</strong></p>
                                <p class="mb-2"><strong>5. Lợi nhuận sàn = Hoa hồng sàn (chỉ tính hoa hồng, không tính phí ship)</strong></p>
                                <hr>
                                <p class="mb-0"><i class="fas fa-exclamation-triangle text-warning"></i> <strong>Lưu ý:</strong> Hoa hồng chỉ tính trên giá trị sản phẩm (đã trừ coupon), không tính trên phí ship.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lịch sử đơn hàng và hoa hồng</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered commission-table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Khách hàng</th>
                                            <th>Giá sản phẩm gốc</th>
                                            <th>Giảm giá</th>
                                            <th>Phí ship</th>
                                            <th>Tổng khách trả</th>
                                            <th>Giá trị tính hoa hồng</th>
                                            <th>Hoa hồng sàn ({{ $shop->commissionRate->rate ?? 4.00 }}%)</th>
                                            <th>Shop nhận</th>
                                            <th>Ngày tạo</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Khách hàng</th>
                                            <th>Giá sản phẩm gốc</th>
                                            <th>Giảm giá</th>
                                            <th>Phí ship</th>
                                            <th>Tổng khách trả</th>
                                            <th>Giá trị tính hoa hồng</th>
                                            <th>Hoa hồng sàn ({{ $shop->commissionRate->rate ?? 4.00 }}%)</th>
                                            <th>Shop nhận</th>
                                            <th>Ngày tạo</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @php
                                            // Lấy dữ liệu từ order_detail (cột mới)
                                            $orderDetails = DB::table('order_detail')->where('order_id', $order->id)->first();
                                            
                                            // Công thức mới theo yêu cầu:
                                            // 1. Tổng tiền khách phải trả = (product_price - coupon_discount) + shipping_cost
                                            // 2. Giá trị tính hoa hồng = product_price - coupon_discount
                                            // 3. Hoa hồng sàn = net_price * commission_rate
                                            // 4. Số tiền shop nhận = net_price - commission_amount
                                            
                                            if ($orderDetails) {
                                                // Lấy dữ liệu từ order_detail
                                                $product_price = $orderDetails->product_price * $orderDetails->product_quantity; // Giá sản phẩm gốc
                                                $coupon_discount = $orderDetails->coupon_discount ?? 0; // Số tiền giảm giá
                                                $shipping_cost = $orderDetails->shipping_cost ?? 0; // Phí vận chuyển
                                                
                                                // Tính toán theo công thức mới
                                                $total_customer_pay = ($product_price - $coupon_discount) + $shipping_cost; // Tổng tiền khách phải trả
                                                $net_price = $product_price - $coupon_discount; // Giá trị tính hoa hồng
                                                $commission_rate = ($shop->commissionRate->rate ?? 4.00) / 100; // Tỷ lệ hoa hồng
                                                $commission_amount = $net_price * $commission_rate; // Hoa hồng sàn
                                                $shop_revenue = $net_price - $commission_amount; // Số tiền shop nhận
                                            } else {
                                                // Fallback cho đơn hàng cũ
                                                $product_price = $order->order_total;
                                                $coupon_discount = 0;
                                                $shipping_cost = 0;
                                                $total_customer_pay = $order->order_total;
                                                $net_price = $order->order_total;
                                                $commission_rate = ($shop->commissionRate->rate ?? 4.00) / 100;
                                                $commission_amount = $net_price * $commission_rate;
                                                $shop_revenue = $net_price - $commission_amount;
                                            }
                                        @endphp
                                        <tr>
                                            <td>
                                                <span class="font-weight-bold">#{{ $order->id }}</span>
                                            </td>
                                            <td>
                                                <div>
                                                <div class="font-weight-bold">{{ $order->firstname }} {{ $order->lastname }}</div>
                                                <small class="text-muted">{{ $order->email }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-primary">
                                                    {{ number_format($product_price, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-warning">
                                                    -{{ number_format($coupon_discount, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-info">
                                                    {{ number_format($shipping_cost, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-success">
                                                    {{ number_format($total_customer_pay, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-secondary">
                                                    {{ number_format($net_price, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold order-commission">
                                                    {{ number_format($commission_amount, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-success">
                                                    {{ number_format($shop_revenue, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                {{ $order->created_at->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td>
                                                @if($order->order_status == 5)
                                                    <span class="badge badge-success">Hoàn thành</span>
                                                @elseif($order->order_status == 0)
                                                    <span class="badge badge-warning">Chờ xử lý</span>
                                                @elseif($order->order_status == 2)
                                                    <span class="badge badge-danger">Đã hủy</span>
                                                @elseif($order->order_status == 1)
                                                    <span class="badge badge-info">Đã xác nhận</span>
                                                @elseif($order->order_status == 3)
                                                    <span class="badge badge-primary">Vận chuyển</span>
                                                @elseif($order->order_status == 4)
                                                    <span class="badge badge-warning">Đang giao</span>
                                                @else
                                                    <span class="badge badge-secondary">Trạng thái {{ $order->order_status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                {{ $orders->links() }}
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
