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
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/sweetalert.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Chating</title>
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
    max-height: 550px;
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
<body>
    
    <header>
        <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </header>
    <main class="content">
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
                        <?php $__currentLoopData = $shop_list_unread; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('show_chat',$shop->id)); ?>" class="list-group-item list-group-item-action border-0">
                            <?php if($shop->unread > 0): ?>
                            <div class="badge bg-success float-right"><?php echo e($shop->unread); ?></div>
                            <?php endif; ?>
                            <div class="d-flex align-items-start">
                                <img src="<?php echo e(asset('storage/'.$shop->shopImg)); ?>" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                <div class="flex-grow-1 ml-3">
                                    <?php echo e($shop->shopname); ?>

                                    <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $shop_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('show_chat',$shop->id)); ?>" class="list-group-item list-group-item-action border-0">
                            <div class="badge bg-success float-right"></div>
                            <div class="d-flex align-items-start">
                                <img src="<?php echo e(asset('storage/'.$shop->shopImg)); ?>" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                <div class="flex-grow-1 ml-3">
                                    <?php echo e($shop->shopname); ?>

                                    <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
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
                                    <img src="<?php echo e(asset('storage/'.$shop_chat->shopImg)); ?>" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong><?php echo e($shop_chat->shopname); ?></strong>
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
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if($message->sender == 2): ?>
                                <div class="chat-message-right pb-4">
                                    <div>
                                        <?php if($user_img == null): ?>
                                        <img src="<?php echo e(asset('storage/users_img/user.png')); ?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('storage/'.$user_img)); ?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                        <?php endif; ?>
                                        <div class="text-muted small text-nowrap mt-2"><?php echo e(date('H:i  ', strtotime($message->created_at))); ?> </div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                        <div class="font-weight-bold mb-1">You</div>
                                            <?php echo e($message->message); ?>

                      
                                    </div>
                                </div>
                                
                                <?php else: ?>
                                <div class="chat-message-left pb-4">
                                    <div>
                                        <img src="<?php echo e(asset('storage/'.$shop_chat->shopImg)); ?>" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                        <div class="text-muted small text-nowrap mt-2"><?php echo e(date('H:i  ', strtotime($message->created_at))); ?></div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                        <div class="font-weight-bold mb-1"><?php echo e($shop_chat->shopname); ?></div>
                                        <?php echo e($message->message); ?>

                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               

                            </div>
                        </div>

                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <form class="form_send" id="form_send">      
                            <?php echo csrf_field(); ?>          
                            <div class="input-group">

                                <input type="text" class="form-control" placeholder="Nhập tin nhắn" name="message" id="input_send">
                                <span class="btn btn-primary"  id="button_send" >Gửi</span>
                                <input type="hidden" class="shop_id" name="shop_id" value="<?php echo e($shop_chat->id); ?>" data-shop_id="<?php echo e($shop_chat->id); ?>">
                                <input type="hidden" class="user_id" name="user_id" value="<?php echo e($user_id); ?>" data-shop_id="<?php echo e($user_id); ?>">

                            </div>
                            </form>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </main>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

        var user_id = <?php echo e(Session::get('user_id')); ?>;
        var user_img = '<?php echo e(Session::get('user_img')); ?>';
        console.log(user_img);
        // console.log(user_id);    
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
        var channel = pusher.subscribe('sendMessageToUser.'+user_id);
        console.log(channel);
        channel.bind('pusher:subscription_succeeded', function(members) {
            // alert('successfully subscribed!');
        });
            
        channel.bind('send-message',function(data){
            
            if (data.sender == 2) {
                var container = document.getElementById('chat_message') ;
                var newMessage = document.createElement('div');
                newMessage.className = 'chat-message-right pb-4';
                if (user_img != '') {
                    var messageHTML = '<div><img src="' + ('<?php echo e(asset('storage/'.$user_img)); ?>') + '" class="rounded-circle mr-1"  width="40" height="40">';

                }else{
                    var messageHTML = '<div><img src="' + ('<?php echo e(asset('storage/users_img/user.png')); ?>') + '" class="rounded-circle mr-1"  width="40" height="40">';
                }
                messageHTML += '<div class="text-muted small text-nowrap mt-2">' + data.created_at + '</div></div>';
                messageHTML += '<div class="flex-shrink-1 bg-light rounded py-2 px-3 ' + ('mr-3') + '"><div class="font-weight-bold mb-1">' + ('You') + '</div>' + data.message + '</div>';
                newMessage.innerHTML = messageHTML;
                container.appendChild(newMessage);
                container.scrollTop = container.scrollHeight;
            }
            if (data.sender ==1) {
                var container = document.getElementById('chat_message') ;
                var newMessage = document.createElement('div');
                newMessage.className = 'chat-message-left pb-4';
                var messageHTML = '<div><img src="' + ('<?php echo e(asset('storage/'.$shop_chat->shopImg)); ?>') + '" class="rounded-circle mr-1"  width="40" height="40">';
                messageHTML += '<div class="text-muted small text-nowrap mt-2">' + data.created_at + '</div></div>';
                messageHTML += '<div class="flex-shrink-1 bg-light rounded py-2 px-3 ' + ('mr-3') + '"><div class="font-weight-bold mb-1">' +('<?php echo e($shop_chat->shopname); ?>')+ '</div>' + data.message + '</div>';
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
            // console.log(user_id);

            $.ajax({
                    url: '<?php echo e(route('send_messages_user')); ?>',
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



<?php /**PATH D:\Ecommerce\resources\views/chat/show_chat_user.blade.php ENDPATH**/ ?>