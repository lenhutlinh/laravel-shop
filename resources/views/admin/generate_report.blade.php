<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Báo cáo doanh thu và thống kê hệ thống">
    <meta name="author" content="Admin">

    <title>Báo Cáo Doanh Thu - Trang Quản Trị</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1E5F74;
            --secondary-color: #2A7A8C;
            --success-color: #00b894;
            --info-color: #0984e3;
            --warning-color: #fdcb6e;
            --danger-color: #e17055;
            --light-color: #f8f9fa;
            --dark-color: #2d3436;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .ecommerce-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
            color: white;
        }

        .ecommerce-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .ecommerce-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0.5rem 0 0 0;
        }

        .stats-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-icon.primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stats-icon.success { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .stats-icon.info { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .stats-icon.warning { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        
        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
            line-height: 1;
        }

        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0.5rem 0 0 0;
        }

        .chart-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border: none;
            margin-bottom: 2rem;
        }

        .chart-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .chart-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f8f9fa;
        }

        .chart-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
            display: flex;
            align-items: center;
        }

        .chart-title i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .time-filter {
            display: flex;
            gap: 0.5rem;
        }

        .time-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #e9ecef;
            background: white;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #6c757d;
            transition: var(--transition);
            cursor: pointer;
        }

        .time-btn.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .time-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .chart-container {
            height: 400px;
            position: relative;
        }

        .data-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0f0f0;
            margin-top: 1rem;
        }

        .data-table table {
            margin: 0;
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: linear-gradient(135deg, #1E5F74 0%, #2A7A8C 100%);
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
            padding: 1.2rem 1rem;
            border: none;
            position: relative;
            text-align: center;
        }

        .data-table th:first-child {
            border-radius: 8px 0 0 0;
        }

        .data-table th:last-child {
            border-radius: 0 8px 0 0;
        }

        .data-table th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
        }

        .data-table td {
            padding: 1.2rem 1rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .data-table tbody tr {
            transition: all 0.3s ease;
        }

        .data-table tbody tr:hover {
            background: linear-gradient(135deg, #fff5f5 0%, #fef7f0 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(238, 77, 45, 0.1);
        }

        .data-table tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .data-table tbody tr:nth-child(even):hover {
            background: linear-gradient(135deg, #fff5f5 0%, #fef7f0 100%);
        }

        /* Badge styling */
        .data-table .badge {
            font-size: 0.75rem;
            padding: 0.4rem 0.6rem;
            border-radius: 20px;
            font-weight: 600;
        }

        .data-table .badge-primary {
            background: linear-gradient(135deg, #ee4d2d, #ff6b35);
            color: white;
        }

        .data-table .badge-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .data-table .badge-info {
            background: linear-gradient(135deg, #17a2b8, #6f42c1);
            color: white;
        }

        /* Text styling */
        .data-table .text-primary {
            color: #ee4d2d !important;
        }

        .data-table .text-success {
            color: #28a745 !important;
        }

        .data-table .font-weight-bold {
            font-weight: 700 !important;
        }

        .download-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--box-shadow);
            text-align: center;
        }

        .download-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: var(--border-radius);
            padding: 2rem;
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .download-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary-color);
            box-shadow: 0 8px 30px rgba(238, 77, 45, 0.15);
        }

        .download-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }

        .download-icon.pdf { background: linear-gradient(135deg, #ff6b6b, #ee5a24); }
        .download-icon.excel { background: linear-gradient(135deg, #00b894, #00a085); }
        .download-icon.csv { background: linear-gradient(135deg, #0984e3, #74b9ff); }

        .download-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(238, 77, 45, 0.3);
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(238, 77, 45, 0.4);
            color: white;
            text-decoration: none;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .ecommerce-header h1 {
                font-size: 2rem;
            }
            
            .stats-number {
                font-size: 1.8rem;
            }
            
            .chart-container {
                height: 300px;
            }
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
                    <!-- E-commerce Header -->
                    <div class="ecommerce-header">
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                                <h1>
                                    <i class="fas fa-chart-line mr-3"></i>
                                    Báo Cáo Doanh Thu
                            </h1>
                                <p>Thống kê và phân tích hiệu suất kinh doanh</p>
                            </div>
                            <div>
                                <a href="{{ route('dashboard_admin') }}" class="btn btn-light btn-lg">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Quay lại Dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Tổng quan thống kê -->
                        <div class="col-xl-12 col-lg-12 mb-4">
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="stats-card">
                                        <div class="stats-icon primary">
                                            <i class="fas fa-store text-white"></i>
                                                            </div>
                                                            <div class="stats-number">{{ $total_shop }}</div>
                                        <div class="stats-label">Tổng Cửa Hàng</div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="stats-card">
                                        <div class="stats-icon success">
                                            <i class="fas fa-users text-white"></i>
                                                            </div>
                                                            <div class="stats-number">{{ $total_user }}</div>
                                        <div class="stats-label">Tổng Người Dùng</div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="stats-card">
                                        <div class="stats-icon info">
                                            <i class="fas fa-shopping-cart text-white"></i>
                                                            </div>
                                                            <div class="stats-number">{{ $total_order }}</div>
                                        <div class="stats-label">Tổng Đơn Hàng</div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="stats-card">
                                        <div class="stats-icon warning">
                                            <i class="fas fa-dollar-sign text-white"></i>
                                                            </div>
                                                            <div class="stats-number">{{ number_format($total_money, 0, ',', '.') }}đ</div>
                                        <div class="stats-label">Tổng Doanh Thu</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                        <!-- Biểu đồ doanh thu theo thời gian -->
                        <div class="col-xl-12 col-lg-12 mb-4">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h3 class="chart-title">
                                        <i class="fas fa-chart-line"></i>
                                        Sơ Đồ Doanh Thu Theo Thời Gian
                                    </h3>
                                    <div class="time-filter">
                                        <button type="button" class="time-btn active" onclick="showTimeChart('monthly')">Theo Tháng</button>
                                        <button type="button" class="time-btn" onclick="showTimeChart('quarterly')">Theo Quý</button>
                                        <button type="button" class="time-btn" onclick="showTimeChart('yearly')">Theo Năm</button>
                                    </div>
                                </div>
                                <div class="chart-container">
                                    <canvas id="timeChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Doanh thu theo tài khoản khách hàng -->
                        <div class="col-xl-6 col-lg-6 mb-4">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h3 class="chart-title">
                                        <i class="fas fa-users"></i>
                                        Doanh Thu Theo Tài Khoản Khách Hàng
                                    </h3>
                                </div>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="customerChart"></canvas>
                                </div>
                                @if($revenue_by_customer->count() > 0)
                                    <div class="data-table mt-4">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><i class="fas fa-list-ol"></i> STT</th>
                                                    <th><i class="fas fa-user"></i> Khách Hàng</th>
                                                    <th><i class="fas fa-shopping-cart"></i> Tổng Giá Đơn Hàng</th>
                                                    <th><i class="fas fa-chart-line"></i> Doanh Thu</th>
                                                    <th><i class="fas fa-receipt"></i> Đơn Hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($revenue_by_customer->take(10) as $index => $customer)
                                                <tr>
                                                    <td class="text-center"><span class="badge badge-primary">{{ $index + 1 }}</span></td>
                                                    <td><strong>{{ $customer->firstname }} {{ $customer->lastname }}</strong></td>
                                                    <td class="text-right"><span class="text-success font-weight-bold">{{ number_format($customer->total_order_value, 0, ',', '.') }}đ</span></td>
                                                    <td class="text-right"><span class="text-primary font-weight-bold">{{ number_format($customer->total_revenue, 0, ',', '.') }}đ</span></td>
                                                    <td class="text-center"><span class="badge badge-info">{{ $customer->total_orders }}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="fas fa-users"></i>
                                        <p>Chưa có dữ liệu khách hàng</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Doanh thu theo mặt hàng -->
                        <div class="col-xl-6 col-lg-6 mb-4">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h3 class="chart-title">
                                        <i class="fas fa-box"></i>
                                        Doanh Thu Theo Mặt Hàng
                                    </h3>
                                </div>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="productChart"></canvas>
                                </div>
                                @if($revenue_by_product->count() > 0)
                                    <div class="data-table mt-4">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><i class="fas fa-list-ol"></i> STT</th>
                                                    <th><i class="fas fa-box"></i> Sản Phẩm</th>
                                                    <th><i class="fas fa-chart-line"></i> Doanh Thu</th>
                                                    <th><i class="fas fa-sort-numeric-up"></i> Số Lượng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($revenue_by_product->take(10) as $index => $product)
                                                <tr>
                                                    <td class="text-center"><span class="badge badge-primary">{{ $index + 1 }}</span></td>
                                                    <td><strong>{{ Str::limit($product->productName, 30) }}</strong></td>
                                                    <td class="text-right"><span class="text-primary font-weight-bold">{{ number_format($product->total_revenue, 0, ',', '.') }}đ</span></td>
                                                    <td class="text-center"><span class="badge badge-success">{{ $product->total_quantity }}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="fas fa-box"></i>
                                        <p>Chưa có dữ liệu sản phẩm</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Doanh thu theo danh mục -->
                        <div class="col-xl-6 col-lg-6 mb-4">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h3 class="chart-title">
                                        <i class="fas fa-tags"></i>
                                        Doanh Thu Theo Danh Mục
                                    </h3>
                                </div>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="categoryChart"></canvas>
                                </div>
                                @if($revenue_by_category->count() > 0)
                                    <div class="data-table mt-4">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><i class="fas fa-list-ol"></i> STT</th>
                                                    <th><i class="fas fa-tags"></i> Danh Mục</th>
                                                    <th><i class="fas fa-chart-line"></i> Doanh Thu</th>
                                                    <th><i class="fas fa-sort-numeric-up"></i> Số Lượng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($revenue_by_category->take(10) as $index => $category)
                                                <tr>
                                                    <td class="text-center"><span class="badge badge-primary">{{ $index + 1 }}</span></td>
                                                    <td><strong>{{ $category->categoryName }}</strong></td>
                                                    <td class="text-right"><span class="text-primary font-weight-bold">{{ number_format($category->total_revenue, 0, ',', '.') }}đ</span></td>
                                                    <td class="text-center"><span class="badge badge-success">{{ $category->total_quantity }}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="fas fa-tags"></i>
                                        <p>Chưa có dữ liệu danh mục</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <div class="col-xl-6 col-lg-6 mb-4">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h3 class="chart-title">
                                        <i class="fas fa-credit-card"></i>
                                        Phương Thức Thanh Toán
                                    </h3>
                                </div>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="paymentChart"></canvas>
                                </div>
                                @if($payment_methods->count() > 0)
                                    <div class="data-table mt-4">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><i class="fas fa-credit-card"></i> Phương Thức</th>
                                                    <th><i class="fas fa-chart-line"></i> Doanh Thu</th>
                                                    <th><i class="fas fa-receipt"></i> Đơn Hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($payment_methods as $method)
                                                <tr>
                                                    <td><strong>{{ $method->method_name }}</strong></td>
                                                    <td class="text-right"><span class="text-primary font-weight-bold">{{ number_format($method->total_revenue, 0, ',', '.') }}đ</span></td>
                                                    <td class="text-center"><span class="badge badge-info">{{ $method->total_orders }}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="fas fa-credit-card"></i>
                                        <p>Chưa có dữ liệu thanh toán</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Top cửa hàng -->
                        <div class="col-xl-12 col-lg-12 mb-4">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h3 class="chart-title">
                                        <i class="fas fa-trophy"></i>
                                        Top Cửa Hàng Theo Doanh Thu
                                    </h3>
                                </div>
                                    @if($top_shops->count() > 0)
                                    <div class="data-table">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><i class="fas fa-list-ol"></i> STT</th>
                                                    <th><i class="fas fa-store"></i> Tên Cửa Hàng</th>
                                                    <th><i class="fas fa-chart-line"></i> Doanh Thu</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    @foreach($top_shops as $index => $shop)
                                                    <tr>
                                                        <td class="text-center"><span class="badge badge-primary">{{ $index + 1 }}</span></td>
                                                        <td><strong>{{ $shop->shopname }}</strong></td>
                                                        <td class="text-right"><span class="text-primary font-weight-bold">{{ number_format($shop->total_revenue, 0, ',', '.') }}đ</span></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                    <div class="empty-state">
                                        <i class="fas fa-trophy"></i>
                                        <p>Chưa có dữ liệu cửa hàng</p>
                                    </div>
                                    @endif
                            </div>
                        </div>

                        <!-- Tải xuống báo cáo -->
                        <div class="col-xl-12 col-lg-12 mb-4">
                            <div class="download-section">
                                <h3 class="chart-title mb-4">
                                    <i class="fas fa-download"></i>
                                        Tải Xuống Báo Cáo
                                </h3>
                                    <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="download-card">
                                            <div class="download-icon excel">
                                                <i class="fas fa-file-excel text-white"></i>
                                            </div>
                                                <h5>Báo Cáo Excel</h5>
                                                <p class="text-muted">Tải xuống báo cáo định dạng Excel</p>
                                            <button type="button" class="download-btn" data-toggle="modal" data-target="#excelExportModal">
                                                    <i class="fas fa-download mr-2"></i>
                                                    Tải Excel
                                                </button>
                                            </div>
                                        </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="download-card">
                                            <div class="download-icon csv">
                                                <i class="fas fa-file-csv text-white"></i>
                                            </div>
                                                <h5>Báo Cáo CSV</h5>
                                                <p class="text-muted">Tải xuống báo cáo định dạng CSV</p>
                                            <a href="{{ route('download_report', 'csv') }}" class="download-btn">
                                                    <i class="fas fa-download mr-2"></i>
                                                    Tải CSV
                                                </a>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script>
        // Dữ liệu từ server
        var monthlyData = @json($monthly_stats);
        var quarterlyData = @json($quarterly_stats);
        var yearlyData = @json($yearly_stats);
        var customerData = @json($revenue_by_customer);
        var productData = @json($revenue_by_product);
        var categoryData = @json($revenue_by_category);
        var paymentData = @json($payment_methods);

        // Biểu đồ thời gian
        var timeChart;
        var currentTimeType = 'monthly';

        function showTimeChart(type) {
            currentTimeType = type;
            
            // Cập nhật button active
            document.querySelectorAll('.btn-group button').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Cập nhật biểu đồ
            updateTimeChart();
        }

        function updateTimeChart() {
            var ctx = document.getElementById("timeChart");
            if (timeChart) {
                timeChart.destroy();
            }

            var labels, data, title;
            
            if (currentTimeType === 'monthly') {
                labels = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", 
                         "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
                data = [
                    monthlyData[1] || 0, monthlyData[2] || 0, monthlyData[3] || 0, monthlyData[4] || 0,
                    monthlyData[5] || 0, monthlyData[6] || 0, monthlyData[7] || 0, monthlyData[8] || 0,
                    monthlyData[9] || 0, monthlyData[10] || 0, monthlyData[11] || 0, monthlyData[12] || 0
                ];
                title = 'Doanh Thu Theo Tháng';
            } else if (currentTimeType === 'quarterly') {
                labels = ["Quý 1", "Quý 2", "Quý 3", "Quý 4"];
                data = [
                    quarterlyData[1] || 0, quarterlyData[2] || 0, 
                    quarterlyData[3] || 0, quarterlyData[4] || 0
                ];
                title = 'Doanh Thu Theo Quý';
            } else {
                labels = Object.keys(yearlyData);
                data = Object.values(yearlyData);
                title = 'Doanh Thu Theo Năm';
            }

            timeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: title,
                        data: data,
                        backgroundColor: 'rgba(78, 115, 223, 0.8)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value, index, values) {
                                    return new Intl.NumberFormat('vi-VN').format(value) + 'đ';
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return 'Doanh thu: ' + new Intl.NumberFormat('vi-VN').format(tooltipItem.yLabel) + 'đ';
                            }
                        }
                    }
                }
            });
        }

        // Khởi tạo biểu đồ thời gian
        updateTimeChart();

        // Biểu đồ khách hàng
        var customerChart = new Chart(document.getElementById("customerChart"), {
            type: 'doughnut',
            data: {
                labels: customerData.slice(0, 8).map(c => c.firstname + ' ' + c.lastname),
                datasets: [{
                    data: customerData.slice(0, 8).map(c => c.total_revenue),
                    backgroundColor: [
                        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                        '#e74a3b', '#5a5c69', '#858796', '#6f42c1'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return data.labels[tooltipItem.index] + ': ' + 
                                   new Intl.NumberFormat('vi-VN').format(data.datasets[0].data[tooltipItem.index]) + 'đ';
                        }
                    }
                }
            }
        });

        // Biểu đồ sản phẩm
        var productChart = new Chart(document.getElementById("productChart"), {
            type: 'bar',
            data: {
                labels: productData.slice(0, 8).map(p => p.productName.length > 20 ? 
                    p.productName.substring(0, 20) + '...' : p.productName),
                datasets: [{
                    label: 'Doanh Thu',
                    data: productData.slice(0, 8).map(p => p.total_revenue),
                    backgroundColor: 'rgba(54, 185, 204, 0.8)',
                    borderColor: 'rgba(54, 185, 204, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(value, index, values) {
                                return new Intl.NumberFormat('vi-VN').format(value) + 'đ';
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return 'Doanh thu: ' + new Intl.NumberFormat('vi-VN').format(tooltipItem.yLabel) + 'đ';
                        }
                    }
                }
            }
        });

        // Biểu đồ danh mục
        var categoryChart = new Chart(document.getElementById("categoryChart"), {
            type: 'pie',
            data: {
                labels: categoryData.map(c => c.categoryName),
                datasets: [{
                    data: categoryData.map(c => c.total_revenue),
                    backgroundColor: [
                        '#f6c23e', '#4e73df', '#1cc88a', '#36b9cc',
                        '#e74a3b', '#5a5c69', '#858796', '#6f42c1'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return data.labels[tooltipItem.index] + ': ' + 
                                   new Intl.NumberFormat('vi-VN').format(data.datasets[0].data[tooltipItem.index]) + 'đ';
                        }
                    }
                }
            }
        });

        // Biểu đồ phương thức thanh toán
        var paymentChart = new Chart(document.getElementById("paymentChart"), {
            type: 'doughnut',
            data: {
                labels: paymentData.map(p => p.method_name),
                datasets: [{
                    data: paymentData.map(p => p.total_revenue),
                    backgroundColor: [
                        '#e74a3b', '#1cc88a', '#4e73df', '#f6c23e'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return data.labels[tooltipItem.index] + ': ' + 
                                   new Intl.NumberFormat('vi-VN').format(data.datasets[0].data[tooltipItem.index]) + 'đ';
                        }
                    }
                }
            }
        });

    </script>

    <!-- Excel Export Modal -->
    <div class="modal fade" id="excelExportModal" tabindex="-1" role="dialog" aria-labelledby="excelExportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #1E5F74 0%, #2A7A8C 100%); color: white;">
                    <h5 class="modal-title" id="excelExportModalLabel">
                        <i class="fas fa-file-excel mr-2"></i>
                        Tùy Chọn Xuất Báo Cáo Excel
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="excelExportForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="excelStartDate" class="font-weight-bold">Từ Ngày:</label>
                                    <input type="date" class="form-control" id="excelStartDate" name="startDate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="excelEndDate" class="font-weight-bold">Đến Ngày:</label>
                                    <input type="date" class="form-control" id="excelEndDate" name="endDate">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Chọn Nội Dung Báo Cáo:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="excelIncludeStats" name="includeStats" value="true" checked>
                                        <label class="form-check-label" for="excelIncludeStats">
                                            Thống kê tổng quan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="excelIncludeCustomers" name="includeCustomers" value="true" checked>
                                        <label class="form-check-label" for="excelIncludeCustomers">
                                            Doanh thu theo khách hàng
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="excelIncludeProducts" name="includeProducts" value="true" checked>
                                        <label class="form-check-label" for="excelIncludeProducts">
                                            Doanh thu theo sản phẩm
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="excelIncludeCategories" name="includeCategories" value="true" checked>
                                        <label class="form-check-label" for="excelIncludeCategories">
                                            Doanh thu theo danh mục
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="excelIncludeShops" name="includeShops" value="true" checked>
                                        <label class="form-check-label" for="excelIncludeShops">
                                            Doanh thu theo cửa hàng
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="excelNotes" class="font-weight-bold">Ghi Chú Thêm:</label>
                            <textarea class="form-control" id="excelNotes" name="notes" rows="3" placeholder="Nhập ghi chú cho báo cáo (tùy chọn)"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Hủy
                    </button>
                    <button type="button" class="btn btn-success" onclick="exportExcel()">
                        <i class="fas fa-download mr-1"></i> Xuất Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set default dates
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const firstDay = new Date(today.getFullYear(), 0, 1);
            
            document.getElementById('excelStartDate').value = firstDay.toISOString().split('T')[0];
            document.getElementById('excelEndDate').value = today.toISOString().split('T')[0];
        });

        function exportExcel() {
            const form = document.getElementById('excelExportForm');
            const formData = new FormData(form);
            
            // Add report type
            formData.append('reportType', 'detailed');
            
            // Build URL with parameters
            const params = new URLSearchParams();
            for (let [key, value] of formData.entries()) {
                params.append(key, value);
            }
            
            // Create download URL
            const downloadUrl = '{{ route("download_report", "excel") }}?' + params.toString();
            
            // Open download in new window
            window.open(downloadUrl, '_blank');
            
            // Close modal
            $('#excelExportModal').modal('hide');
        }
    </script>
</body>

</html>
