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
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}"  rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <!-- Custom styles for this page -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">
    
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <link href="{{asset('css/sb-admin-2.min.css')}}"  rel="stylesheet">
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}"  rel="stylesheet">
    <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
    <style type="text/css">
    	/* Modern Chat Show Shop UI Styles */
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .content {
            margin-bottom: 100px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin: 20px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }
        
        .chat-online {
            color: #34ce57;
            animation: pulse 2s infinite;
        }

        .chat-offline {
            color: #e4606d;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            max-height: 600px;
            min-height: 500px;
            overflow-y: auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            margin: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid #e9ecef;
        }
        
        /* Custom Scrollbar */
        .chat-messages::-webkit-scrollbar {
            width: 8px;
        }

        .chat-messages::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0;
            margin-bottom: 15px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chat-message-left {
            margin-right: auto;
            justify-content: flex-start;
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto;
            justify-content: flex-end;
        }

        /* Message Bubble Styles */
        .chat-message-left .flex-shrink-0 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px 20px 20px 5px;
            padding: 12px 18px;
            max-width: 70%;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            position: relative;
        }

        .chat-message-right .flex-shrink-0 {
            background: linear-gradient(135deg, #ee4d2d 0%, #ff6b35 100%);
            color: white;
            border-radius: 20px 20px 5px 20px;
            padding: 12px 18px;
            max-width: 70%;
            box-shadow: 0 4px 15px rgba(238, 77, 45, 0.3);
            position: relative;
        }

        /* Message Time */
        .message-time {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 5px;
            text-align: right;
        }

        /* Typing Indicator */
        .typing-indicator {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            background: #f8f9fa;
            border-radius: 20px;
            margin: 10px 0;
            max-width: 80px;
        }

        .typing-indicator span {
            height: 8px;
            width: 8px;
            background: #999;
            border-radius: 50%;
            display: inline-block;
            margin: 0 2px;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-indicator span:nth-child(1) { animation-delay: -0.32s; }
        .typing-indicator span:nth-child(2) { animation-delay: -0.16s; }

        @keyframes typing {
            0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
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
        /* Input Area Styles */
        .form_send {
            background: white;
            border-radius: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 15px 20px;
            margin: 15px;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form_send:focus-within {
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
        }

        .form_send input {
            border: none;
            outline: none;
            background: transparent;
            flex: 1;
            padding: 10px 15px;
            font-size: 16px;
            color: #333;
        }

        .form_send input::placeholder {
            color: #999;
            font-style: italic;
        }

        .send-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .send-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .send-button:active {
            transform: scale(0.95);
        }

        /* Chat Header Styles */
        .chat-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 15px 15px 0 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,0.3);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .user-info h6 {
            margin: 0;
            font-weight: 700;
            font-size: 18px;
        }

        .user-info small {
            opacity: 0.9;
            font-size: 12px;
        }

        .online-indicator {
            width: 12px;
            height: 12px;
            background: #34ce57;
            border-radius: 50%;
            border: 2px solid white;
            margin-left: auto;
            animation: pulse 2s infinite;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .content {
                margin: 10px;
                border-radius: 15px;
            }
            
            .chat-messages {
                max-height: 400px;
                min-height: 300px;
                padding: 15px;
            }
            
            .form_send {
                margin: 10px;
                padding: 10px 15px;
            }
            
            .send-button {
                width: 40px;
                height: 40px;
            }
            
            .chat-header {
                padding: 15px;
            }
            
            .user-avatar {
                width: 40px;
                height: 40px;
            }
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
                    <!-- Modern Chat Header -->
                    <div class="chat-header">
                        <div class="user-avatar">
                            @if($user_chat->userImg == null)
                                <img src="{{asset('storage/users_img/user.png')}}" alt="{{$user_chat->firstname}} {{$user_chat->lastname}}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            @else
                                <img src="{{asset('storage/'.$user_chat->userImg)}}" alt="{{$user_chat->firstname}} {{$user_chat->lastname}}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            @endif
                        </div>
                        <div class="user-info">
                            <h6>{{$user_chat->firstname}} {{$user_chat->lastname}}</h6>
                            <small><span class="fas fa-circle chat-online"></span> Online</small>
                        </div>
                        <div class="online-indicator"></div>
                    </div>

                    <div class="card" style="border: 1px solid #e9ecef; border-radius: 0 0 20px 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); background: white;">
                        <div class="row g-0">
                            <div class="col-12 col-lg-5 col-xl-3 border-right" style="background: white; border-right: 1px solid #e9ecef;">

                                <!-- Enhanced Search Bar -->
                                <div class="px-4 d-none d-md-block" style="padding: 20px;">
                                    <div class="search-container" style="position: relative;">
                                        <div class="search-icon" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #999; z-index: 10;">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Tìm kiếm khách hàng..." 
                                               style="padding-left: 45px; border-radius: 25px; border: 2px solid #e9ecef; 
                                                      background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                                                      transition: all 0.3s ease;" 
                                               onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 4px 15px rgba(102, 126, 234, 0.2)'"
                                               onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.05)'">
                                    </div>
                                </div>
                                <!-- User List with Unread Messages -->
                                <div class="user-list-container" style="padding: 0 20px 20px 20px;">
                                    @if($user_list_unread)
                                    <div class="user-section-header" style="padding: 15px 0 10px 0; border-bottom: 2px solid #e9ecef; margin-bottom: 15px;">
                                        <h6 style="color: #ee4d2d; font-weight: 700; margin: 0; font-size: 16px;">
                                            <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                                            Tin nhắn chưa đọc
                                        </h6>
                                        <small style="color: #999; font-size: 12px;">Có {{count($user_list_unread)}} khách hàng có tin nhắn mới</small>
                                    </div>
                                    @foreach($user_list_unread as $user)
                                    <a href="{{route('show_chat_shop',$user->id)}}" class="user-item" 
                                       style="display: block; padding: 15px; margin-bottom: 10px; background: white; 
                                              border-radius: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); 
                                              text-decoration: none; color: inherit; transition: all 0.3s ease;
                                              border-left: 4px solid #ee4d2d; border: 1px solid #e9ecef;"
                                       onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 6px 20px rgba(0,0,0,0.15)'"
                                       onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'">
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar" style="position: relative;">
                                                @if($user->userImg == null)
                                                    <img src="{{asset('storage/users_img/user.png')}}" 
                                                         style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; 
                                                                border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                                @else
                                                    <img src="{{asset('storage/'.$user->userImg)}}" 
                                                         style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; 
                                                                border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                                @endif
                                                <div class="online-indicator" style="position: absolute; bottom: 2px; right: 2px; 
                                                                                  width: 12px; height: 12px; background: #34ce57; 
                                                                                  border-radius: 50%; border: 2px solid white;"></div>
                                            </div>
                                            <div class="user-info" style="flex: 1; margin-left: 15px;">
                                                <h6 style="margin: 0; font-weight: 700; color: #1a1a1a; font-size: 16px;">
                                                    {{$user->firstname}} {{$user->lastname}}
                                                </h6>
                                                <div style="display: flex; align-items: center; margin-top: 5px;">
                                                    <span class="fas fa-circle chat-online" style="font-size: 8px; margin-right: 5px;"></span>
                                                    <span style="font-size: 12px; color: #34ce57; font-weight: 600;">Online</span>
                                                </div>
                                            </div>
                                            @if($user->unread > 0)
                                            <div class="unread-badge" style="background: linear-gradient(135deg, #ee4d2d 0%, #ff6b35 100%); 
                                                                           color: white; border-radius: 50%; width: 25px; height: 25px; 
                                                                           display: flex; align-items: center; justify-content: center; 
                                                                           font-size: 12px; font-weight: bold; animation: pulse 2s infinite;">
                                                {{$user->unread}}
                                            </div>
                                            @endif
                                        </div>
                                    </a>
                                    @endforeach
                                    @endif
                                    
                                    @if($user_list)
                                    <div class="user-section-header" style="padding: 15px 0 10px 0; border-bottom: 2px solid #e9ecef; margin-bottom: 15px;">
                                        <h6 style="color: #667eea; font-weight: 700; margin: 0; font-size: 16px;">
                                            <i class="fas fa-users" style="margin-right: 8px;"></i>
                                            Tất cả khách hàng
                                        </h6>
                                        <small style="color: #999; font-size: 12px;">Chọn khách hàng để bắt đầu trò chuyện</small>
                                    </div>
                                    @foreach($user_list as $user)
                                    <a href="{{route('show_chat_shop',$user->id)}}" class="user-item" 
                                       style="display: block; padding: 15px; margin-bottom: 10px; background: white; 
                                              border-radius: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); 
                                              text-decoration: none; color: inherit; transition: all 0.3s ease;
                                              border-left: 4px solid #667eea; border: 1px solid #e9ecef;"
                                       onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 6px 20px rgba(0,0,0,0.15)'"
                                       onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'">
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar" style="position: relative;">
                                                @if($user->userImg == null)
                                                    <img src="{{asset('storage/users_img/user.png')}}" 
                                                         style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; 
                                                                border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                                @else
                                                    <img src="{{asset('storage/'.$user->userImg)}}" 
                                                         style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; 
                                                                border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                                @endif
                                                <div class="online-indicator" style="position: absolute; bottom: 2px; right: 2px; 
                                                                                  width: 12px; height: 12px; background: #34ce57; 
                                                                                  border-radius: 50%; border: 2px solid white;"></div>
                                            </div>
                                            <div class="user-info" style="flex: 1; margin-left: 15px;">
                                                <h6 style="margin: 0; font-weight: 700; color: #1a1a1a; font-size: 16px;">
                                                    {{$user->firstname}} {{$user->lastname}}
                                                </h6>
                                                <div style="display: flex; align-items: center; margin-top: 5px;">
                                                    <span class="fas fa-circle chat-online" style="font-size: 8px; margin-right: 5px;"></span>
                                                    <span style="font-size: 12px; color: #34ce57; font-weight: 600;">Online</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    @endif
                                </div>
                                
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
                                <div class="col-12 col-lg-7 col-xl-9">
                                <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                    <div class="d-flex align-items-center py-1">
                                        <div class="position-relative">
                                            @if($user_chat->userImg == null)
                                            <img src="{{asset('storage/users_img/user.png')}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            @else
                                            <img src="{{asset('storage/'.$user_chat->userImg)}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 pl-3">
                                            <strong>{{$user_chat->firstname}} {{$user_chat->lastname}} </strong>
                                            <div class="text-muted small"><em>...</em></div>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone feather-lg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></button>
                                            <button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video feather-lg"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></button>
                                            <button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative">
                                    <div class="chat-messages p-4" id="chat_message">
                                        @foreach($messages as $message)

                                        @if($message->sender == 1)
                                        <div class="chat-message-right pb-4">
                                            <div>
                                                <img src="{{asset('storage/'.$shop_img)}}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                                <div class="text-muted small text-nowrap mt-2">{{date('H:i  ', strtotime($message->created_at))}} </div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                <div class="font-weight-bold mb-1">You</div>
                                                {{$message->message}}
                                            </div>
                                        </div>
                                        
                                        @else
                                        <div class="chat-message-left pb-4">
                                            <div>
                                                @if($user_chat->userImg != null)
                                                <img src="{{asset('storage/'.$user_chat->userImg)}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                                @else
                                                <img src="{{asset('storage/users_img/user.png')}}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                                @endif
                                                <div class="text-muted small text-nowrap mt-2">{{date('H:i  ', strtotime($message->created_at))}}</div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                <div class="font-weight-bold mb-1">{{$user_chat->firstname}} {{$user_chat->lastname}}</div>
                                                {{$message->message}}
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        

                                    </div>
                                </div>

                                <div class="flex-grow-0 py-3 px-4 border-top">
                                    <form class="form_send" id="form_send">      
                                    @csrf          
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Nhập tin nhắn" name="message" id="input_send">
                                        <span class="btn btn-primary"  id="button_send" >Gửi</span>
                                        <input type="hidden" class="shop_id" name="shop_id" value="{{$shop_id}}" data-shop_id="{{$shop_id}}">
                                        <input type="hidden" class="user_id" name="user_id" value="{{$user_chat->id}}" data-shop_id="{{$user_chat->id}}">

                                    </div>
                                    </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- include jQuery validate library -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <!-- include Ajax  library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- include jQuery validate library -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
    $("#form_send").validate({
        rules: {
            "message": {
                required: true,
            },
        },
        messages: {
            "message": {
                required: null,
            },
        },
        submitHandler: function(form) {
            $(form).submit();
        }
    
    });
    </script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
    
        Pusher.logToConsole = true;

        var shop_id = {{Session::get('shop_id')}};
        var user_img = '{{$user_chat->userImg}}';
        console.log(user_img);
        var pusher = new Pusher('ff8fd5829eb915c745b0', {
            cluster: 'ap1',
            encryted: true,
            forceTLS: true,
            authEndpoint: 'http://localhost:8000/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
            },
            
        });
        var channel = pusher.subscribe('sendMessageToShop.'+shop_id);
        console.log(channel);
        channel.bind('pusher:subscription_succeeded', function(members) {
            // alert('successfully subscribed!');
        });
            
        channel.bind('send-message',function(data){
            if (data.sender == 1) {
                var container = document.getElementById('chat_message') ;
                var newMessage = document.createElement('div');
                newMessage.className = 'chat-message-right pb-4';
                var messageHTML = '<div><img src="' + ('{{asset('storage/'.$shop_img)}}') + '" class="rounded-circle mr-1"  width="40" height="40">';
                messageHTML += '<div class="text-muted small text-nowrap mt-2">' + data.created_at + '</div></div>';
                messageHTML += '<div class="flex-shrink-1 bg-light rounded py-2 px-3 ' + ('mr-3') + '"><div class="font-weight-bold mb-1">' + ('You') + '</div>' + data.message + '</div>';
                newMessage.innerHTML = messageHTML;
                container.appendChild(newMessage);
                container.scrollTop = container.scrollHeight;
                
            }
            if (data.sender ==2) {
                var container = document.getElementById('chat_message') ;
                var newMessage = document.createElement('div');
                newMessage.className = 'chat-message-left pb-4';
                if (user_img != '') {
                    var messageHTML = '<div><img src="' + ('{{asset('storage/'.$user_chat->userImg)}}') + '" class="rounded-circle mr-1"  width="40" height="40">';

                }else{
                    var messageHTML = '<div><img src="' + ('{{asset('storage/users_img/user.png')}}') + '" class="rounded-circle mr-1"  width="40" height="40">';
                }
                messageHTML += '<div class="text-muted small text-nowrap mt-2">' + data.created_at + '</div></div>';
                messageHTML += '<div class="flex-shrink-1 bg-light rounded py-2 px-3 ' + ('mr-3') + '"><div class="font-weight-bold mb-1">' +('{{$user_chat->lastname}}')+ '</div>' + data.message + '</div>';
                newMessage.innerHTML = messageHTML;
                container.appendChild(newMessage);
                container.scrollTop = container.scrollHeight;

            }
        });
    </script>
                    
        
<script>
    $(document).ready(function(){
        $('#button_send').click(function(){
            var message = $('input[name="message"]').val(); 
            var shop_id = $('input[name="shop_id"]').val();
            var user_id = $('input[name="user_id"]').val();
            var _token = $('input[name="_token"]').val();
            console.log(message);

            $.ajax({
                    url: '{{route('send_messages_shop')}}',
                    method: 'POST',
                    data:{
                        shop_id: shop_id,
                        user_id: user_id,
                        message: message,
                        _token: _token,
                    },error:function(data) {
                        console.log(data);
                    },
                    success: function(data){
                        $status = data.status;
                        if($status == true){
                            $('input[name="message"]').val('');
                        }
                        else{
                            $('input[name="message"]').val('');
                        }
                    }
                });
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#input_send').keypress(function(event) {
            if (event.keyCode === 13) { // Kiểm tra nếu phím nhấn là Enter
                event.preventDefault(); // Ngăn chặn hành động mặc định của Enter (làm mới trang)
                // Thêm mã xử lý khác nếu cần
            }
        });
    });
</script>
</body>

</html>