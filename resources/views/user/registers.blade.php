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
    <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
    <title>Đăng Ký</title>
    <style>
    /* Style chung cho form */
    body {
        font-family: Roboto, sans-serif;
    }

    /* Style cho nhãn báo lỗi chung */
    label.error {
        color: red;
        font-size: 14px;
        display: block;
        margin-top: 5px;
        font-weight: 400;
    }

    /* Class error mặc định của jQuery validate */
    .error {
        color: red;
        font-size: 14px;
        line-height: 1.4;
        width: 100%;
    }

    /* Checkbox input fix: không bị kéo dài khi lỗi */
    .form-check-input {
        width: 18px;
        height: 18px;
        margin-top: 2px;
    }

    .form-check-input:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    /* Label của checkbox */
    .form-check-label {
        margin-left: 6px;
        font-size: 15px;
    }

    /* Chỗ hiển thị lỗi riêng của checkbox */
    #agree-error-container {
        font-size: 14px;
        color: red;
        margin-top: 5px;
    }

    /* Nút đăng ký */
    .btn-register {
        width: 100%;
        background-color: var(--theme-color);
        font-size: larger;
        color: #fff;
    }

    .btn-register:hover {
        opacity: 0.9;
    }
</style>
</head>
<body>
    
    <header>
        @include('header')
        
    </header>
    <main >
        <div class="distance" style="font-family: Roboto, sans-serif; padding-top: 20px;">
            <div class="container h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                  <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">ĐĂNG KÝ TÀI KHOẢN</h2>
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
                      <form action="{{route('registers_user')}}" method="POST" id="form_login_user">
                        @csrf
                        
                        <div class="form-outline mb-4">
                          <input type="text"  class="form-control form-control-lg"  placeholder="Nhập Họ"  style="font-size: 17px;" name="firstname"/>
                        </div>  
                        <div class="form-outline mb-4">
                            <input type="text"  class="form-control form-control-lg"  placeholder="Nhập Tên"  style="font-size: 17px;" name="lastname"/>
                          </div>        
                        <div class="form-outline mb-4">
                          <input type="email"  class="form-control form-control-lg" placeholder="Nhập Email" style="font-size: 17px;"  name="email"/>                           
                        </div>   
                        

                        <div class="form-outline mb-4">
                          <input type="password"  class="form-control form-control-lg" placeholder="Nhập Mật Khẩu" style="font-size: 17px;" id="exampleInputPassword"  name="password"/>
                        </div>
                        <div class="form-outline mb-4">
                          <input type="password"  class="form-control form-control-lg" placeholder="Xác Nhận Mật Khẩu" style="font-size: 17px;"  name="password_confirm"/>
                        </div>
                        <div class="form-check d-flex justify-content-center mb-5">
                          <input
                            class="form-check-input me-2"
                            type="checkbox"
                            name="agree"   
                            id="form2Example3cg"
                            value="1"
                          />
                          <label class="form-check-label" for="form2Example3g">
                            Tôi đồng ý với điều khoản của <a href="#!" class="text-body"><u>Dịch vụ</u></a>
                          </label>
                        </div>
                        <div id="agree-error-container" class="text-danger text-center mb-3"></div>
                        <div class="d-flex justify-content-center">
                          <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-white " style="width: 100%;background-color: var(--theme-color); font-size: larger;"  >ĐĂNG KÝ</button>
                        </div>
        
                        <p class="text-center text-muted mt-5 mb-0">Bạn đã có tài khoản? <a href="{{route('login') }}" class="fw-bold text-infor" style="text-decoration: none;">Đăng nhập tại đây</a></p>
        
                      </form>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        // Custom rule kiểm tra mật khẩu mạnh
    jQuery.validator.addMethod("strongPassword", function(value, element) {
    return this.optional(element) || 
            /[A-Z]/.test(value) &&     // có ít nhất 1 chữ hoa
            /[a-z]/.test(value) &&     // có ít nhất 1 chữ thường
            /[0-9]/.test(value) &&     // có ít nhất 1 chữ số
            /[^A-Za-z0-9]/.test(value) && // có ít nhất 1 ký tự đặc biệt
            value.length >= 8;         // tối thiểu 8 ký tự
    }, "Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa, chữ thường, số và ký tự đặc biệt");

      jQuery.validator.addMethod("gmail", function(value, element) {
      return this.optional(element) || /^[a-zA-Z0-9._%+-]+@gmail\.com$/i.test(value);
      }, "Vui lòng nhập email Gmail hợp lệ (ví dụ: abc@gmail.com)");
    $("#form_login_user").validate({
    rules: {
        "firstname": {
            required: true,
            maxlength: 20,
            minlength: 2,
        },
        "lastname": {
            required: true,
            maxlength: 20,
            minlength: 2,
        },
        "email": {
            required: true,
            email: true,
            gmail: true
        },
        "password": {
            required: true,
            strongPassword: true
        },

        "password_confirm": {
            required: true,
            equalTo: "#exampleInputPassword"
        },
        "agree": {   // checkbox
            required: true
        }
    },
    messages: {
        "firstname": {
            required: "Vui lòng nhập họ người dùng",
            maxlength: "Họ người dùng không được vượt quá 20 ký tự",
            minlength: "Họ người dùng phải có ít nhất 2 ký tự",
        },
        "lastname": {
            required: "Vui lòng nhập tên người dùng",
            maxlength: "Tên của người dùng không được vượt quá 20 ký tự",
            minlength: "Tên của người dùng phải có ít nhất 2 ký tự",
        },
        "email": {
            required: "Vui lòng nhập email người dùng",
            email: "Vui lòng nhập đúng định dạng email",
            gmail: "Chỉ chấp nhận địa chỉ Gmail (kết thúc bằng @gmail.com)"
        },
        "password": {
            required: "Vui lòng nhập mật khẩu",
            strongPassword: "Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa, chữ thường, số và ký tự đặc biệt"
        },
        "password_confirm": {
            required: "Vui lòng xác nhận lại mật khẩu",
            equalTo: "Mật khẩu xác nhận không khớp",
        },
        "agree": {
            required: "Bạn phải đồng ý với điều khoản dịch vụ trước khi đăng ký"
        }
    },
    // 👇 phải đặt ở ngoài messages
    errorPlacement: function(error, element) {
        if (element.attr("name") == "agree") {
            // 🚨 Đẩy thông báo ra sau checkbox label
            error.appendTo("#agree-error-container");  
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        form.submit();
    }
});
    </script>
</body>
</html>