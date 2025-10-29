 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- include jQuery validate library -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- include Ajax  library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- include jQuery validate library -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

<script>
$("#form-checkout").validate({
    rules: {
		"ship_name": {
			required: true,
            minlength: 8,
		},
        "ship_phonenumber": {
            required: true,
            number: true,
            maxlength: 10,
            minlength: 10,

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
        },
        "ship_email": {
            email: true,
        },
    },
    messages:{
        "ship_name": {
            required: "Vui lòng nhập tên người nhận",
            minlength: "Không thể ít hơn 8 ký tự"
        },
        "ship_phonenumber": {
            required: "Vui lòng nhập số điện thoại",
            number: "Số điện thoại không hợp lệ",
            phoneVN: "Số điện thoại không hợp lệ",
            maxlength: "Số điện thoại không hợp lệ",
            minlength: "Số điện thoại không hợp lệ",
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
            required: "Vui lòng nhập địa chỉ",
        },
        "ship_email": {
            email: "Email không hợp lệ",
        },
    },
    submitHandler: function(form) {
        $(form).submit();
    }

});
</script>

<script>

    const host = "https://provinces.open-api.vn/api/";
    var callAPI = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data, "province");
            });
    }
    callAPI('https://provinces.open-api.vn/api/?depth=1');
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
            document.querySelector("#" + select).innerHTML = row
        }
        if (select == "district") {
            let row = ' <option disable value="">Chọn Quận/Huyện</option>';
            array.forEach(element => {
                row += `<option  value="${element.code}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }
        if (select == "ward") {
            let row = ' <option disable value="">Chọn Phường/Xã</option>';
            array.forEach(element => {
                row += `<option  value="${element.code}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }
        
        // // let row = ' <option disable value="">Chọn </option>';
        // array.forEach(element => {
        //     row += `<option  value="${element.code}">${element.name}</option>`
        // });
        // document.querySelector("#" + select).innerHTML = row
    }

    $("#province").change(() => {
        callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
        printResult();
        // Gọi tính phí ship khi thay đổi tỉnh
        console.log('🚚 Province changed, calling calculateShipping...');
        setTimeout(() => {
            if (typeof window.calculateShipping === 'function') {
                console.log('🚚 Gọi calculateShipping từ province change...');
                window.calculateShipping();
            } else {
                console.log('❌ calculateShipping function không tồn tại!');
            }
        }, 500);
    });
    $("#district").change(() => {
        callApiWard(host + "d/" + $("#district").val() + "?depth=2");
        printResult();
        // Gọi tính phí ship khi thay đổi huyện
        console.log('🚚 District changed, calling calculateShipping...');
        setTimeout(() => {
            if (typeof window.calculateShipping === 'function') {
                console.log('🚚 Gọi calculateShipping từ province change...');
                window.calculateShipping();
            } else {
                console.log('❌ calculateShipping function không tồn tại!');
            }
        }, 500);
    });
    $("#ward").change(() => {
        printResult();
        // Gọi tính phí ship khi thay đổi xã
        console.log('🚚 Ward changed, calling calculateShipping...');
        setTimeout(() => {
            if (typeof window.calculateShipping === 'function') {
                console.log('🚚 Gọi calculateShipping từ province change...');
                window.calculateShipping();
            } else {
                console.log('❌ calculateShipping function không tồn tại!');
            }
        }, 500);
    })

    var printResult = () => {
        if ($("#district").val() != "" && $("#province").val() != "" &&
            $("#ward").val() != "") {
            let result = $("#province option:selected").text() +
                " - " + $("#district option:selected").text() + " - " +
                $("#ward option:selected").text() + " -  ";

            let address = `<option  value="${result}">${result}</option>` ;
            document.querySelector("#address").innerHTML = address
            
            // Gọi tính phí ship khi có đầy đủ thông tin địa chỉ
            console.log('🚚 printResult: Full address available, calling calculateShipping...');
            setTimeout(() => {
                if (typeof window.calculateShipping === 'function') {
                    console.log('🚚 Gọi calculateShipping từ printResult...');
                    window.calculateShipping();
                } else {
                    console.log('❌ calculateShipping function không tồn tại!');
                }
            }, 500);
        }

    }
    
    // Thêm sự kiện cho input địa chỉ chi tiết
    $(document).ready(function() {
        // Đợi một chút để đảm bảo calculateShipping đã được định nghĩa
        setTimeout(function() {
            $('input[name="detail_address"]').on('input', function() {
                console.log('🚚 Gọi calculateShipping từ detail address input...');
                if (typeof window.calculateShipping === 'function') {
                    window.calculateShipping();
                } else {
                    console.log('❌ calculateShipping function không tồn tại!');
                }
            });
        }, 1000);
    });
</script>

<script>
    $(document).ready(function() {
        $('#table-right-info-coupon-choice').click(function() {
            $('#logoutModal').show();
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.choose_coupon_now').change(function(){
            var coupon_code = $(this).val();
            var total_price = $(this).data('total_price');
            // Sử dụng phí ship động thay vì cố định 30,000đ
            if (typeof window.currentShippingCost !== 'undefined') {
                total_price = total_price - window.currentShippingCost;
            } else {
                total_price = total_price - 30000; // Fallback
            }
            console.log(total_price);
            var _token = $('input[name="_token"]').val();
            if (coupon_code != "") {
                $.ajax({
                        url: '{{route('choose_coupon_now')}}',
                        method: 'GET',
                        data:{
                            coupon_code: coupon_code,
                            total_price: total_price,
                            shipping_cost: window.currentShippingCost || 30000,
                            _token: _token,
                        },error(data) {
        
                        },
                        success: function(data){
                            $status = data.status;
                            $html = data.html;
                            $total_price_display = data.total_price_display;
                            $message = data.message;

                            if($status == true){
                                $('.coupon_number_display').html($html);
                                $('.table-right-info-totalPrice').html($total_price_display);
                                // Gọi hàm cập nhật tổng tiền
                                if (typeof window.refreshTotalPrice === 'function') {
                                    window.refreshTotalPrice();
                                }
                            }
                            else{ 
                                swal("Thất bại!", $message, "error");
                              
                            }
                        }
                });
            }
            else{
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.choose_coupon').change(function(){
            var coupon_code = $(this).val();
            var total_price = $(this).data('total_price');
            // Sử dụng phí ship động thay vì cố định 30,000đ
            if (typeof window.currentShippingCost !== 'undefined') {
                total_price = total_price - window.currentShippingCost;
            } else {
                total_price = total_price - 30000; // Fallback
            }
            console.log(total_price);
            var _token = $('input[name="_token"]').val();
            if (coupon_code != "") {
                $.ajax({
                        url: '{{route('choose_coupon')}}',
                        method: 'GET',
                        data:{
                            coupon_code: coupon_code,
                            total_price: total_price,
                            shipping_cost: window.currentShippingCost || 30000,
                            _token: _token,
                        },error(data) {
        
                        },
                        success: function(data){
                            $status = data.status;
                            $html = data.html;
                            $total_price_display = data.total_price_display;
                            $message = data.message;

                            if($status == true){
                                $('.coupon_number_display').html($html);
                                $('.table-right-info-totalPrice').html($total_price_display);
                                // Gọi hàm cập nhật tổng tiền
                                if (typeof window.refreshTotalPrice === 'function') {
                                    window.refreshTotalPrice();
                                }
                            }
                            else{ 
                                swal("Thất bại!", $message, "error");
                              
                            }
                        }
                });
            }
            else{
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#import_coupon_now').click(function(){
            var coupon_code = $('input[name="input_coupon"]').val()
            var total_price = $(this).data('total_price');
            // total_price là giá sản phẩm gốc, không cần trừ shipping cost
            console.log(coupon_code);
            var _token = $('input[name="_token"]').val();
            if (coupon_code != "") {
                $.ajax({
                        url: '{{route('choose_coupon_now')}}',
                        method: 'GET',
                        data:{
                            coupon_code: coupon_code,
                            total_price: total_price,
                            shipping_cost: window.currentShippingCost || 30000,
                            _token: _token,
                        },error(data) {
        
                        },
                        success: function(data){
                            $status = data.status;
                            $html = data.html;
                            $total_price_display = data.total_price_display;
                            $message = data.message;
                            if($status == true){
                                $('.coupon_number_display').html($html);
                                $('.table-right-info-totalPrice').html($total_price_display);
                                
                            }
                            else{ 
                                swal("Thất bại!", $message, "error");
                                

                            }
                        }
                });
            }
            else{
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#import_coupon').click(function(){
            var coupon_code = $('input[name="input_coupon"]').val()
            var total_price = $(this).data('total_price');
            // Sử dụng phí ship động thay vì cố định 30,000đ
            if (typeof window.currentShippingCost !== 'undefined') {
                total_price = total_price - window.currentShippingCost;
            } else {
                total_price = total_price - 30000; // Fallback
            }
            console.log(coupon_code);
            var _token = $('input[name="_token"]').val();
            if (coupon_code != "") {
                $.ajax({
                        url: '{{route('choose_coupon')}}',
                        method: 'GET',
                        data:{
                            coupon_code: coupon_code,
                            total_price: total_price,
                            shipping_cost: window.currentShippingCost || 30000,
                            _token: _token,
                        },error(data) {
        
                        },
                        success: function(data){
                            $status = data.status;
                            $html = data.html;
                            $total_price_display = data.total_price_display;
                            $message = data.message;
                            if($status == true){
                                $('.coupon_number_display').html($html);
                                $('.table-right-info-totalPrice').html($total_price_display);
                                
                            }
                            else{ 
                                swal("Thất bại!", $message, "error");
                                

                            }
                        }
                });
            }
            else{
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#input_coupon').keypress(function(event) {
            if (event.keyCode === 13) { // Kiểm tra nếu phím nhấn là Enter
                event.preventDefault(); // Ngăn chặn hành động mặc định của Enter (làm mới trang)
                // Thêm mã xử lý khác nếu cần
            }
        });
    });
</script>

