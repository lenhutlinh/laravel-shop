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
    <title>Quản lý hoa hồng</title>
    
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

        .commission-card {
            border-left: 4px solid #4e73df;
            transition: all 0.3s ease;
        }

        .commission-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .commission-rate {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4e73df;
        }

        .commission-amount {
            font-size: 1.2rem;
            font-weight: 600;
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
                    <h1 class="h3 mb-2 text-gray-800">Quản lý hoa hồng</h1>
                    <p class="mb-4">Quản lý tỷ lệ hoa hồng và thanh toán cho các cửa hàng</p>

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

                    <!-- Commission Overview Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tổng cửa hàng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $shops->count() }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-store fa-2x text-gray-300"></i>
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
                                                Tổng hoa hồng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ number_format($shops->sum('commissionRate.total_commission'), 0, ',', '.') }} VNĐ
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ number_format($shops->sum('commissionRate.pending_commission'), 0, ',', '.') }} VNĐ
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
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Đã thanh toán</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ number_format($shops->sum('commissionRate.paid_commission'), 0, ',', '.') }} VNĐ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Commission Management Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách cửa hàng và hoa hồng</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tên cửa hàng</th>
                                            <th>Tỷ lệ hoa hồng</th>
                                            <th>Tổng hoa hồng</th>
                                            <th>Chưa thanh toán</th>
                                            <th>Đã thanh toán</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Tên cửa hàng</th>
                                            <th>Tỷ lệ hoa hồng</th>
                                            <th>Tổng hoa hồng</th>
                                            <th>Chưa thanh toán</th>
                                            <th>Đã thanh toán</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($shops as $shop)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($shop->shopImg)
                                                        <img src="{{ asset('storage/' . $shop->shopImg) }}" class="rounded-circle me-2" width="40" height="40" alt="Shop Image">
                                                    @else
                                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                            <i class="fas fa-store"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="font-weight-bold">{{ $shop->shopname }}</div>
                                                        <small class="text-muted">{{ $shop->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="commission-rate">{{ $shop->commissionRate->rate ?? 4.00 }}%</span>
                                            </td>
                                            <td>
                                                <span class="commission-amount total-commission">
                                                    {{ number_format($shop->commissionRate->total_commission ?? 0, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="commission-amount pending-commission">
                                                    {{ number_format($shop->commissionRate->pending_commission ?? 0, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                <span class="commission-amount paid-commission">
                                                    {{ number_format($shop->commissionRate->paid_commission ?? 0, 0, ',', '.') }} VNĐ
                                                </span>
                                            </td>
                                            <td>
                                                @if($shop->commissionRate && $shop->commissionRate->status === 'active')
                                                    <span class="badge badge-success">Hoạt động</span>
                                                @else
                                                    <span class="badge badge-secondary">Tạm dừng</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('commission_detail', $shop->id) }}" class="btn btn-info btn-sm" title="Xem chi tiết">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-warning btn-sm edit-rate-btn" 
                                                            data-shop-id="{{ $shop->id }}" 
                                                            data-current-rate="{{ $shop->commissionRate->rate ?? 4.00 }}"
                                                            title="Chỉnh sửa tỷ lệ">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    @if($shop->commissionRate && $shop->commissionRate->pending_commission > 0)
                                                    <button type="button" class="btn btn-success btn-sm pay-commission-btn" 
                                                            data-shop-id="{{ $shop->id }}" 
                                                            data-pending="{{ $shop->commissionRate->pending_commission }}"
                                                            title="Thanh toán hoa hồng">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                    </button>
                                                    @endif
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

    <!-- Edit Commission Rate Modal -->
    <div class="modal fade" id="editRateModal" tabindex="-1" role="dialog" aria-labelledby="editRateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRateModalLabel">Chỉnh sửa tỷ lệ hoa hồng</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editRateForm">
                        @csrf
                        <input type="hidden" id="edit_shop_id" name="shop_id">
                        <div class="form-group">
                            <label for="edit_rate">Tỷ lệ hoa hồng (%)</label>
                            <input type="number" class="form-control" id="edit_rate" name="rate" step="0.01" min="0" max="100" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <button class="btn btn-primary" type="button" id="saveRateBtn">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pay Commission Modal -->
    <div class="modal fade" id="payCommissionModal" tabindex="-1" role="dialog" aria-labelledby="payCommissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payCommissionModalLabel">Thanh toán hoa hồng</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="payCommissionForm">
                        @csrf
                        <input type="hidden" id="pay_shop_id" name="shop_id">
                        <div class="form-group">
                            <label for="pay_amount">Số tiền thanh toán (VNĐ)</label>
                            <input type="number" class="form-control" id="pay_amount" name="amount" step="1000" min="1000" required>
                            <small class="form-text text-muted">Số tiền tối đa có thể thanh toán: <span id="max_amount">0</span> VNĐ</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <button class="btn btn-success" type="button" id="confirmPayBtn">Xác nhận thanh toán</button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
    $(document).ready(function() {
        // Edit Commission Rate
        $('.edit-rate-btn').click(function() {
            var shopId = $(this).data('shop-id');
            var currentRate = $(this).data('current-rate');
            
            $('#edit_shop_id').val(shopId);
            $('#edit_rate').val(currentRate);
            $('#editRateModal').modal('show');
        });

        $('#saveRateBtn').click(function() {
            var formData = $('#editRateForm').serialize();
            
            $.ajax({
                url: '{{ route("update_commission_rate") }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status) {
                        swal("Thành công!", response.message, "success").then(function() {
                            location.reload();
                        });
                    } else {
                        swal("Lỗi!", response.message, "error");
                    }
                },
                error: function(xhr) {
                    swal("Lỗi!", "Có lỗi xảy ra khi cập nhật tỷ lệ hoa hồng", "error");
                }
            });
        });

        // Pay Commission
        $('.pay-commission-btn').click(function() {
            var shopId = $(this).data('shop-id');
            var pendingAmount = $(this).data('pending');
            
            $('#pay_shop_id').val(shopId);
            $('#pay_amount').val(pendingAmount);
            $('#pay_amount').attr('max', pendingAmount);
            $('#max_amount').text(pendingAmount.toLocaleString());
            $('#payCommissionModal').modal('show');
        });

        $('#confirmPayBtn').click(function() {
            var formData = $('#payCommissionForm').serialize();
            
            swal({
                title: "Xác nhận thanh toán?",
                text: "Bạn có chắc chắn muốn thanh toán hoa hồng này?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willPay) => {
                if (willPay) {
                    $.ajax({
                        url: '{{ route("pay_commission") }}',
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.status) {
                                swal("Thành công!", response.message, "success").then(function() {
                                    location.reload();
                                });
                            } else {
                                swal("Lỗi!", response.message, "error");
                            }
                        },
                        error: function(xhr) {
                            swal("Lỗi!", "Có lỗi xảy ra khi thanh toán hoa hồng", "error");
                        }
                    });
                }
            });
        });
    });
    </script>
</body>

</html>
