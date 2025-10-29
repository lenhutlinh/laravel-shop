<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản trị viên</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}"  rel="stylesheet">
    
    <!-- Custom Dashboard Styles -->
    <style>
        /* Page Header Styles */
        .page-header-content {
            color: #2c3e50;
        }
        
        .page-title {
            color: #2c3e50 !important;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(78, 115, 223, 0.4);
        }
        
        /* Stats Cards Styles */
        .stats-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 120px;
            padding: 1.5rem;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .stats-card .card-body {
            padding: 1.5rem;
            background: transparent;
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
        
        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.2);
            margin-left: auto;
            flex-shrink: 0;
        }
        
        .stats-card:hover .icon-circle {
            transform: scale(1.1);
        }
        
        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }
        
        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }
        
        .border-left-info {
            border-left: 4px solid #36b9cc !important;
        }
        
        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }
        
        /* Text color improvements for better contrast */
        .text-primary {
            color: #4e73df !important;
        }
        
        .text-success {
            color: #1cc88a !important;
        }
        
        .text-info {
            color: #36b9cc !important;
        }
        
        .text-warning {
            color: #f6c23e !important;
        }
        
        /* Chart Card Styles */
        .chart-card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            background: #ffffff;
        }
        
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
        }
        
        .chart-card .card-body {
            background: #ffffff;
        }
        
        .chart-area {
            position: relative;
            height: 400px;
            padding: 1rem;
            background: #ffffff;
        }
        
        #myAreaChart {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
        }
        
        /* Animation Effects */
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
        
        .stats-card {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        .stats-card:nth-child(1) { animation-delay: 0.1s; }
        .stats-card:nth-child(2) { animation-delay: 0.2s; }
        .stats-card:nth-child(3) { animation-delay: 0.3s; }
        .stats-card:nth-child(4) { animation-delay: 0.4s; }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .page-header-content {
                text-align: center;
                margin-bottom: 1rem;
            }
            
            .stats-card {
                margin-bottom: 1rem;
            }
            
            .icon-circle {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #3d5bb8 0%, #1e3a8a 100%);
        }
        
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
        
        .notification-dropdown {
            border-radius: 15px;
            border: none;
            min-width: 350px;
        }
        
        .notification-item {
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 8px;
        }
        
        .notification-item:hover {
            background: linear-gradient(135deg, #f8f9fc 0%, #e3e6f0 100%);
            transform: translateX(5px);
        }
        
        .notification-footer {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white !important;
            border-radius: 8px;
            margin: 8px;
            transition: all 0.3s ease;
        }
        
        .notification-footer:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .user-dropdown {
            transition: all 0.3s ease;
        }
        
        .user-dropdown:hover {
            transform: scale(1.05);
        }
        
        .user-avatar {
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }
        
        .user-dropdown:hover .user-avatar {
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.2);
        }
        
        .user-dropdown-menu {
            border-radius: 15px;
            border: none;
            min-width: 280px;
        }
        
        .user-menu-item {
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 8px;
        }
        
        .user-menu-item:hover {
            background: linear-gradient(135deg, #f8f9fc 0%, #e3e6f0 100%);
            transform: translateX(5px);
        }
        
        .user-menu-item.text-danger:hover {
            background: linear-gradient(135deg, #fee 0%, #fdd 100%);
            color: #dc3545 !important;
        }
        
        /* Sidebar Enhancement Styles */
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
            box-shadow: 0 3px 10px rgba(78, 115, 223, 0.3);
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
        
        /* Dark theme for dropdown content - không can thiệp vào behavior */
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
        
        
        #sidebarToggle {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
            color: #ffffff !important;
            border: none !important;
            transition: all 0.3s ease;
        }
        
        #sidebarToggle:hover {
            transform: scale(1.1);
            box-shadow: 0 3px 10px rgba(78, 115, 223, 0.3);
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="page-header-content">
                            <h1 class="h3 mb-0 text-gray-800 page-title">
                                <i class="fas fa-tachometer-alt text-primary mr-2"></i>
                                Trang Quản Trị Hệ Thống
                            </h1>
                            <p class="text-muted mb-0">Tổng quan về hoạt động của hệ thống</p>
                        </div>
                        <a href="{{ route('generate_report') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm btn-gradient">
                            <i class="fas fa-download fa-sm text-white-50"></i> 
                            Generate Report
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Total Orders Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stats-card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tổng Đơn Hàng
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_order}}</div>
                                            <div class="text-xs text-success">
                                                <i class="fas fa-arrow-up"></i> 12% so với tháng trước
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-shopping-cart text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Revenue Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stats-card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Tổng Hoa Hồng Sàn
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($total_money, 0, ',', '.')}}đ</div>
                                            <div class="text-xs text-success">
                                                <i class="fas fa-arrow-up"></i> 8% so với tháng trước
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-dollar-sign text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Shops Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stats-card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Số Cửa Hàng
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_shop}}</div>
                                            <div class="text-xs text-info">
                                                <i class="fas fa-arrow-up"></i> 5% so với tháng trước
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon-circle bg-info">
                                                <i class="fas fa-store text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Users Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stats-card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Số Người Dùng
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_user}}</div>
                                            <div class="text-xs text-warning">
                                                <i class="fas fa-arrow-up"></i> 15% so với tháng trước
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-users text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Revenue Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4 chart-card">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-gradient-primary text-white">
                                    <h6 class="m-0 font-weight-bold">
                                        <i class="fas fa-chart-line mr-2"></i>
                                        Biểu Đồ Doanh Số Theo Tháng
                                    </h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Tùy chọn:</div>
                                            <a class="dropdown-item" href="{{ route('generate_report') }}"><i class="fas fa-download mr-2"></i>Generate Report</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-print mr-2"></i>In biểu đồ</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Cài đặt</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script> -->
    <script src="js/demo/chart-pie-demo.js"></script>
    <script>
                // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
        }

        // Area Chart Example
        var month_1 = <?php echo $earning_month_1; ?>;
        var month_2 = <?php echo $earning_month_2; ?>;
        var month_3 = <?php echo $earning_month_3; ?>;
        var month_4 = <?php echo $earning_month_4; ?>;
        var month_5 = <?php echo $earning_month_5; ?>;
        var month_6 = <?php echo $earning_month_6; ?>;
        var month_7 = <?php echo $earning_month_7; ?>;
        var month_8 = <?php echo $earning_month_8; ?>;
        var month_9 = <?php echo $earning_month_9; ?>;
        var month_10 = <?php echo $earning_month_10; ?>;
        var month_11 = <?php echo $earning_month_11; ?>;
        var month_12 = <?php echo $earning_month_12; ?>;
        console.log(month_12);
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
            datasets: [{
            label: "Doanh Thu",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [month_1, month_2, month_3, month_4, month_5, month_6, month_7, month_8, month_9, month_10, month_11, month_12],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false,
                drawBorder: false
                },
                ticks: {
                maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                    return  number_format(value) + 'đ';
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ':' + number_format(tooltipItem.yLabel) + 'đ';
                }
            }
            }
        }
        });

    </script>

    <!-- Generate Report JavaScript -->
    <script>
        $(document).ready(function() {
            // Xử lý click nút Generate Report
            $('.btn-gradient').on('click', function(e) {
                // Thêm hiệu ứng loading
                $(this).html('<i class="fas fa-spinner fa-spin fa-sm text-white-50"></i> Đang tạo báo cáo...');
                $(this).prop('disabled', true);
                
                // Sau 1 giây, chuyển hướng
                setTimeout(function() {
                    window.location.href = "{{ route('generate_report') }}";
                }, 1000);
            });

            // Xử lý click dropdown Generate Report
            $('.dropdown-item[href="{{ route('generate_report') }}"]').on('click', function(e) {
                e.preventDefault();
                
                // Thêm hiệu ứng loading cho dropdown
                $(this).html('<i class="fas fa-spinner fa-spin mr-2"></i>Đang tạo báo cáo...');
                
                // Sau 1 giây, chuyển hướng
                setTimeout(function() {
                    window.location.href = "{{ route('generate_report') }}";
                }, 1000);
            });

            // Thêm tooltip cho các nút
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>