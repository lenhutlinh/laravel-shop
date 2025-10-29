<!DOCTYPE html>
<html lang="en">

<head>

        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('css/sb-admin-2.min.css')}}"  rel="stylesheet">
    <link href="{{asset('css/upfile.css')}}"  rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">
    <title>Hồ sơ cửa hàng</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}"  rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">    

    <input type = "hidden" name = "_token" value = '<?php echo csrf_token(); ?>'>
    <style>
		label.error{
			color: red;
            font-size: 14px;
            display: block;
            font-weight: 400;
		}
        .error {
            color: #5a5c69;
            /* font-size: 7rem; */
            font-size: 16px;
            line-height: 1;
            position: relative;
            width: 100%;
        }
        
        /* Button styles */
        #update_address_btn {
            cursor: pointer;
        }
        
        /* Modal styles */
        .modal-dialog {
            max-width: 600px;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-control-user {
            border-radius: 10rem;
            padding: 0.75rem 1rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #5a5c69;
            margin-bottom: 8px;
        }
        
        /* Fix select display issues */
        select.form-control {
            -webkit-appearance: menulist !important;
            -moz-appearance: menulist !important;
            appearance: menulist !important;
            background-color: white !important;
            border: 1px solid #d1d3e2 !important;
            border-radius: 0.35rem !important;
            padding: 0.375rem 0.75rem !important;
            font-size: 0.875rem !important;
            line-height: 1.5 !important;
            color: #6e707e !important;
            width: 100% !important;
            height: auto !important;
            min-height: 38px !important;
        }
        
        select.form-control:focus {
            border-color: #bac8f3 !important;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25) !important;
            outline: none !important;
        }
        
        /* Force select to show selected value */
        select.form-control option:checked {
            background-color: #4e73df !important;
            color: white !important;
        }
        
        /* Override any custom select styling */
        select.form-control-user {
            -webkit-appearance: menulist !important;
            -moz-appearance: menulist !important;
            appearance: menulist !important;
        }
        
        /* Ensure select is visible and functional */
        #province, #district, #ward {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
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
                <div class="container-fluid">

                    <div class="xMDeox">
                    <div class="Hvae38" role="main">
                        <div style="display: contents;">
                        <div class="b7wtmP">
                            <div class="_66hYBa">
                                <h1 class="SbCTde">Hồ sơ của tôi</h1>
                                <div class="zptdmA">Thay đổi thông tin cửa hàng</div>
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
                            <form action="{{route('change_profile_shop')}}" method="POST" enctype="multipart/form-data" id="form_post">
                                @csrf
                            <div class="R-Gpdg">
                                <div class="volt8A">
                                    <table class="Zj7UK+">
                                        
                                        <tr>
                                            <td class="espR83">
                                                <label>Tên Shop</label>
                                            </td>
                                            <td class="Tmj5Z6">
                                                <div>
                                                    <div class="W50dp5">
                                                        <input type="text" placeholder="" class="CMyrTJ" value="{{$shop->shopname}}" name="shopname">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="espR83">
                                                <label>Email</label>
                                            </td>
                                            <td class="Tmj5Z6">
                                                <div class="W50dp5">
                                                    <input type="email" placeholder="" class="CMyrTJ" value="{{$shop->email}}" name="email">
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Địa chỉ shop -->
                                        <tr>
                                            <td class="espR83">
                                                <label>Địa chỉ shop</label>
                                            </td>
                                            <td class="Tmj5Z6">
                                                <div class="W50dp5">
                                                    <input type="text" placeholder="Địa chỉ hiện tại" class="CMyrTJ" value="{{$shop->address ?? 'Chưa có địa chỉ'}}" name="address" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="espR83">
                                                <label></label>
                                            </td>
                                            <td class="Tmj5Z6">
                                                <div class="W50dp5">
                                                    <a href="#" class="btn btn-primary" onclick="showAddressModal(); return false;">
                                                        <i class="fas fa-map-marker-alt"></i> Cập nhật địa chỉ
                                                    </a>
                                                    
                                                    <!-- Test button -->
                                                    <a href="#" class="btn btn-success" onclick="alert('Test button works!'); return false;" style="margin-left: 10px;">
                                                        Test Button
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                       
                                        <tr>
                                            <td class="espR83">
                                                <label></label>
                                            </td>
                                            <td class="Tmj5Z6">
                                                <button type="submit" id="sub_button" class="btn btn-solid-primary btn--m btn--inline" aria-disabled="false">Lưu</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="IQPHvE">
                                    <div class="scvgOW">
                                        <div class="XWsmVn">
                                            <div class="LoNm4g" style="background-image: url(&quot;{{asset('storage/'.$shop->shopImg)}}&quot;);"></div>
                                        </div>
                                        <input class="bMWDYw" type="file" accept=".jpg,.jpeg,.png" name="shop_img">
                                        <label  class="btn btn-light btn--m btn--inline" id="button_img">Chọn ảnh</label>
                                        <div class="L4SAGB">
                                            <div class="SlaeTm">Dụng lượng file tối đa 1 MB</div>
                                            <div class="SlaeTm">Định dạng:.JPEG, .PNG</div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

    <!-- Modal Cập nhật địa chỉ -->
    <div class="modal fade" id="updateAddressModal" tabindex="-1" role="dialog" aria-labelledby="updateAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAddressModalLabel">
                        <i class="fas fa-map-marker-alt"></i> Cập nhật địa chỉ shop
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateAddressForm">
                        @csrf
                        
                        <!-- Địa chỉ shop -->
                        <div class="form-group">
                            <label class="form-label">Địa chỉ shop</label>
                        </div>
                        
                        <div class="form-group">
                            <select id="province" name="province" class="form-control form-control-user" required>
                                <option value="">Chọn Tỉnh/Thành phố</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <select id="district" name="district" class="form-control form-control-user" required>
                                <option value="">Chọn Quận/Huyện</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <select id="ward" name="ward" class="form-control form-control-user" required>
                                <option value="">Chọn Phường/Xã</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="detail_address" 
                                   placeholder="Địa chỉ cụ thể (số nhà, tên đường...)" required>
                        </div>
                        
                        <!-- Hidden fields để lưu địa chỉ đầy đủ -->
                        <input type="hidden" id="address" name="pre_address">
                        <input type="hidden" id="shop_full_address" name="shop_full_address">
                        <input type="hidden" id="shop_latitude" name="shop_latitude">
                        <input type="hidden" id="shop_longitude" name="shop_longitude">
                        
                        <!-- Debug info (có thể ẩn trong production) -->
                        <div style="margin: 10px 0;">
                            <button type="button" id="toggle-debug" class="btn btn-sm btn-outline-secondary">
                                Hiển thị thông tin debug
                            </button>
                        </div>
                        <div id="debug-info" style="display: none; background: #f8f9fa; padding: 10px; margin: 10px 0; border-radius: 5px; font-size: 12px;">
                            <strong>Debug Info:</strong><br>
                            <span id="debug-address">Địa chỉ: Chưa chọn</span><br>
                            <span id="debug-coordinates">Tọa độ: Chưa có</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" id="save_address_btn" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu địa chỉ
                    </button>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Page level custom scripts -->
<script>
    $("#form_post").validate({
        rules: {
            "shopname": {
                required: true,
                maxlength: 20,
                minlength: 2,
            },
           
            "email": {
                required: true,
                email: true,
            },
        },
        messages: {
            "shopname": {
                required: "Vui lòng nhập tên người dùng",
                maxlength: "Họ người dùng không được vượt quá 20 ký tự",
                minlength: "Họ người dùng phải có ít nhất 2 ký tự",
            },
           
            "email": {
                required: "Vui lòng nhập email người dùng",
                email: "Vui lòng nhập đúng định dạng email",

            },
        },
        submitHandler: function(form) {
            $(form).submit();
        }
    
    });
    </script>

<script>
    const shopname = document.querySelector('input[name="shopname"]');
    const email = document.querySelector('input[name="email"]');
    const button = document.getElementById('sub_button');
    button.addEventListener('click', function(e){
        e.preventDefault(); // Prevent default form submission
        
        if(shopname.value == ''){
            swal("Vui lòng nhập họ người dùng");
            return false;
        }
        if(shopname.value.length < 2){    
            swal("Họ người dùng phải có ít nhất 2 ký tự");
            return false;
        }
        if(shopname.value.length > 20){
            swal("Họ người dùng không được vượt quá 20 ký tự");
            return false;
        }
        if(email.value == ''){
            swal("Vui lòng nhập email người dùng");
            return false;
        }
        if(email.value.length < 2){
            swal("Vui lòng nhập đúng định dạng email");
            return false;
        }
        
        // If validation passes, submit form via AJAX
        const form = document.getElementById('form_post');
        const formData = new FormData(form);
        
        $.ajax({
            url: '{{route("change_profile_shop")}}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Success response:', response);
                if (response.success && response.success !== false) {
                    const message = typeof response.success === 'string' ? response.success : 'Cập nhật thành công';
                    swal("Thành công", message, "success").then(() => {
                        window.location.href = '{{route("shop_profile")}}';
                    });
                } else {
                    swal("Lỗi", "Phản hồi không hợp lệ từ server", "error");
                }
            },
            error: function(xhr) {
                console.log('Error response:', xhr);
                let errorMessage = "Có lỗi xảy ra khi cập nhật thông tin";
                
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                } else if (xhr.responseText) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.error) {
                            errorMessage = response.error;
                        }
                    } catch (e) {
                        errorMessage = "Có lỗi xảy ra khi cập nhật thông tin";
                    }
                }
                
                swal("Lỗi", errorMessage, "error");
            }
        });
    });
</script>
<script>
    const button_img = document.getElementById('button_img');
    const input_img = document.querySelector('.bMWDYw');
    const img = document.querySelector('.LoNm4g');
    
    button_img.addEventListener('click', function(){
        input_img.click();
    });
    input_img.addEventListener('change', function(){
        const file = this.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(){
                const result = reader.result;
                img.style.backgroundImage = `url(${result})`;
                
            }
            reader.readAsDataURL(file);
        }
        else{
            img.style.backgroundImage = `url("{{asset('storage/users_img/user.png')}}")`;
        }
    });
</script>
<script>
    $(document).ready(function(){
        $('.user_cancel_order').click(function(){
            var order_id = $(this).data('order_id');
            var _token = $('input[name="_token"]').val();
            console.log(order_id);
            swal("Xác Nhận Hủy Đơn Hàng?", {
                buttons: {
                    cancel: "Không",
                    catch: {
                    text: "Xác Nhận",
                    value: "catch",
                    },
                },
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                    $.ajax({
                        url: '{{route('user_cancel_order')}}',
                        method: 'POST',
                        data:{
                            order_id: order_id,
                            _token: _token,
                        },
                        success: function(data){
                            $status = data.status; 
                            $product = data.product;
                            if($status == true){
                                location.reload();
                            }
                            else{
                                swal("");
                            }
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                    break;
                    default:
                      
                }
            });
        });
    });
   
</script>

<!-- Script xử lý modal cập nhật địa chỉ -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
$(document).ready(function() {
    // Xử lý nút mở modal
    $('#update_address_btn').click(function() {
        console.log('Button clicked!');
        $('#updateAddressModal').modal('show');
        loadProvinces();
    });
    
    // Function load provinces
    function loadProvinces() {
        axios.get('https://provinces.open-api.vn/api/?depth=1')
            .then((response) => {
                renderData(response.data, "province");
            })
            .catch((error) => {
                console.error('Error loading provinces:', error);
            });
    }
    
            // Xử lý nút lưu địa chỉ
            $('#save_address_btn').click(function() {
                const fullAddress = $('#shop_full_address').val();
                const latitude = $('#shop_latitude').val();
                const longitude = $('#shop_longitude').val();
                
                console.log('Save button clicked', { fullAddress, latitude, longitude });
                
                if (!fullAddress || !latitude || !longitude) {
                    swal("Lỗi", "Vui lòng chọn đầy đủ thông tin địa chỉ", "error");
                    return;
                }
                
                // Gửi AJAX request để cập nhật địa chỉ
                $.ajax({
                    url: '{{route("change_profile_shop")}}',
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        address: fullAddress,
                        latitude: latitude,
                        longitude: longitude
                    },
                    success: function(response) {
                        console.log('Success response:', response);
                        if (response.success && response.success !== false) {
                            // Nếu success là string (message), hiển thị message đó
                            const message = typeof response.success === 'string' ? response.success : 'Cập nhật thành công';
                            swal("Thành công", message, "success").then(() => {
                                window.location.href = '{{route("shop_profile")}}';
                            });
                        } else {
                            swal("Lỗi", "Phản hồi không hợp lệ từ server", "error");
                        }
                    },
                    error: function(xhr) {
                        console.log('Error response:', xhr);
                        let errorMessage = "Có lỗi xảy ra khi cập nhật địa chỉ";
                        
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        } else if (xhr.status === 500) {
                            errorMessage = "Lỗi server (500). Vui lòng kiểm tra log.";
                        }
                        
                        swal("Lỗi", errorMessage, "error");
                    }
                });
            });
    
    // Xử lý nút toggle debug
    $('#toggle-debug').click(function() {
        const debugInfo = $('#debug-info');
        const button = $(this);
        
        if (debugInfo.is(':visible')) {
            debugInfo.hide();
            button.text('Hiển thị thông tin debug');
        } else {
            debugInfo.show();
            button.text('Ẩn thông tin debug');
        }
    });
});

// Script xử lý địa chỉ sử dụng API provinces.open-api.vn
const host = "https://provinces.open-api.vn/api/";

var callAPI = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data, "province");
        });
}

var callApiDistrict = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.districts, "district");
        });
}

var callApiWard = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.wards, "ward");
        });
}

var renderData = (array, select) => {
    if (select == "province") {
        let row = ' <option  disable value="">Chọn Tỉnh/Thành Phố</option>';
        array.forEach(element => {
            row += `<option value="${element.code}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row;
    }
    if (select == "district") {
        let row = ' <option disable value="">Chọn Quận/Huyện</option>';
        array.forEach(element => {
            row += `<option  value="${element.code}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row;
    }
    if (select == "ward") {
        let row = ' <option disable value="">Chọn Phường/Xã</option>';
        array.forEach(element => {
            row += `<option  value="${element.code}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row;
    }
}

$("#province").change(() => {
    callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
    printResult();
    updateShopAddress();
});

$("#district").change(() => {
    callApiWard(host + "d/" + $("#district").val() + "?depth=2");
    printResult();
    updateShopAddress();
});

$("#ward").change(() => {
    printResult();
    updateShopAddress();
});

var printResult = () => {
    if ($("#district").val() != "" && $("#province").val() != "" &&
        $("#ward").val() != "") {
        let result = $("#province option:selected").text() +
            " - " + $("#district option:selected").text() + " - " +
            $("#ward option:selected").text() + " -  ";

        let address = `<option  value="${result}">${result}</option>` ;
        document.querySelector("#address").innerHTML = address;
        
        updateShopAddress();
    }
}

function updateShopAddress() {
    console.log('updateShopAddress called');
    
    // Sử dụng native JavaScript thay vì jQuery
    var provinceSelect = document.getElementById('province');
    var districtSelect = document.getElementById('district');
    var wardSelect = document.getElementById('ward');
    var detailAddressInput = document.querySelector('input[name="detail_address"]');
    
    var province = provinceSelect ? provinceSelect.options[provinceSelect.selectedIndex].text : '';
    var district = districtSelect ? districtSelect.options[districtSelect.selectedIndex].text : '';
    var ward = wardSelect ? wardSelect.options[wardSelect.selectedIndex].text : '';
    var detailAddress = detailAddressInput ? detailAddressInput.value : '';
    
    console.log('Address components:', { province, district, ward, detailAddress });
    
    // Kiểm tra điều kiện
    var hasProvince = province && province !== 'Chọn Tỉnh/Thành phố';
    var hasDistrict = district && district !== 'Chọn Quận/Huyện';
    var hasWard = ward && ward !== 'Chọn Phường/Xã';
    var hasDetailAddress = detailAddress && detailAddress.trim() !== '';
    
    console.log('Has components:', { hasProvince, hasDistrict, hasWard, hasDetailAddress });
    
    if (hasProvince && hasDistrict && hasWard && hasDetailAddress) {
        var fullAddress = detailAddress.trim() + ', ' + ward + ', ' + district + ', ' + province;
        
        // Cập nhật hidden fields
        var shopFullAddressInput = document.getElementById('shop_full_address');
        if (shopFullAddressInput) {
            shopFullAddressInput.value = fullAddress;
        }
        
        // Tính tọa độ chính xác từ địa chỉ đầy đủ
        getCoordinatesFromAddress(fullAddress).then(coordinates => {
            if (coordinates) {
                var latitudeInput = document.getElementById('shop_latitude');
                var longitudeInput = document.getElementById('shop_longitude');
                
                if (latitudeInput) latitudeInput.value = coordinates.lat;
                if (longitudeInput) longitudeInput.value = coordinates.lng;
                
                // Cập nhật debug info
                var debugAddress = document.getElementById('debug-address');
                var debugCoordinates = document.getElementById('debug-coordinates');
                
                if (debugAddress) debugAddress.textContent = 'Địa chỉ: ' + fullAddress;
                if (debugCoordinates) debugCoordinates.textContent = 'Tọa độ: ' + coordinates.lat + ', ' + coordinates.lng + ' (Chi tiết)';
                
                console.log('✅ Address updated:', fullAddress);
                console.log('✅ Accurate coordinates:', coordinates);
            } else {
                // Fallback: sử dụng tọa độ tỉnh
                console.log('⚠️ Using fallback coordinates from province');
                var fallbackCoordinates = getCoordinatesByProvince(province);
                if (fallbackCoordinates) {
                    var latitudeInput = document.getElementById('shop_latitude');
                    var longitudeInput = document.getElementById('shop_longitude');
                    
                    if (latitudeInput) latitudeInput.value = fallbackCoordinates.lat;
                    if (longitudeInput) longitudeInput.value = fallbackCoordinates.lng;
                    
                    // Cập nhật debug info
                    var debugAddress = document.getElementById('debug-address');
                    var debugCoordinates = document.getElementById('debug-coordinates');
                    
                    if (debugAddress) debugAddress.textContent = 'Địa chỉ: ' + fullAddress;
                    if (debugCoordinates) debugCoordinates.textContent = 'Tọa độ: ' + fallbackCoordinates.lat + ', ' + fallbackCoordinates.lng + ' (Tỉnh)';
                    
                    console.log('✅ Fallback coordinates:', fallbackCoordinates);
                } else {
                    // Cập nhật debug info với lỗi
                    var debugAddress = document.getElementById('debug-address');
                    var debugCoordinates = document.getElementById('debug-coordinates');
                    
                    if (debugAddress) debugAddress.textContent = 'Địa chỉ: ' + fullAddress;
                    if (debugCoordinates) debugCoordinates.textContent = '❌ Không tìm thấy tọa độ';
                    
                    console.log('❌ No coordinates found for province:', province);
                }
            }
        }).catch(error => {
            console.error('❌ Error getting coordinates:', error);
            
            // Fallback: sử dụng tọa độ tỉnh
            var fallbackCoordinates = getCoordinatesByProvince(province);
            if (fallbackCoordinates) {
                var latitudeInput = document.getElementById('shop_latitude');
                var longitudeInput = document.getElementById('shop_longitude');
                
                if (latitudeInput) latitudeInput.value = fallbackCoordinates.lat;
                if (longitudeInput) longitudeInput.value = fallbackCoordinates.lng;
                
                // Cập nhật debug info
                var debugAddress = document.getElementById('debug-address');
                var debugCoordinates = document.getElementById('debug-coordinates');
                
                if (debugAddress) debugAddress.textContent = 'Địa chỉ: ' + fullAddress;
                if (debugCoordinates) debugCoordinates.textContent = 'Tọa độ: ' + fallbackCoordinates.lat + ', ' + fallbackCoordinates.lng + ' (Tỉnh)';
                
                console.log('✅ Fallback coordinates after error:', fallbackCoordinates);
            }
        });
    } else {
        // Cập nhật debug info với lỗi
        var debugAddress = document.getElementById('debug-address');
        var debugCoordinates = document.getElementById('debug-coordinates');
        
        if (debugAddress) debugAddress.textContent = '❌ Chưa đầy đủ thông tin địa chỉ';
        if (debugCoordinates) debugCoordinates.textContent = '❌ Chưa có tọa độ';
        
        console.log('❌ Missing address components');
    }
}

// Function để lấy tọa độ chính xác từ địa chỉ
async function getCoordinatesFromAddress(fullAddress) {
    console.log('getCoordinatesFromAddress called with:', fullAddress);
    
    // Thử tìm tọa độ từ database chi tiết trước
    const detailedCoordinates = getDetailedCoordinates(fullAddress);
    if (detailedCoordinates) {
        console.log('✅ Found detailed coordinates:', detailedCoordinates);
        return detailedCoordinates;
    }
    
    // Fallback: thử API (có thể bị CORS)
    try {
        const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(fullAddress + ', Vietnam')}&limit=1&addressdetails=1`);
        const data = await response.json();
        
        if (data && data.length > 0) {
            const result = {
                lat: parseFloat(data[0].lat),
                lng: parseFloat(data[0].lon)
            };
            console.log('✅ Found coordinates from Nominatim:', result);
            return result;
        } else {
            console.log('❌ No coordinates found from Nominatim');
            return null;
        }
    } catch (error) {
        console.error('❌ Error getting coordinates from Nominatim:', error);
        return null;
    }
}

// Function để lấy tọa độ chi tiết từ database
function getDetailedCoordinates(fullAddress) {
    console.log('getDetailedCoordinates called with:', fullAddress);
    
    // Database tọa độ chi tiết theo quận/huyện
    const detailedCoordinates = {
        // Hà Nội
        'Ba Đình, Hà Nội': {lat: 21.0333, lng: 105.8333},
        'Hoàn Kiếm, Hà Nội': {lat: 21.0285, lng: 105.8542},
        'Tây Hồ, Hà Nội': {lat: 21.0667, lng: 105.8167},
        'Long Biên, Hà Nội': {lat: 21.0167, lng: 105.8833},
        'Cầu Giấy, Hà Nội': {lat: 21.0333, lng: 105.8000},
        'Đống Đa, Hà Nội': {lat: 21.0167, lng: 105.8333},
        'Hai Bà Trưng, Hà Nội': {lat: 21.0167, lng: 105.8500},
        'Hoàng Mai, Hà Nội': {lat: 20.9833, lng: 105.8500},
        'Thanh Xuân, Hà Nội': {lat: 21.0000, lng: 105.8000},
        
        // TP. Hồ Chí Minh
        'Quận 1, TP. Hồ Chí Minh': {lat: 10.7769, lng: 106.7009},
        'Quận 2, TP. Hồ Chí Minh': {lat: 10.7872, lng: 106.7498},
        'Quận 3, TP. Hồ Chí Minh': {lat: 10.7829, lng: 106.6871},
        'Quận 4, TP. Hồ Chí Minh': {lat: 10.7463, lng: 106.7014},
        'Quận 5, TP. Hồ Chí Minh': {lat: 10.7540, lng: 106.6694},
        'Quận 6, TP. Hồ Chí Minh': {lat: 10.7465, lng: 106.6350},
        'Quận 7, TP. Hồ Chí Minh': {lat: 10.7373, lng: 106.7224},
        'Quận 8, TP. Hồ Chí Minh': {lat: 10.7403, lng: 106.6654},
        'Quận 9, TP. Hồ Chí Minh': {lat: 10.8428, lng: 106.8081},
        'Quận 10, TP. Hồ Chí Minh': {lat: 10.7679, lng: 106.6667},
        'Quận 11, TP. Hồ Chí Minh': {lat: 10.7679, lng: 106.6500},
        'Quận 12, TP. Hồ Chí Minh': {lat: 10.8633, lng: 106.6544},
        'Thủ Đức, TP. Hồ Chí Minh': {lat: 10.8600, lng: 106.7600},
        'Gò Vấp, TP. Hồ Chí Minh': {lat: 10.8333, lng: 106.6833},
        'Bình Thạnh, TP. Hồ Chí Minh': {lat: 10.8167, lng: 106.7000},
        'Tân Bình, TP. Hồ Chí Minh': {lat: 10.8000, lng: 106.6500},
        'Tân Phú, TP. Hồ Chí Minh': {lat: 10.7833, lng: 106.6167},
        'Phú Nhuận, TP. Hồ Chí Minh': {lat: 10.8000, lng: 106.6833},
        'Bình Tân, TP. Hồ Chí Minh': {lat: 10.7500, lng: 106.6000},
        'Hóc Môn, TP. Hồ Chí Minh': {lat: 10.8833, lng: 106.5833},
        'Củ Chi, TP. Hồ Chí Minh': {lat: 11.0167, lng: 106.5000},
        'Bình Chánh, TP. Hồ Chí Minh': {lat: 10.7000, lng: 106.5667},
        'Nhà Bè, TP. Hồ Chí Minh': {lat: 10.6833, lng: 106.7333},
        'Cần Giờ, TP. Hồ Chí Minh': {lat: 10.4167, lng: 106.9667},
        
        // Cần Thơ
        'Ninh Kiều, Cần Thơ': {lat: 10.0452, lng: 105.7469},
        'Ô Môn, Cần Thơ': {lat: 10.1167, lng: 105.6167},
        'Bình Thủy, Cần Thơ': {lat: 10.0833, lng: 105.7333},
        'Cái Răng, Cần Thơ': {lat: 9.9833, lng: 105.7500},
        'Thốt Nốt, Cần Thơ': {lat: 10.2667, lng: 105.5167},
        'Vĩnh Thạnh, Cần Thơ': {lat: 10.2167, lng: 105.4000},
        'Cờ Đỏ, Cần Thơ': {lat: 10.0833, lng: 105.4333},
        'Phong Điền, Cần Thơ': {lat: 9.9833, lng: 105.6667},
        'Thới Lai, Cần Thơ': {lat: 10.0667, lng: 105.5667},
        
        // Vĩnh Long
        'Vĩnh Long, Vĩnh Long': {lat: 10.2401, lng: 105.9572},
        'Long Hồ, Vĩnh Long': {lat: 10.2167, lng: 105.9167},
        'Mang Thít, Vĩnh Long': {lat: 10.1667, lng: 106.0833},
        'Vũng Liêm, Vĩnh Long': {lat: 10.0833, lng: 106.1667},
        'Tam Bình, Vĩnh Long': {lat: 10.0500, lng: 105.9833},
        'Bình Minh, Vĩnh Long': {lat: 10.0667, lng: 105.8167},
        'Trà Ôn, Vĩnh Long': {lat: 9.9833, lng: 106.0167},
        'Bình Tân, Vĩnh Long': {lat: 10.1167, lng: 105.7500},
        
        // Đà Nẵng
        'Hải Châu, Đà Nẵng': {lat: 16.0544, lng: 108.2022},
        'Thanh Khê, Đà Nẵng': {lat: 16.0667, lng: 108.1833},
        'Sơn Trà, Đà Nẵng': {lat: 16.0833, lng: 108.2500},
        'Ngũ Hành Sơn, Đà Nẵng': {lat: 16.0167, lng: 108.2500},
        'Liên Chiểu, Đà Nẵng': {lat: 16.1167, lng: 108.1167},
        'Cẩm Lệ, Đà Nẵng': {lat: 16.0167, lng: 108.2000},
        'Hòa Vang, Đà Nẵng': {lat: 16.0167, lng: 108.1333},
        'Hoàng Sa, Đà Nẵng': {lat: 16.5000, lng: 111.5000},
        
        // Hải Phòng
        'Hồng Bàng, Hải Phòng': {lat: 20.8449, lng: 106.6881},
        'Ngô Quyền, Hải Phòng': {lat: 20.8500, lng: 106.6833},
        'Lê Chân, Hải Phòng': {lat: 20.8333, lng: 106.7000},
        'Hải An, Hải Phòng': {lat: 20.8167, lng: 106.7500},
        'Kiến An, Hải Phòng': {lat: 20.8000, lng: 106.6167},
        'Đồ Sơn, Hải Phòng': {lat: 20.7167, lng: 106.7667},
        'Dương Kinh, Hải Phòng': {lat: 20.7167, lng: 106.7000},
        'Thuỷ Nguyên, Hải Phòng': {lat: 20.9500, lng: 106.6667},
        'An Dương, Hải Phòng': {lat: 20.8667, lng: 106.6167},
        'An Lão, Hải Phòng': {lat: 20.8167, lng: 106.5500},
        'Kiến Thuỵ, Hải Phòng': {lat: 20.7500, lng: 106.6667},
        'Tiên Lãng, Hải Phòng': {lat: 20.7000, lng: 106.5500},
        'Vĩnh Bảo, Hải Phòng': {lat: 20.6833, lng: 106.4833},
        'Cát Hải, Hải Phòng': {lat: 20.8167, lng: 106.9167},
        'Bạch Long Vĩ, Hải Phòng': {lat: 20.1333, lng: 107.7333}
    };
    
    // Tìm exact match
    for (const key in detailedCoordinates) {
        if (fullAddress.includes(key)) {
            console.log('✅ Found detailed match:', key);
            return detailedCoordinates[key];
        }
    }
    
    // Tìm partial match
    for (const key in detailedCoordinates) {
        const keyParts = key.split(', ');
        for (const part of keyParts) {
            if (fullAddress.includes(part)) {
                console.log('✅ Found partial detailed match:', part, 'in', key);
                return detailedCoordinates[key];
            }
        }
    }
    
    console.log('❌ No detailed coordinates found');
    return null;
}

// Function để lấy tọa độ từ tỉnh (fallback)
function getCoordinatesByProvince(provinceName) {
    console.log('getCoordinatesByProvince called with:', provinceName);
    
    const coordinates = {
        'Hà Nội': {lat: 21.0285, lng: 105.8542},
        'Thành phố Hà Nội': {lat: 21.0285, lng: 105.8542},
        'TP. Hồ Chí Minh': {lat: 10.8231, lng: 106.6297},
        'Thành phố Hồ Chí Minh': {lat: 10.8231, lng: 106.6297},
        'Đà Nẵng': {lat: 16.0544, lng: 108.2022},
        'Thành phố Đà Nẵng': {lat: 16.0544, lng: 108.2022},
        'Hải Phòng': {lat: 20.8449, lng: 106.6881},
        'Thành phố Hải Phòng': {lat: 20.8449, lng: 106.6881},
        'Cần Thơ': {lat: 10.0452, lng: 105.7469},
        'Thành phố Cần Thơ': {lat: 10.0452, lng: 105.7469},
        'Vĩnh Long': {lat: 10.2401, lng: 105.9572},
        'Tỉnh Vĩnh Long': {lat: 10.2401, lng: 105.9572},
        'Bắc Ninh': {lat: 21.1861, lng: 106.0763},
        'Hưng Yên': {lat: 20.6464, lng: 106.0511},
        'Hà Nam': {lat: 20.5411, lng: 105.9228},
        'Thái Bình': {lat: 20.4461, lng: 106.3422},
        'Nam Định': {lat: 20.4208, lng: 106.1683},
        'Bình Dương': {lat: 11.3254, lng: 106.4774},
        'Đồng Nai': {lat: 11.1204, lng: 107.1946},
        'Long An': {lat: 10.6086, lng: 106.6714},
        'Quảng Ninh': {lat: 21.0063, lng: 107.2926},
        'Lào Cai': {lat: 22.3402, lng: 103.8448},
        'Điện Biên': {lat: 21.3862, lng: 103.0230},
        'Lai Châu': {lat: 22.3490, lng: 103.4487},
        'Sơn La': {lat: 21.3257, lng: 103.9178},
        'Yên Bái': {lat: 21.7052, lng: 104.8696},
        'Hà Giang': {lat: 22.7662, lng: 104.9380},
        'Cao Bằng': {lat: 22.6653, lng: 106.2573},
        'Bắc Kạn': {lat: 22.1442, lng: 105.8328},
        'Tuyên Quang': {lat: 21.8180, lng: 105.2114},
        'Phú Thọ': {lat: 21.3619, lng: 105.3131},
        'Vĩnh Phúc': {lat: 21.3609, lng: 105.5474},
        'Bắc Giang': {lat: 21.3011, lng: 106.6297},
        'Lạng Sơn': {lat: 21.8537, lng: 106.7613},
        'Thái Nguyên': {lat: 21.5944, lng: 105.8481},
        'Hòa Bình': {lat: 20.8136, lng: 105.3382},
        'Ninh Bình': {lat: 20.2506, lng: 105.9744},
        'Thanh Hóa': {lat: 19.8076, lng: 105.7842},
        'Nghệ An': {lat: 18.6792, lng: 105.6919},
        'Hà Tĩnh': {lat: 18.3428, lng: 105.9055},
        'Quảng Bình': {lat: 17.4687, lng: 106.6227},
        'Quảng Trị': {lat: 16.8167, lng: 107.1003},
        'Thừa Thiên Huế': {lat: 16.4637, lng: 107.5909},
        'Quảng Nam': {lat: 15.8801, lng: 108.3380},
        'Quảng Ngãi': {lat: 15.1200, lng: 108.8047},
        'Bình Định': {lat: 13.8750, lng: 109.1117},
        'Phú Yên': {lat: 13.0884, lng: 109.0929},
        'Khánh Hòa': {lat: 12.2388, lng: 109.1967},
        'Ninh Thuận': {lat: 11.5646, lng: 108.9889},
        'Bình Thuận': {lat: 10.9289, lng: 108.1021},
        'Bà Rịa - Vũng Tàu': {lat: 10.5411, lng: 107.2420},
        'Tây Ninh': {lat: 11.3131, lng: 106.1093},
        'Bình Phước': {lat: 11.6471, lng: 106.6056},
        'An Giang': {lat: 10.5216, lng: 105.1259},
        'Kiên Giang': {lat: 9.9580, lng: 105.0904},
        'Cà Mau': {lat: 9.1768, lng: 105.1524},
        'Bạc Liêu': {lat: 9.2943, lng: 105.7272},
        'Sóc Trăng': {lat: 9.6004, lng: 105.9804},
        'Trà Vinh': {lat: 9.9345, lng: 106.3453},
        'Đồng Tháp': {lat: 10.4930, lng: 105.6354},
        'Tiền Giang': {lat: 10.3600, lng: 106.3600},
        'Bến Tre': {lat: 10.2434, lng: 106.3759},
        'Hậu Giang': {lat: 9.7842, lng: 105.4701},
        'Kon Tum': {lat: 14.3545, lng: 108.0076},
        'Gia Lai': {lat: 13.8079, lng: 108.1094},
        'Đắk Lắk': {lat: 12.6667, lng: 108.0500},
        'Đắk Nông': {lat: 12.0042, lng: 107.6907},
        'Lâm Đồng': {lat: 11.9404, lng: 108.4583}
    };
    
    // Tìm exact match trước
    var result = coordinates[provinceName];
    if (result) {
        console.log('✅ Found exact match:', provinceName);
        return result;
    }
    
    // Tìm partial match
    for (var key in coordinates) {
        if (provinceName.includes(key) || key.includes(provinceName)) {
            console.log('✅ Found partial match:', key, 'for', provinceName);
            return coordinates[key];
        }
    }
    
    console.log('❌ No coordinates found for:', provinceName);
    return null;
}

// Lắng nghe sự kiện thay đổi địa chỉ chi tiết
$(document).ready(function() {
    $('input[name="detail_address"]').on('input', function() {
        updateShopAddress();
    });
});

// Function để hiển thị modal địa chỉ
function showAddressModal() {
    console.log('showAddressModal called');
    
    // Tìm modal element
    var modal = document.getElementById('updateAddressModal');
    if (modal) {
        console.log('Modal found, showing...');
        
        // Hiển thị modal bằng cách thêm class và style
        modal.style.display = 'block';
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        
        // Thêm backdrop
        var backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        backdrop.id = 'modal-backdrop';
        document.body.appendChild(backdrop);
        
        // Load provinces
        loadProvincesData();
        
        console.log('Modal should be visible now');
    } else {
        console.log('Modal not found!');
        alert('Modal not found!');
    }
}

// Function để load provinces data
function loadProvincesData() {
    console.log('Loading provinces...');
    
    // Sử dụng fetch thay vì axios
    fetch('https://provinces.open-api.vn/api/?depth=1')
        .then(response => response.json())
        .then(data => {
            console.log('Provinces loaded:', data.length);
            renderProvincesData(data);
        })
        .catch(error => {
            console.error('Error loading provinces:', error);
        });
}

// Function để render provinces data
function renderProvincesData(provinces) {
    var select = document.getElementById('province');
    if (select) {
        select.innerHTML = '<option value="">Chọn Tỉnh/Thành phố</option>';
        
        provinces.forEach(function(province) {
            var option = document.createElement('option');
            option.value = province.code;
            option.textContent = province.name;
            select.appendChild(option);
        });
        
        console.log('Provinces rendered:', provinces.length);
        
        // Thêm event listener cho province
        select.addEventListener('change', function() {
            console.log('Province changed:', this.value);
            loadDistrictsData(this.value);
            updateShopAddress();
        });
    }
}

// Function để load districts data
function loadDistrictsData(provinceCode) {
    console.log('Loading districts for province:', provinceCode);
    
    fetch('https://provinces.open-api.vn/api/p/' + provinceCode + '?depth=2')
        .then(response => response.json())
        .then(data => {
            console.log('Districts loaded:', data.districts.length);
            renderDistrictsData(data.districts);
        })
        .catch(error => {
            console.error('Error loading districts:', error);
        });
}

// Function để render districts data
function renderDistrictsData(districts) {
    var select = document.getElementById('district');
    if (select) {
        select.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
        
        districts.forEach(function(district) {
            var option = document.createElement('option');
            option.value = district.code;
            option.textContent = district.name;
            select.appendChild(option);
        });
        
        console.log('Districts rendered:', districts.length);
        
        // Thêm event listener cho district
        select.addEventListener('change', function() {
            console.log('District changed:', this.value);
            loadWardsData(this.value);
            updateShopAddress();
        });
    }
}

// Function để load wards data
function loadWardsData(districtCode) {
    console.log('Loading wards for district:', districtCode);
    
    fetch('https://provinces.open-api.vn/api/d/' + districtCode + '?depth=2')
        .then(response => response.json())
        .then(data => {
            console.log('Wards loaded:', data.wards.length);
            renderWardsData(data.wards);
        })
        .catch(error => {
            console.error('Error loading wards:', error);
        });
}

// Function để render wards data
function renderWardsData(wards) {
    var select = document.getElementById('ward');
    if (select) {
        select.innerHTML = '<option value="">Chọn Phường/Xã</option>';
        
        wards.forEach(function(ward) {
            var option = document.createElement('option');
            option.value = ward.code;
            option.textContent = ward.name;
            select.appendChild(option);
        });
        
        console.log('Wards rendered:', wards.length);
        
        // Thêm event listener cho ward
        select.addEventListener('change', function() {
            console.log('Ward changed:', this.value);
            updateShopAddress();
        });
    }
}

// Function để đóng modal
function closeAddressModal() {
    var modal = document.getElementById('updateAddressModal');
    if (modal) {
        modal.style.display = 'none';
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        
        // Xóa backdrop
        var backdrop = document.getElementById('modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    }
}

// Thêm event listener cho nút đóng modal
document.addEventListener('DOMContentLoaded', function() {
    // Nút đóng modal
    var closeBtn = document.querySelector('#updateAddressModal .close');
    if (closeBtn) {
        closeBtn.addEventListener('click', closeAddressModal);
    }
    
    // Nút cancel
    var cancelBtn = document.querySelector('#updateAddressModal .btn-secondary');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', closeAddressModal);
    }
    
    // Click outside modal để đóng
    var modal = document.getElementById('updateAddressModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeAddressModal();
            }
        });
    }
    
    // Event listener cho input địa chỉ chi tiết
    var detailAddressInput = document.querySelector('input[name="detail_address"]');
    if (detailAddressInput) {
        detailAddressInput.addEventListener('input', function() {
            console.log('Detail address changed:', this.value);
            updateShopAddress();
        });
    }
});

</script>
</body>

</html>