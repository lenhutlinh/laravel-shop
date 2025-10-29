<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Quản lý mã giảm giá riêng</title>
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style>
        .coupon-card {
            border-left: 4px solid #4e73df;
            transition: all 0.3s ease;
        }
        .coupon-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .coupon-code {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            color: #4e73df;
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 4px 8px;
            border-radius: 12px;
        }
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }
        .status-expired {
            background: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body id="page-top">
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
                        <h1 class="h3 mb-0 text-gray-800">
                            <i class="fas fa-tags text-primary mr-2"></i>
                            Quản lý mã giảm giá riêng
                        </h1>
                        <a href="{{ route('private-coupons.create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Tạo mã mới
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

                    <!-- Private Coupons Cards -->
                    <div class="row">
                        @foreach($privateCoupons as $coupon)
                        <div class="col-xl-4 col-lg-6 mb-4">
                            <div class="card coupon-card shadow h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                {{ $coupon->name }}
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 coupon-code">
                                                {{ $coupon->code }}
                                            </div>
                                            <div class="text-xs text-muted mb-2">
                                                {{ $coupon->description }}
                                            </div>
                                            
                                            <!-- Coupon Details -->
                                            <div class="row">
                                                <div class="col-6">
                                                    <small class="text-muted">Loại:</small><br>
                                                    <span class="font-weight-bold">
                                                        {{ $coupon->type == 'percentage' ? $coupon->value.'%' : number_format($coupon->value).'đ' }}
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Đơn tối thiểu:</small><br>
                                                    <span class="font-weight-bold">
                                                        {{ $coupon->minimum_amount ? number_format($coupon->minimum_amount).'đ' : 'Không' }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <small class="text-muted">Sử dụng:</small><br>
                                                    <span class="font-weight-bold">
                                                        {{ $coupon->used_count }}/{{ $coupon->usage_limit ?? '∞' }}
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Hết hạn:</small><br>
                                                    <span class="font-weight-bold text-danger">
                                                        {{ \Carbon\Carbon::parse($coupon->end_date)->format('d/m/Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <!-- Status -->
                                            <div class="mt-3">
                                                @if(!$coupon->is_active)
                                                    <span class="status-badge status-inactive">Tạm dừng</span>
                                                @elseif(\Carbon\Carbon::now()->gt($coupon->end_date))
                                                    <span class="status-badge status-expired">Hết hạn</span>
                                                @else
                                                    <span class="status-badge status-active">Hoạt động</span>
                                                @endif
                                                
                                                @if($coupon->shop)
                                                    <span class="badge badge-info ml-1">{{ $coupon->shop->shopname }}</span>
                                                @else
                                                    <span class="badge badge-secondary ml-1">Tất cả shop</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tag fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('private-coupons.edit', $coupon->id) }}" 
                                           class="btn btn-info btn-sm" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" 
                                                onclick="deleteCoupon({{ $coupon->id }})" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $privateCoupons->links() }}
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function deleteCoupon(id) {
            swal({
                title: "Xác nhận xóa?",
                text: "Bạn có chắc chắn muốn xóa mã giảm giá này?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // Tạo form để submit DELETE request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ url("admin/private-coupons") }}/' + id;
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    const tokenField = document.createElement('input');
                    tokenField.type = 'hidden';
                    tokenField.name = '_token';
                    tokenField.value = '{{ csrf_token() }}';
                    
                    form.appendChild(methodField);
                    form.appendChild(tokenField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>
