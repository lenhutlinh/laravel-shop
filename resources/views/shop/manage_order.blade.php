<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/sb-admin-2.min.css')}}"  rel="stylesheet">
    <link href="{{asset('css/upfile.css')}}"  rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">
    
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <title>Quản Lý Đơn</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
    
    <style>
        .order-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .order-table .text-success {
            color: #28a745 !important;
        }
        
        .order-table .text-info {
            color: #17a2b8 !important;
        }
        
        .order-table .text-primary {
            color: #007bff !important;
        }
        
        .order-table .font-weight-bold {
            font-weight: 700 !important;
        }
        
        /* CSS cho sắp xếp theo trạng thái */
        .status-pending {
            background-color: #fff3cd !important; /* Màu vàng nhạt cho chờ xác nhận */
        }
        
        .status-accepted {
            background-color: #d1ecf1 !important; /* Màu xanh nhạt cho đã xác nhận */
        }
        
        .status-shipping {
            background-color: #d4edda !important; /* Màu xanh lá nhạt cho vận chuyển */
        }
        
        .status-delivering {
            background-color: #e2e3e5 !important; /* Màu xám nhạt cho đang giao */
        }
        
        .status-completed {
            background-color: #f8d7da !important; /* Màu đỏ nhạt cho hoàn thành */
        }
        
        /* Tạo khoảng cách giữa các nhóm trạng thái */
        .order-row {
            border-left: 4px solid transparent;
        }
        
        .order-row.status-0 {
            border-left-color: #ffc107; /* Vàng cho chờ xác nhận */
        }
        
        .order-row.status-1 {
            border-left-color: #17a2b8; /* Xanh dương cho đã xác nhận */
        }
        
        .order-row.status-3 {
            border-left-color: #28a745; /* Xanh lá cho vận chuyển */
        }
        
        .order-row.status-4 {
            border-left-color: #6c757d; /* Xám cho đang giao */
        }
        
        .order-row.status-5 {
            border-left-color: #dc3545; /* Đỏ cho hoàn thành */
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
                    <h1 class="h3 mb-2 text-gray-800">Quản lý đơn hàng</h1>
                    
                    <!-- Thông tin sắp xếp -->
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <strong>Đơn hàng được sắp xếp theo trạng thái:</strong>
                        <span class="badge badge-warning">Chờ xác nhận</span> → 
                        <span class="badge badge-info">Đã xác nhận</span> → 
                        <span class="badge badge-success">Vận chuyển</span> → 
                        <span class="badge badge-secondary">Đang giao</span> → 
                        <span class="badge badge-danger">Hoàn thành</span>
                    </div>
                    
                    <!-- Thông tin cột Shop nhận -->
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-money-bill-wave"></i>
                        <strong>Cột "Shop nhận":</strong> Hiển thị số tiền shop sẽ nhận sau khi trừ hoa hồng 4% từ giá trị sản phẩm (không bao gồm phí ship)
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div> -->
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-bordered order-table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Đơn Hàng</th>
                                            <th>Tên Người Đặt </th>
                                            <th>Giá Sản Phẩm<br><small class="text-muted">(Giá gốc)</small></th>
                                            <th>Phí Ship<br><small class="text-muted">(Tự động)</small></th>
                                            <th>Mã Giảm Giá<br><small class="text-muted">(Số tiền giảm)</small></th>
                                            <th>Tổng Thanh Toán<br><small class="text-muted">(Sau cộng/trừ)</small></th>
                                            <th>Shop Nhận<br><small class="text-muted">(Sau trừ hoa hồng)</small></th>
                                            <th>Tình Trạng Đơn</th>
                                            <th>Thanh Toán</th>
                                            <th>Thời gian đặt</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID Đơn Hàng</th>
                                            <th>Tên Người Đặt </th>
                                            <th>Giá Sản Phẩm<br><small class="text-muted">(Giá gốc)</small></th>
                                            <th>Phí Ship<br><small class="text-muted">(Tự động)</small></th>
                                            <th>Mã Giảm Giá<br><small class="text-muted">(Số tiền giảm)</small></th>
                                            <th>Tổng Thanh Toán<br><small class="text-muted">(Sau cộng/trừ)</small></th>
                                            <th>Shop Nhận<br><small class="text-muted">(Sau trừ hoa hồng)</small></th>
                                            <th>Tình Trạng Đơn</th>
                                            <th>Thanh Toán</th>
                                            <th>Thời Gian Đặt</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($order as $item)
                                        @php
                                            // === CÔNG THỨC TÍNH MỚI THEO YÊU CẦU ===
                                            
                                            // 1. GIÁ SẢN PHẨM = Tổng giá sản phẩm ban đầu (cộng tất cả sản phẩm)
                                            $orderDetails = DB::table('order_detail')->where('order_id', $item->id)->get();
                                            $original_product_value = 0;
                                            $coupon_discount = 0;
                                            $coupon_code = '';
                                            
                                            foreach ($orderDetails as $detail) {
                                                $original_product_value += $detail->product_price * $detail->product_quantity;
                                                $coupon_discount += $detail->coupon_discount ?? 0;
                                                
                                                // Lấy coupon code từ detail đầu tiên
                                                if (empty($coupon_code) && $detail->coupon_id) {
                                                    $coupon = DB::table('coupon')->where('id', $detail->coupon_id)->first();
                                                    if ($coupon) {
                                                        $coupon_code = $coupon->coupon_code;
                                                    }
                                                }
                                            }
                                            
                                            // 2. PHÍ SHIP = Tính theo vị trí shop thực tế
                                            $shipping = DB::table('shipping')->where('id', $item->shipping_id)->first();
                                            $shipping_cost = 0;
                                            
                                            if ($shipping && isset($shipping->ship_address)) {
                                                // Lấy thông tin shop hiện tại
                                                $currentShop = DB::table('shop')
                                                    ->where('id', $item->shop_id ?? Session::get('shop_id'))
                                                    ->select('latitude', 'longitude', 'address')
                                                    ->first();
                                                
                                                // Nếu shop đã đăng ký vị trí, tính phí ship theo khoảng cách thực tế
                                                if ($currentShop && $currentShop->latitude && $currentShop->longitude) {
                                                    // Lấy tọa độ từ địa chỉ giao hàng (giả định)
                                                    $shippingService = new \App\Services\ShippingCalculationService();
                                                    
                                                    // Ước tính tọa độ từ địa chỉ giao hàng
                                                    $customerCoords = $shippingService->getCoordinatesFromAddress($shipping->ship_address);
                                                    
                                                    if ($customerCoords) {
                                                        // Tính phí ship theo khoảng cách thực tế
                                                        $shippingInfo = $shippingService->getShippingInfo(
                                                            $item->shop_id ?? Session::get('shop_id'),
                                                            $shipping->ship_address,
                                                            $customerCoords['lat'],
                                                            $customerCoords['lng']
                                                        );
                                                        $shipping_cost = $shippingInfo['shipping_cost'];
                                                    } else {
                                                        // Fallback: sử dụng method cũ
                                                        $shipping_cost = $shippingService->calculateShippingByDistance($shipping->ship_address);
                                                    }
                                                } else {
                                                    // Shop chưa đăng ký vị trí, sử dụng phí mặc định
                                                    $shipping_cost = 30000;
                                                }
                                            } else {
                                                $shipping_cost = 30000; // Mặc định
                                            }
                                            
                                            // 3. MÃ GIẢM GIÁ = Tổng giá sản phẩm ban đầu - (trừ) cho voucher tương ứng
                                            // (Đã tính ở trên trong vòng lặp)
                                            
                                            // 4. TỔNG THANH TOÁN = Giá sản phẩm + phí ship + mã giảm giá
                                            // Lưu ý: Mã giảm giá là số tiền được giảm (số dương), nên phải CỘNG vào tổng
                                            $total_payment = $original_product_value + $shipping_cost - $coupon_discount;
                                            
                                            // Tính Shop nhận = Giá sản phẩm - 4%
                                            $commission_rate = 0.04; // 4%
                                            $commission_amount = $original_product_value * $commission_rate;
                                            $shop_revenue = $original_product_value - $commission_amount;
                                        @endphp
                                        <tr class="order-row status-{{$item->order_status}}">
                                            <td>
                                                <span class="badge badge-primary font-weight-bold">
                                                    #{{$item->id}}
                                                </span>
                                            </td>
                                            <td>{{$item->firstname .' '.$item->lastname }}</td>
                                            <td>
                                                <span class="text-success font-weight-bold">
                                                    {{number_format($original_product_value, 0, ',', '.')}}đ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-info font-weight-bold">
                                                    {{number_format($shipping_cost, 0, ',', '.')}}đ
                                                </span>
                                                @if($currentShop && $currentShop->latitude && $currentShop->longitude)
                                                    @php
                                                        $customerCoords = $shippingService->getCoordinatesFromAddress($shipping->ship_address);
                                                        if($customerCoords) {
                                                            $distance = $shippingService->calculateDistance(
                                                                $currentShop->latitude, 
                                                                $currentShop->longitude, 
                                                                $customerCoords['lat'], 
                                                                $customerCoords['lng']
                                                            );
                                                        } else {
                                                            $distance = 0;
                                                        }
                                                    @endphp
                                                    @if($distance > 0)
                                                        <br><small class="text-muted">({{number_format($distance, 1)}}km)</small>
                                                    @endif
                                                @else
                                                    <br><small class="text-warning">(Shop chưa đăng ký vị trí)</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($coupon_discount > 0)
                                                    <span class="text-warning font-weight-bold">
                                                        -{{number_format($coupon_discount, 0, ',', '.')}}đ
                                                    </span>
                                                    @if($coupon_code)
                                                        <br><small class="text-muted">({{$coupon_code}})</small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">Không có</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-primary font-weight-bold">
                                                    {{number_format($total_payment, 0, ',', '.')}}đ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-success font-weight-bold">
                                                    {{number_format($shop_revenue, 0, ',', '.')}}đ
                                                </span>
                                                <br><small class="text-muted">(-{{number_format($commission_amount, 0, ',', '.')}}đ hoa hồng 4%)</small>
                                            </td>
                                            @if($item->order_status == 0)
                                                <td>
                                                    <div class="btn btn-warning btn-icon-split">
                                                        <span class="text accept_order" data-order_id="{{$item->id}}">Chưa Duyệt</span>
                                                    </div>
                                                </td>
                                            @elseif($item->order_status == 5)
                                                <td>
                                                    <div href="#" class="btn btn-success btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="text" style="color: yellow;">Hoàn thành</span>
                                                    </div>
                                                    <!-- Không hiển thị nút hủy đơn khi đã hoàn thành -->
                                                </td>
                                            @else
                                                <td>
                                                    <div href="#" class="btn btn-success btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="text">Đã Duyệt</span>
                                                    </div>
                                                </td>
                                            @endif
                                            @if($item->payment_status == 0)
                                                <td>Thanh toán khi nhận hàng</td>
                                            @else
                                                <td>Thanh toán chuyển khoản</td>
                                            @endif
                                            <td>
                                                {{date('d/m/Y  H:i:s', strtotime($item->updated_at))}}
                                            </td>
                                            
                                            @if($item->order_status == 0)
                                            <td style="justify-content: center; align-items: flex-start; text-align: center;">
                                                <a href="{{route('view_order_detail', $item->id)}}" class="btn btn-info btn-icon-split">
                                                    <span class="text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <button class="btn btn-danger btn-icon-split cancel_order" data-order_id="{{$item->id}}" type="button">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                
                                                </button>
                                            </td>
                                            @elseif($item->order_status == 5)
                                            <td style="justify-content: center; align-items: flex-start; text-align: center;">
                                                <a href="{{route('view_order_detail', $item->id)}}" class="btn btn-info btn-icon-split">
                                                    <span class="text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <!-- Không hiển thị nút hủy đơn khi đã hoàn thành -->
                                            </td>
                                            @else
                                            <td style="justify-content: center; align-items: flex-start; text-align: center;">
                                                <a href="{{route('view_order_detail', $item->id)}}" class="btn btn-info btn-icon-split">
                                                    <span class="text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <div class="btn btn-danger btn-icon-split">
                                                    <span class="icon text-white-50 cancel_order" data-order_id="{{$item->id}}">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </div>
                                            </td>   
                                            @endif
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
    
    <style>
        .accept_order {
            cursor: pointer !important;
            user-select: none;
            display: inline-block;
        }
        .accept_order:hover {
            opacity: 0.8;
            background-color: #e0a800 !important;
        }
        .btn-warning .accept_order {
            color: #212529 !important;
        }
    </style>
    <!-- include jQuery validate library -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <!-- include Ajax  library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){
        // Sử dụng event delegation để đảm bảo hoạt động với tất cả các nút
        $(document).on('click', '.accept_order', function(e){
            e.preventDefault();
            var order_id = $(this).data('order_id');
            var _token = $('input[name="_token"]').val();
            console.log('Accept order clicked for ID:', order_id);
            
            // Kiểm tra nếu order_id không tồn tại
            if (!order_id) {
                console.error('Order ID not found');
                alert('Lỗi: Không tìm thấy ID đơn hàng');
                return;
            }
            swal("Xác Nhận Duyệt Đơn Hàng?", {
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
                        url: '{{route('accept_order')}}',
                        method: 'POST',
                        data:{
                            order_id: order_id,
                            _token: _token,
                        },
                        success: function(data){
                            console.log('AJAX Success:', data);
                            $status = data.status; 
                            $product = data.product;
                            if($status == true){
                                swal("Thành công!", "Đơn hàng đã được duyệt", "success").then(() => {
                                    location.reload();
                                });
                            }
                            else{
                                swal("Lỗi!", "Số lượng tồn kho của "+$product+" không đủ để duyệt đơn hàng", "error");
                            }
                        },
                        error: function(xhr, status, error){
                            console.error('AJAX Error:', xhr.responseText);
                            console.error('Status:', status);
                            console.error('Error:', error);
                            swal("Lỗi!", "Có lỗi xảy ra khi duyệt đơn hàng: " + error, "error");
                        }
                    });
                    break;
                    default:
                      
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        // Sử dụng event delegation để đảm bảo nút hoạt động
        $(document).on('click', '.cancel_order', function(e){
            e.preventDefault();
            var order_id = $(this).data('order_id');
            var _token = $('meta[name="csrf-token"]').attr('content');
            
            console.log('Cancel order ID:', order_id);
            
            if (!order_id) {
                swal("Lỗi!", "Không tìm thấy ID đơn hàng", "error");
                return;
            }
            
            swal({
                title: "Xác Nhận Hủy Đơn Hàng?",
                text: "Bạn có chắc chắn muốn hủy đơn hàng #" + order_id + "?",
                icon: "warning",
                buttons: {
                    cancel: "Không",
                    confirm: {
                        text: "Xác Nhận",
                        value: true
                    }
                },
                dangerMode: true
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        url: '{{route('cancel_order')}}',
                        method: 'POST',
                        data: {
                            order_id: order_id,
                            _token: _token
                        },
                        success: function(data) {
                            console.log('Response:', data);
                            if (data.status == true) {
                                swal("Thành công!", data.message, "success").then(function() {
                                    location.reload();
                                });
                            } else {
                                swal("Lỗi!", data.message, "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', xhr.responseText);
                            swal("Lỗi!", "Có lỗi xảy ra khi hủy đơn hàng", "error");
                        }
                    });
                }
            });
        });
    });
</script>
</body>

</html>