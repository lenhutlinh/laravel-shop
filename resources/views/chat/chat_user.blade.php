<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/fontawesome.min.css "/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/brands.min.css "/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/solid.min.css "/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/regular.min.css "/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chating</title>
    <style type="text/css">
    	/* Modern Chat UI Styles */
body {
    background: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

.content {
    margin-bottom: 300px;
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

/* Shop List Styles */
.shop-list {
    background: white;
    border-radius: 15px;
    margin: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    overflow: hidden;
}

.shop-item {
    padding: 15px 20px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 15px;
    background: white;
}

.shop-item:hover {
    background: #f8f9fa;
    transform: translateX(5px);
}

.shop-item.active {
    background: #667eea;
    color: white;
}

.shop-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.shop-info h6 {
    margin: 0;
    font-weight: 600;
    font-size: 16px;
}

.shop-info small {
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
<body>
    
    <header>
        @include('header')
        
    </header>
    <main class="content">
        <div class="container p-0">
            <!-- Modern Chat Header -->
            <div class="chat-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; border-radius: 20px 20px 0 0; color: white; text-align: center;">
                <h1 class="h3 mb-0" style="font-weight: 700; font-size: 28px;">
                    <i class="fas fa-comments" style="margin-right: 10px;"></i>
                    Trung tâm tin nhắn
                </h1>
                <p class="mb-0" style="opacity: 0.9; font-size: 14px;">Kết nối với các cửa hàng yêu thích</p>
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
                                <input type="text" class="form-control" placeholder="Tìm kiếm cửa hàng..." 
                                       style="padding-left: 45px; border-radius: 25px; border: 2px solid #e9ecef; 
                                              background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                                              transition: all 0.3s ease;" 
                                       onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 4px 15px rgba(102, 126, 234, 0.2)'"
                                       onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.05)'">
                            </div>
                        </div>
                        <!-- Shop List with Unread Messages -->
                        <div class="shop-list-container" style="padding: 0 20px 20px 20px;">
                            @if($shop_list_unread)
                            <div class="shop-section-header" style="padding: 15px 0 10px 0; border-bottom: 2px solid #e9ecef; margin-bottom: 15px;">
                                <h6 style="color: #ee4d2d; font-weight: 700; margin: 0; font-size: 14px;">
                                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                                    Tin nhắn chưa đọc
                                </h6>
                            </div>
                            @foreach($shop_list_unread as $shop)
                            <a href="{{route('show_chat',$shop->id)}}" class="shop-item" 
                               style="display: block; padding: 15px; margin-bottom: 10px; background: white; 
                                      border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); 
                                      text-decoration: none; color: inherit; transition: all 0.3s ease;
                                      border-left: 4px solid #ee4d2d;"
                               onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 6px 20px rgba(0,0,0,0.15)'"
                               onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.08)'">
                                <div class="d-flex align-items-center">
                                    <div class="shop-avatar" style="position: relative;">
                                        <img src="{{asset('storage/'.$shop->shopImg)}}" 
                                             style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; 
                                                    border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                        <div class="online-indicator" style="position: absolute; bottom: 2px; right: 2px; 
                                                                          width: 12px; height: 12px; background: #34ce57; 
                                                                          border-radius: 50%; border: 2px solid white;"></div>
                                    </div>
                                    <div class="shop-info" style="flex: 1; margin-left: 15px;">
                                        <h6 style="margin: 0; font-weight: 700; color: #1a1a1a; font-size: 16px;">
                                            {{$shop->shopname}}
                                        </h6>
                                        <div style="display: flex; align-items: center; margin-top: 5px;">
                                            <span class="fas fa-circle chat-online" style="font-size: 8px; margin-right: 5px;"></span>
                                            <span style="font-size: 12px; color: #34ce57; font-weight: 600;">Online</span>
                                        </div>
                                    </div>
                                    @if($shop->unread > 0)
                                    <div class="unread-badge" style="background: linear-gradient(135deg, #ee4d2d 0%, #ff6b35 100%); 
                                                                   color: white; border-radius: 50%; width: 25px; height: 25px; 
                                                                   display: flex; align-items: center; justify-content: center; 
                                                                   font-size: 12px; font-weight: bold; animation: pulse 2s infinite;">
                                        {{$shop->unread}}
                                    </div>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                            @endif
                            
                            @if($shop_list)
                            <div class="shop-section-header" style="padding: 15px 0 10px 0; border-bottom: 2px solid #e9ecef; margin-bottom: 15px;">
                                <h6 style="color: #667eea; font-weight: 700; margin: 0; font-size: 14px;">
                                    <i class="fas fa-store" style="margin-right: 8px;"></i>
                                    Tất cả cửa hàng
                                </h6>
                            </div>
                            @foreach($shop_list as $shop)
                            <a href="{{route('show_chat',$shop->id)}}" class="shop-item" 
                               style="display: block; padding: 15px; margin-bottom: 10px; background: white; 
                                      border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); 
                                      text-decoration: none; color: inherit; transition: all 0.3s ease;
                                      border-left: 4px solid #667eea;"
                               onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 6px 20px rgba(0,0,0,0.15)'"
                               onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.08)'">
                                <div class="d-flex align-items-center">
                                    <div class="shop-avatar" style="position: relative;">
                                        <img src="{{asset('storage/'.$shop->shopImg)}}" 
                                             style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; 
                                                    border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                        <div class="online-indicator" style="position: absolute; bottom: 2px; right: 2px; 
                                                                          width: 12px; height: 12px; background: #34ce57; 
                                                                          border-radius: 50%; border: 2px solid white;"></div>
                                    </div>
                                    <div class="shop-info" style="flex: 1; margin-left: 15px;">
                                        <h6 style="margin: 0; font-weight: 700; color: #1a1a1a; font-size: 16px;">
                                            {{$shop->shopname}}
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
                            
                            @if(!$shop_list_unread && !$shop_list)
                            <div class="no-shops-message" style="text-align: center; padding: 40px 20px; color: #999;">
                                <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">
                                    <i class="fas fa-store-slash"></i>
                                </div>
                                <div style="font-size: 16px; margin-bottom: 8px; font-weight: 600;">Chưa có cửa hàng nào</div>
                                <div style="font-size: 14px;">Hãy mua sắm để bắt đầu trò chuyện!</div>
                            </div>
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
                    
                    <!-- Chat Area -->
                    <div class="col-12 col-lg-7 col-xl-9" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); display: flex; flex-direction: column; min-height: 600px;">
                        <div class="chat-welcome" style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px; text-align: center;">
                            <div class="welcome-icon" style="font-size: 80px; margin-bottom: 20px; opacity: 0.6;">
                                <i class="fas fa-comments" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                                                  -webkit-background-clip: text; 
                                                                  -webkit-text-fill-color: transparent; 
                                                                  background-clip: text;"></i>
                            </div>
                            <h3 style="color: #1a1a1a; font-weight: 700; margin-bottom: 10px; font-size: 24px;">
                                Chào mừng đến với trung tâm tin nhắn!
                            </h3>
                            <p style="color: #666; font-size: 16px; margin-bottom: 30px; max-width: 400px; line-height: 1.6;">
                                Chọn một cửa hàng từ danh sách bên trái để bắt đầu trò chuyện và nhận hỗ trợ tư vấn mua sắm.
                            </p>
                            <div class="welcome-features" style="display: flex; gap: 30px; flex-wrap: wrap; justify-content: center;">
                                <div class="feature-item" style="text-align: center; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); min-width: 150px;">
                                    <div style="font-size: 32px; margin-bottom: 10px; color: #667eea;">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <h6 style="margin: 0; font-weight: 600; color: #1a1a1a;">Hỗ trợ 24/7</h6>
                                    <small style="color: #666;">Luôn sẵn sàng giúp đỡ</small>
                                </div>
                                <div class="feature-item" style="text-align: center; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); min-width: 150px;">
                                    <div style="font-size: 32px; margin-bottom: 10px; color: #ee4d2d;">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <h6 style="margin: 0; font-weight: 600; color: #1a1a1a;">Tư vấn mua sắm</h6>
                                    <small style="color: #666;">Gợi ý sản phẩm phù hợp</small>
                                </div>
                                <div class="feature-item" style="text-align: center; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); min-width: 150px;">
                                    <div style="font-size: 32px; margin-bottom: 10px; color: #34ce57;">
                                        <i class="fas fa-bolt"></i>
                                    </div>
                                    <h6 style="margin: 0; font-weight: 600; color: #1a1a1a;">Phản hồi nhanh</h6>
                                    <small style="color: #666;">Trả lời tức thì</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('footer')
    <!-- include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- include jQuery validate library -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <!-- include Ajax  library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        var user_id = {{Session::get('user_id')}};
        // console.log(user_id);
        var pusher = new Pusher('ff8fd5829eb915c745b0', {
            cluster: 'ap1',
            encryted: true,
            forceTLS: true,
            // authEndpoint: 'http://localhost:8000/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
            },
            
        });
        var channel = pusher.subscribe('sendMessageToUser.'+user_id);
        console.log(channel);
        channel.bind('pusher:subscription_succeeded', function(members) {
            // alert('successfully subscribed!');
        });
            
        channel.bind('send-message-user',function(data){
            console.log(data);
            alert('ok');
        });
    </script>
                    
        
<script>
    $(document).ready(function(){
        $('#button_send').click(function(){
            var message = $('input[name="message"]').val(); 
            var shop_id = $('input[name="shop_id"]').val();
            var user_id = $('input[name="user_id"]').val();
            var _token = $('input[name="_token"]').val();
            // console.log(user_id);

            $.ajax({
                    url: '{{route('send_messages_user')}}',
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
    
    // Enhanced UI Interactions
    $(document).ready(function() {
        // Add hover effects to shop items
        $('.shop-item').hover(
            function() {
                $(this).css('transform', 'translateX(5px)');
                $(this).css('box-shadow', '0 6px 20px rgba(0,0,0,0.15)');
            },
            function() {
                $(this).css('transform', 'translateX(0)');
                $(this).css('box-shadow', '0 4px 15px rgba(0,0,0,0.08)');
            }
        );
        
        // Add click animation to shop items
        $('.shop-item').on('click', function() {
            $(this).css('transform', 'scale(0.98)');
            setTimeout(() => {
                $(this).css('transform', 'translateX(5px)');
            }, 150);
        });
        
        // Add search functionality
        $('input[type="text"]').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            $('.shop-item').each(function() {
                var shopName = $(this).find('h6').text().toLowerCase();
                if (shopName.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        
        // Add loading animation
        $('.shop-item').on('click', function() {
            var $this = $(this);
            $this.css('opacity', '0.7');
            $this.find('.shop-info h6').html('<i class="fas fa-spinner fa-spin"></i> Đang kết nối...');
        });
    });
    
    // Auto-refresh messages every 2 seconds
    setInterval(function() {
        var currentShopId = $('.shop-item.active').data('shop-id');
        if (currentShopId) {
            loadMessages(currentShopId);
        }
    }, 2000);
    
    // Function to load messages
    function loadMessages(shopId) {
        $.ajax({
            url: '/chat/messages/' + shopId,
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
        var isUser = message.sender == 0; // 0 = user, 1 = shop
        var messageClass = isUser ? 'chat-message-right' : 'chat-message-left';
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
    function sendMessage(shopId) {
        var message = $('input[name="message"]').val().trim();
        if (message === '') return;
        
        // Show typing indicator
        showTypingIndicator();
        
        $.ajax({
            url: '/chat/send',
            type: 'POST',
            data: {
                shop_id: shopId,
                message: message,
                _token: $('input[name="_token"]').val()
            },
            success: function(response) {
                hideTypingIndicator();
                $('input[name="message"]').val('');
                
                // Add message to chat immediately
                var messageHtml = createMessageHtml({
                    message: message,
                    sender: 0,
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
        var shopId = $('.shop-item.active').data('shop-id');
        if (shopId) {
            sendMessage(shopId);
        }
    });
    
    // Enter key to send message
    $('input[name="message"]').on('keypress', function(e) {
        if (e.which === 13) {
            var shopId = $('.shop-item.active').data('shop-id');
            if (shopId) {
                sendMessage(shopId);
            }
        }
    });
</script>

</body>
</html>



