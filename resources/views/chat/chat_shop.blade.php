<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chat với người dùng</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}"  rel="stylesheet">
    <style type="text/css">
    	/* body{margin-top:20px;} */
        .content{
            margin-bottom: 100px;
            /* padding-bottom:40px; */
        }
        .chat-online {
            color: #34ce57
        }

        .chat-offline {
            color: #e4606d
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            max-height: 800px;
            min-height: 450px;
            overflow-y: scroll
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0
        }

        .chat-message-left {
            margin-right: auto
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto
        }
        .py-3 {
            padding-top: 1rem!important;
            padding-bottom: 1rem!important;
        }
        .px-4 {
            padding-right: 1.5rem!important;
            padding-left: 1.5rem!important;
        }
        .flex-grow-0 {
            flex-grow: 0!important;
        }
        .border-top {
            border-top: 1px solid #dee2e6!important;
        }
        .form_send{
        
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
                <div class="container p-0">

                <!-- <h1 class="h3 mb-3">Nhắn tin với các cửa hàng</h1> -->

                    <div class="card">
                        <div class="row g-0">
                            <div class="col-12 col-lg-5 col-xl-3 border-right">

                                <div class="px-4 d-none d-md-block">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control my-3" placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                                @if($user_list_unread)
                                @foreach($user_list_unread as $user)
                                <a href="{{route('show_chat_shop',$user->id)}}" class="list-group-item list-group-item-action border-0">
                                    @if($user->unread > 0)
                                    <div class="badge bg-success float-right">{{$user->unread }}</div>
                                    @endif
                                    <div class="d-flex align-items-start">
                                        @if($user->userImg == null)
                                            <img src="{{asset('storage/users_img/user.png')}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                        @else
                                        <img src="{{asset('storage/'.$user->userImg)}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                        @endif
                                        <div class="flex-grow-1 ml-3">
                                            {{$user->firstname}} {{$user->lastname}}
                                            <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @endif
                                @if($user_list)
                                @foreach($user_list as $user)
                                <a href="{{route('show_chat_shop',$user->id)}}" class="list-group-item list-group-item-action border-0">
                                    <div class="badge bg-success float-right"></div>
                               
                                    <div class="d-flex align-items-start">
                                        @if($user->userImg == null)
                                            <img src="{{asset('storage/users_img/user.png')}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                        @else
                                        <img src="{{asset('storage/'.$user->userImg)}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                        @endif
                                        <div class="flex-grow-1 ml-3">
                                            {{$user->firstname}} {{$user->lastname}}
                                            <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @endif
                                <!-- <a href="#" class="list-group-item list-group-item-action border-0">
                                    <div class="d-flex align-items-start">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar4.png" class="rounded-circle mr-1" alt="Christina Mason" width="40" height="40">
                                        <div class="flex-grow-1 ml-3">
                                            Christina Mason
                                            <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
                                        </div>
                                    </div>
                                </a> -->
                            
                            

                                <hr class="d-block d-lg-none mt-1 mb-0">
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
                        <span>Copyright &copy; Your Website 2021</span>
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
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>