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
    	/* Modern Shop Chat UI Styles */
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
        
        /* User List Styles */
        .user-list {
            background: white;
            border-radius: 15px;
            margin: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .user-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
        }

        .user-item:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }

        .user-item.active {
            background: #667eea;
            color: white;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .user-info h6 {
            margin: 0;
            font-weight: 600;
            font-size: 16px;
        }

        .user-info small {
            opacity: 0.7;
            font-size: 12px;
        }

        .unread-badge {
            background: linear-gradient(135deg, #ee4d2d 0%, #ff6b35 100%);
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
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
                <div class="chat-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 15px 15px 0 0; display: flex; align-items: center; gap: 15px;">
                    <div class="shop-avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 3px solid rgba(255,255,255,0.3); box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                        <i class="fas fa-store" style="font-size: 24px; color: white; display: flex; align-items: center; justify-content: center; height: 100%;"></i>
                    </div>
                    <div class="shop-info">
                        <h6 style="margin: 0; font-weight: 700; font-size: 18px;">Trung tâm tin nhắn Shop</h6>
                        <small style="opacity: 0.9; font-size: 12px;">Kết nối với khách hàng</small>
                    </div>
                    <div class="online-indicator" style="width: 12px; height: 12px; background: #34ce57; border-radius: 50%; border: 2px solid white; margin-left: auto; animation: pulse 2s infinite;"></div>
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
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    
    <!-- Chat Auto-refresh Script -->
    <script>
        $(document).ready(function() {
            // Auto-refresh messages every 2 seconds
            setInterval(function() {
                var currentUserId = $('.user-item.active').data('user-id');
                if (currentUserId) {
                    loadMessages(currentUserId);
                }
            }, 2000);
            
            // Function to load messages
            function loadMessages(userId) {
                $.ajax({
                    url: '/shop/chat/messages/' + userId,
                    type: 'GET',
                    success: function(response) {
                        if (response.messages) {
                            updateChatMessages(response.messages);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error loading messages:', xhr);
                    }
                });
            }
            
            // Function to update chat messages
            function updateChatMessages(messages) {
                var messagesContainer = $('.chat-messages');
                var currentMessageCount = messagesContainer.find('.chat-message-left, .chat-message-right').length;
                
                if (messages.length > currentMessageCount) {
                    messagesContainer.empty();
                    
                    messages.forEach(function(message) {
                        var messageHtml = createMessageHtml(message);
                        messagesContainer.append(messageHtml);
                    });
                    
                    // Scroll to bottom
                    messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
                }
            }
            
            // Function to create message HTML
            function createMessageHtml(message) {
                var isShop = message.sender == 1; // 1 = shop, 0 = user
                var messageClass = isShop ? 'chat-message-right' : 'chat-message-left';
                var time = new Date(message.created_at).toLocaleTimeString('vi-VN', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                return `
                    <div class="${messageClass}">
                        <div class="flex-shrink-0">
                            ${message.message}
                            <div class="message-time">${time}</div>
                        </div>
                    </div>
                `;
            }
            
            // Enhanced send message function
            function sendMessage(userId) {
                var message = $('input[name="message"]').val().trim();
                if (message === '') return;
                
                // Show typing indicator
                showTypingIndicator();
                
                $.ajax({
                    url: '/shop/chat/send',
                    type: 'POST',
                    data: {
                        user_id: userId,
                        message: message,
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        hideTypingIndicator();
                        $('input[name="message"]').val('');
                        
                        // Add message to chat immediately
                        var messageHtml = createMessageHtml({
                            message: message,
                            sender: 1,
                            created_at: new Date().toISOString()
                        });
                        $('.chat-messages').append(messageHtml);
                        
                        // Scroll to bottom
                        $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
                    },
                    error: function(xhr) {
                        hideTypingIndicator();
                        console.log('Error sending message:', xhr);
                    }
                });
            }
            
            // Typing indicator functions
            function showTypingIndicator() {
                var typingHtml = `
                    <div class="typing-indicator">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                `;
                $('.chat-messages').append(typingHtml);
                $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
            }
            
            function hideTypingIndicator() {
                $('.typing-indicator').remove();
            }
            
            // Enhanced send button click
            $('.send-button').on('click', function() {
                var userId = $('.user-item.active').data('user-id');
                if (userId) {
                    sendMessage(userId);
                }
            });
            
            // Enter key to send message
            $('input[name="message"]').on('keypress', function(e) {
                if (e.which === 13) {
                    var userId = $('.user-item.active').data('user-id');
                    if (userId) {
                        sendMessage(userId);
                    }
                }
            });
        });
        
        // Enhanced UI Interactions
        $(document).ready(function() {
            // Add hover effects to user items
            $('.user-item').hover(
                function() {
                    $(this).css('transform', 'translateX(5px)');
                    $(this).css('box-shadow', '0 6px 20px rgba(0,0,0,0.15)');
                    $(this).find('.user-info h6').css('color', '#667eea');
                },
                function() {
                    $(this).css('transform', 'translateX(0)');
                    $(this).css('box-shadow', '0 2px 8px rgba(0,0,0,0.05)');
                    $(this).find('.user-info h6').css('color', '#1a1a1a');
                }
            );
            
            // Add click animation to user items
            $('.user-item').on('click', function() {
                $(this).css('transform', 'scale(0.98)');
                setTimeout(() => {
                    $(this).css('transform', 'translateX(5px)');
                }, 150);
            });
            
            // Add loading animation
            $('.user-item').on('click', function() {
                var $this = $(this);
                $this.css('opacity', '0.7');
                $this.find('.user-info h6').html('<i class="fas fa-spinner fa-spin"></i> Đang kết nối...');
                $this.find('.online-indicator').css('background', '#ffc107');
                $this.find('.online-indicator').css('animation', 'pulse 1s infinite');
            });
            
            // Auto-scroll to bottom on page load
            setTimeout(function() {
                var chatContainer = document.getElementById('chat_message');
                if (chatContainer) {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            }, 100);
            
            // Ensure all users are visible on page load
            $('.user-item').show();
            $('.user-section-header').show();
        });
    </script>

</body>

</html>