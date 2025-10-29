<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quản lý vị trí Shop</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('admin.sidebaradmin')
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('admin.topbaradmin')
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý vị trí Shop</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách Shop và vị trí</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="shopsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Shop</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Vĩ độ (Latitude)</th>
                                    <th>Kinh độ (Longitude)</th>
                                    <th>Vị trí</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shops as $shop)
                                <tr>
                                    <td>{{ $shop->id }}</td>
                                    <td>{{ $shop->shopname }}</td>
                                    <td>{{ $shop->email }}</td>
                                    <td>
                                        <small class="text-muted">{{ $shop->address ?? 'Chưa có địa chỉ' }}</small>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $shop->latitude ?? 'Chưa có' }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $shop->longitude ?? 'Chưa có' }}</span>
                                    </td>
                                    <td>
                                        @if($shop->latitude && $shop->longitude)
                                            <a href="https://www.google.com/maps?q={{ $shop->latitude }},{{ $shop->longitude }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-map-marker-alt"></i> Xem bản đồ
                                            </a>
                                        @else
                                            <span class="text-muted">Chưa có tọa độ</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($shop->latitude && $shop->longitude && $shop->address)
                                            <span class="badge badge-success">Đầy đủ thông tin</span>
                                        @elseif($shop->latitude && $shop->longitude)
                                            <span class="badge badge-warning">Thiếu địa chỉ</span>
                                        @else
                                            <span class="badge badge-danger">Chưa có tọa độ</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thông tin hướng dẫn -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Thông tin vị trí Shop</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Trạng thái thông tin:</h6>
                            <ul class="list-unstyled">
                                <li><span class="badge badge-success">Đầy đủ thông tin</span> - Shop có địa chỉ và tọa độ</li>
                                <li><span class="badge badge-warning">Thiếu địa chỉ</span> - Shop có tọa độ nhưng chưa có địa chỉ</li>
                                <li><span class="badge badge-danger">Chưa có tọa độ</span> - Shop chưa có thông tin vị trí</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Chức năng:</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-eye text-primary"></i> <strong>Xem bản đồ:</strong> Click vào nút "Xem bản đồ" để mở Google Maps</li>
                                <li><i class="fas fa-info-circle text-info"></i> <strong>Thông tin:</strong> Trang này chỉ để xem thông tin vị trí shop</li>
                                <li><i class="fas fa-edit text-warning"></i> <strong>Cập nhật:</strong> Shop có thể cập nhật địa chỉ trong trang profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
</body>

</html>

