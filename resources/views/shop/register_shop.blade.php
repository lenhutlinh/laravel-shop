<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng Ký - Kênh Bán Hàng</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{asset('css/sb-admin-2.min.css')}}">
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
<style>
    .custom-file-upload{
    border: 1px solid #ccc;
    display: inline-block;
    padding: 14px 12px;
    cursor: pointer;
    border-radius: 5px;
    background-color: #eee;
    color: #333;
    font-size: 13px;
    font-weight: 600;
   
}
input[type="file"]{
    display: none;
}

</style>
<body class="bg-gradient-primary">

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng Ký Bán Hàng</h1>
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
                            </div>
                            <form class="user" action="{{route('registers_shop')}}" method="POST" enctype="multipart/form-data" id="form_register_shop" >
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"  name="shop_name" id="exampleFirstName"
                                            placeholder="Tên Shop">
                                    </div>
                                    <div class="col-sm-6" style="display:flex;" >
                                        <label for="up_img" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i> Đăng tải logo shop
                                        </label>
                                        <input  name="shopImg" type="file" id="up_img"  required>

                                        <img src="" id="logo_shop" style="width: 100px; height: 100px; display: none;" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input  required name="email"  type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input  name="password" type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Mật Khẩu" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input  name="password_confirm" type="password" class="form-control form-control-user" name="password_confirm"
                                            id="exampleRepeatPassword" placeholder="Nhập Lại Mật Khẩu">
                                    </div>
                                </div>
                                
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
                                <button type="submit"  class="btn btn-primary btn-user btn-block">
                                        Đăng Ký Shop
                                </button>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Đăng Ký with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Đăng Ký with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Quên mật khẩu?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{route('login_shop')}}">Bạn đã có tài khoản? Đăng nhập!</a>
                            </div>
                        </div>
                    </div>
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
    
    <!-- include jQuery validate library -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#up_img').change(function(){
            var fileName = $(this).val();
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            if(ext == "jpg" || ext == "png" || ext == "jpeg"){
                $('#logo_shop').css('display','block');
                let file = $(this).prop('files')[0];
                let reader = new FileReader();
                reader.onload = function(){
                    $('#logo_shop').attr('src',reader.result);
                }
                reader.readAsDataURL(file);
            }
            else{
                alert('Chỉ được chọn file ảnh');
                $('#up_img').val('');
            }
        })
        })
    </script>
    <script>
    $("#form_register_shop").validate({
        rules: {
            "shop_name": {
                required: true,
                maxlength: 50,
            },
            "email": {
                required: true,
                email: true,
            },
            "password": {
                required: true,
                minlength: 6,
            },
            "password_confirm": { 
                required: true,
                equalTo: "#exampleInputPassword"
            },
            "shopImg":{ 
                required: true,
            },
            "province": {
                required: true,
            },
            "district": {
                required: true,
            },
            "ward": {
                required: true,
            },
            "detail_address": {
                required: true,
                minlength: 5,
            },
        },
        messages: {
            "shop_name": {
                required: "Vui lòng nhập tên shop",
                maxlength: "Tên shop không được vượt quá 50 ký tự",
            },
            "email": {
                required: "Vui lòng nhập email ",
                email: "Vui lòng nhập đúng định dạng email",
            },
            "password": {
                required: "Vui lòng nhập mật khẩu",
                minlength: "Mật khẩu phải có ít nhất 6 ký tự",
            },
            "password_confirm": {
                required: "Vui lòng xác nhận lại mật khẩu",
                equalTo: "Mật khẩu xác nhận không khớp",
            },
            "shopImg":{ 
                required: "Vui lòng đăng tải logo shop ",
            },
            "province": {
                required: "Vui lòng chọn tỉnh/thành phố",
            },
            "district": {
                required: "Vui lòng chọn quận/huyện",
            },
            "ward": {
                required: "Vui lòng chọn phường/xã",
            },
            "detail_address": {
                required: "Vui lòng nhập địa chỉ cụ thể",
                minlength: "Địa chỉ phải có ít nhất 5 ký tự",
            },
        },
        submitHandler: function(form) {
            // Kiểm tra địa chỉ đầy đủ trước khi submit
            const fullAddress = $('#shop_full_address').val();
            const latitude = $('#shop_latitude').val();
            const longitude = $('#shop_longitude').val();
            
            console.log('=== SUBMIT HANDLER ===');
            console.log('Full Address:', fullAddress);
            console.log('Latitude:', latitude);
            console.log('Longitude:', longitude);
            console.log('Province val:', $('#province').val());
            console.log('District val:', $('#district').val());
            console.log('Ward val:', $('#ward').val());
            console.log('Detail address:', $('input[name="detail_address"]').val());
            
            if (!fullAddress) {
                alert('Vui lòng chọn đầy đủ địa chỉ shop (tỉnh, quận/huyện, phường/xã và địa chỉ chi tiết)');
                return false;
            }
            
            if (!latitude || !longitude) {
                alert('Không thể xác định tọa độ cho địa chỉ shop. Vui lòng chọn lại địa chỉ.');
                return false;
            }
            
            // Hiển thị thông tin cuối cùng
            console.log('✅ Địa chỉ shop cuối cùng:', fullAddress);
            console.log('✅ Tọa độ shop:', latitude, longitude);
            
            $(form).submit();
        }
    
    });
    </script>
    
    <!-- Script xử lý địa chỉ shop sử dụng API provinces.open-api.vn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    // Test jQuery và các elements
    $(document).ready(function() {
        console.log('=== JQUERY TEST ===');
        console.log('jQuery version:', $.fn.jquery);
        console.log('Province element exists:', $('#province').length > 0);
        console.log('District element exists:', $('#district').length > 0);
        console.log('Ward element exists:', $('#ward').length > 0);
        console.log('Detail address element exists:', $('input[name="detail_address"]').length > 0);
        
        // Test click event
        $('#province').on('click', function() {
            console.log('🖱️ Province clicked');
        });
        
        $('#district').on('click', function() {
            console.log('🖱️ District clicked');
        });
        
        $('#ward').on('click', function() {
            console.log('🖱️ Ward clicked');
        });
    });
    </script>
    <script>
    $(document).ready(function() {
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
    
    // Test API trước
    console.log('=== API TEST ===');
    axios.get('https://provinces.open-api.vn/api/?depth=1')
        .then((response) => {
            console.log('✅ API Test successful:', response.data.length, 'provinces');
            renderData(response.data, "province");
            
            // Test chọn một tỉnh để debug
            setTimeout(() => {
                const provinceSelect = document.querySelector('#province');
                if (provinceSelect && provinceSelect.options.length > 1) {
                    // Tìm Vĩnh Long
                    for (let i = 0; i < provinceSelect.options.length; i++) {
                        if (provinceSelect.options[i].text.includes('Vĩnh Long')) {
                            provinceSelect.selectedIndex = i;
                            console.log('🔧 Auto-selected Vĩnh Long for testing');
                            $(provinceSelect).trigger('change');
                            break;
                        }
                    }
                }
            }, 1000);
        })
        .catch((error) => {
            console.error('❌ API Test failed:', error);
        });
    
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
        console.log(`🔄 Rendering data for ${select}:`, array.length, 'items');
        
        if (select == "province") {
            let row = ' <option  disable value="">Chọn Tỉnh/Thành Phố</option>';
            array.forEach(element => {
                row += `<option value="${element.code}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row;
            console.log(`✅ Province options loaded: ${array.length} items`);
            
            // Force UI update
            $(`#${select}`).trigger('change');
        }
        if (select == "district") {
            let row = ' <option disable value="">Chọn Quận/Huyện</option>';
            array.forEach(element => {
                row += `<option  value="${element.code}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row;
            console.log(`✅ District options loaded: ${array.length} items`);
            
            // Force UI update
            $(`#${select}`).trigger('change');
        }
        if (select == "ward") {
            let row = ' <option disable value="">Chọn Phường/Xã</option>';
            array.forEach(element => {
                row += `<option  value="${element.code}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row;
            console.log(`✅ Ward options loaded: ${array.length} items`);
            
            // Force UI update
            $(`#${select}`).trigger('change');
        }
    }

    $("#province").change(() => {
        const selectedText = $('#province option:selected').text();
        const selectedValue = $('#province').val();
        console.log('🔄 Province changed:');
        console.log('  - Selected text:', selectedText);
        console.log('  - Selected value:', selectedValue);
        console.log('  - Select element:', $('#province')[0]);
        
        callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
        printResult();
        updateShopAddress(); // Thêm cập nhật địa chỉ shop
        
        // Trigger validation để cập nhật trạng thái
        setTimeout(() => {
            $("#province").valid();
        }, 100);
    });
    
    $("#district").change(() => {
        const selectedText = $('#district option:selected').text();
        const selectedValue = $('#district').val();
        console.log('🔄 District changed:');
        console.log('  - Selected text:', selectedText);
        console.log('  - Selected value:', selectedValue);
        console.log('  - Select element:', $('#district')[0]);
        
        callApiWard(host + "d/" + $("#district").val() + "?depth=2");
        printResult();
        updateShopAddress(); // Thêm cập nhật địa chỉ shop
        
        // Trigger validation để cập nhật trạng thái
        setTimeout(() => {
            $("#district").valid();
        }, 100);
    });
    
    $("#ward").change(() => {
        const selectedText = $('#ward option:selected').text();
        const selectedValue = $('#ward').val();
        console.log('🔄 Ward changed:');
        console.log('  - Selected text:', selectedText);
        console.log('  - Selected value:', selectedValue);
        console.log('  - Select element:', $('#ward')[0]);
        
        printResult();
        updateShopAddress(); // Thêm cập nhật địa chỉ shop
        
        // Trigger validation để cập nhật trạng thái
        setTimeout(() => {
            $("#ward").valid();
        }, 100);
    });

    var printResult = () => {
        console.log('🔄 printResult called');
        console.log('Province val:', $("#province").val());
        console.log('District val:', $("#district").val());
        console.log('Ward val:', $("#ward").val());
        
        if ($("#district").val() != "" && $("#province").val() != "" &&
            $("#ward").val() != "") {
            let result = $("#province option:selected").text() +
                " - " + $("#district option:selected").text() + " - " +
                $("#ward option:selected").text() + " -  ";

            console.log('✅ Full address result:', result);
            
            let address = `<option  value="${result}">${result}</option>` ;
            document.querySelector("#address").innerHTML = address;
            
            console.log('✅ Address field updated');
            
            // Cập nhật địa chỉ đầy đủ cho shop
            updateShopAddress();
        } else {
            console.log('❌ Missing required fields for printResult');
        }
    }

    // Hàm cập nhật địa chỉ shop
    function updateShopAddress() {
        const province = $('#province option:selected').text();
        const district = $('#district option:selected').text();
        const ward = $('#ward option:selected').text();
        const detailAddress = $('input[name="detail_address"]').val();
        
        console.log('=== Cập nhật địa chỉ shop ===');
        console.log('Province:', province);
        console.log('District:', district);
        console.log('Ward:', ward);
        console.log('Detail Address:', detailAddress);
        
        // Kiểm tra điều kiện
        const hasProvince = province && province !== 'Chọn Tỉnh/Thành Phố';
        const hasDistrict = district && district !== 'Chọn Quận/Huyện';
        const hasWard = ward && ward !== 'Chọn Phường/Xã';
        const hasDetailAddress = detailAddress && detailAddress.trim() !== '';
        
        console.log('Has Province:', hasProvince);
        console.log('Has District:', hasDistrict);
        console.log('Has Ward:', hasWard);
        console.log('Has Detail Address:', hasDetailAddress);
        
        if (hasProvince && hasDistrict && hasWard && hasDetailAddress) {
            const fullAddress = `${detailAddress.trim()}, ${ward}, ${district}, ${province}`;
            $('#shop_full_address').val(fullAddress);
            
            // Tính tọa độ dựa trên tỉnh
            console.log('🔍 Tìm tọa độ cho tỉnh:', province);
            const coordinates = getCoordinatesByProvince(province);
            if (coordinates) {
                $('#shop_latitude').val(coordinates.lat);
                $('#shop_longitude').val(coordinates.lng);
                
                // Cập nhật debug info
                $('#debug-address').text(`Địa chỉ: ${fullAddress}`);
                $('#debug-coordinates').text(`Tọa độ: ${coordinates.lat}, ${coordinates.lng}`);
                
                console.log('✅ Địa chỉ shop đã cập nhật:', fullAddress);
                console.log('✅ Tọa độ:', coordinates);
            } else {
                console.log('❌ Không tìm thấy tọa độ cho tỉnh:', province);
                console.log('🔍 Thử tìm với tên khác...');
                
                // Thử tìm với tên khác
                let foundCoordinates = null;
                if (province.includes('Vĩnh Long')) {
                    foundCoordinates = {lat: 10.2401, lng: 105.9572};
                } else if (province.includes('Hà Nội')) {
                    foundCoordinates = {lat: 21.0285, lng: 105.8542};
                } else if (province.includes('TP. Hồ Chí Minh') || province.includes('Hồ Chí Minh')) {
                    foundCoordinates = {lat: 10.8231, lng: 106.6297};
                }
                
                if (foundCoordinates) {
                    $('#shop_latitude').val(foundCoordinates.lat);
                    $('#shop_longitude').val(foundCoordinates.lng);
                    
                    // Cập nhật debug info
                    $('#debug-address').text(`Địa chỉ: ${fullAddress}`);
                    $('#debug-coordinates').text(`Tọa độ: ${foundCoordinates.lat}, ${foundCoordinates.lng} (Fallback)`);
                    
                    console.log('✅ Tìm thấy tọa độ fallback:', foundCoordinates);
                } else {
                    // Cập nhật debug info với lỗi
                    $('#debug-address').text(`Địa chỉ: ${fullAddress}`);
                    $('#debug-coordinates').text('❌ Không tìm thấy tọa độ');
                    
                    console.log('❌ Không tìm thấy tọa độ fallback');
                }
            }
        } else {
            // Xóa địa chỉ nếu chưa đầy đủ
            $('#shop_full_address').val('');
            $('#shop_latitude').val('');
            $('#shop_longitude').val('');
            
            // Cập nhật debug info
            $('#debug-address').text('Địa chỉ: Chưa đầy đủ thông tin');
            $('#debug-coordinates').text('Tọa độ: Chưa có');
            
            console.log('❌ Chưa đầy đủ thông tin địa chỉ');
        }
    }

    // Hàm tính tọa độ dựa trên tỉnh
    function getCoordinatesByProvince(provinceName) {
        console.log('🔍 getCoordinatesByProvince called with:', provinceName);
        
        const coordinates = {
            'Hà Nội': {lat: 21.0285, lng: 105.8542},
            'TP. Hồ Chí Minh': {lat: 10.8231, lng: 106.6297},
            'Đà Nẵng': {lat: 16.0544, lng: 108.2022},
            'Hải Phòng': {lat: 20.8449, lng: 106.6881},
            'Cần Thơ': {lat: 10.0452, lng: 105.7469},
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
            'Vĩnh Long': {lat: 10.2401, lng: 105.9572},
            'Tỉnh Vĩnh Long': {lat: 10.2401, lng: 105.9572},
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
        
        const result = coordinates[provinceName] || null;
        console.log('🔍 getCoordinatesByProvince result:', result);
        
        if (!result) {
            console.log('🔍 Available provinces:', Object.keys(coordinates));
        }
        
        return result;
    }

    // Lắng nghe sự kiện thay đổi địa chỉ chi tiết
    $(document).ready(function() {
        $('input[name="detail_address"]').on('input', function() {
            console.log('🔄 Detail address changed:', $(this).val());
            updateShopAddress();
        });
        
        // Thêm function để kiểm tra trạng thái form
        window.checkFormStatus = function() {
            console.log('=== FORM STATUS CHECK ===');
            console.log('Province element exists:', $('#province').length > 0);
            console.log('District element exists:', $('#district').length > 0);
            console.log('Ward element exists:', $('#ward').length > 0);
            console.log('Detail address element exists:', $('input[name="detail_address"]').length > 0);
            console.log('Province value:', $('#province').val());
            console.log('District value:', $('#district').val());
            console.log('Ward value:', $('#ward').val());
            console.log('Detail address value:', $('input[name="detail_address"]').val());
            console.log('Shop full address:', $('#shop_full_address').val());
            console.log('Shop latitude:', $('#shop_latitude').val());
            console.log('Shop longitude:', $('#shop_longitude').val());
        };
        
        // Gọi function kiểm tra sau 2 giây
        setTimeout(checkFormStatus, 2000);
        
        // Test select functionality
        setTimeout(() => {
            console.log('=== SELECT TEST ===');
            const provinceSelect = document.querySelector('#province');
            if (provinceSelect) {
                console.log('Province select found, options:', provinceSelect.options.length);
                console.log('Province select disabled:', provinceSelect.disabled);
                console.log('Province select readonly:', provinceSelect.readOnly);
                
                // Test programmatic selection
                if (provinceSelect.options.length > 1) {
                    provinceSelect.selectedIndex = 1;
                    console.log('✅ Programmatically selected province:', provinceSelect.options[1].text);
                    $(provinceSelect).trigger('change');
                }
            } else {
                console.log('❌ Province select not found');
            }
        }, 3000);
        
        // Thêm function để force refresh UI
        window.forceRefreshSelect = function(selectId) {
            const select = document.querySelector(`#${selectId}`);
            if (select) {
                console.log(`🔄 Force refreshing ${selectId}`);
                const currentValue = select.value;
                const currentIndex = select.selectedIndex;
                
                // Force re-render
                select.style.display = 'none';
                select.offsetHeight; // Trigger reflow
                select.style.display = 'block';
                
                // Restore selection
                select.value = currentValue;
                select.selectedIndex = currentIndex;
                
                // Trigger events
                $(select).trigger('change');
                $(select).trigger('input');
                
                console.log(`✅ ${selectId} refreshed, value:`, currentValue);
            }
        };
        
        // Thêm function để debug select display
        window.debugSelectDisplay = function(selectId) {
            const select = document.querySelector(`#${selectId}`);
            if (select) {
                console.log(`=== DEBUG ${selectId.toUpperCase()} DISPLAY ===`);
                console.log('Select element:', select);
                console.log('Selected index:', select.selectedIndex);
                console.log('Selected value:', select.value);
                console.log('Selected text:', select.options[select.selectedIndex]?.text);
                console.log('All options:', Array.from(select.options).map(opt => ({value: opt.value, text: opt.text})));
                console.log('Select innerHTML:', select.innerHTML);
                console.log('Select style:', window.getComputedStyle(select));
                
                // Test manual selection
                if (select.options.length > 1) {
                    select.selectedIndex = 1;
                    console.log('🔧 Manually set selectedIndex to 1');
                    console.log('New selected text:', select.options[1].text);
                    console.log('New selected value:', select.value);
                }
            }
        };
    });
    </script>
</body>

</html>