// JavaScript xử lý mã giảm giá kép
$(document).ready(function(){
    // Biến lưu trữ mã giảm giá đã áp dụng
    let appliedCoupons = {
        common: null,
        private: null
    };
    
    // Xử lý chọn mã giảm giá chung
    $('#common_coupon').change(function(){
        var coupon_code = $(this).val();
        var total_price = $(this).data('total_price');
        var _token = $('input[name="_token"]').val();
        
        if (coupon_code != "") {
            $.ajax({
                url: window.routes.choose_coupon,
                method: 'GET',
                data:{
                    coupon_code: coupon_code,
                    total_price: total_price,
                    shipping_cost: window.currentShippingCost || 30000,
                    _token: _token,
                },
                success: function(data){
                    if(data.status == true){
                        appliedCoupons.common = {
                            code: coupon_code,
                            discount: data.discount || 0,
                            name: data.coupon_name || coupon_code
                        };
                        updateCouponDisplay();
                        updateTotalPrice();
                    } else {
                        swal("Thất bại!", data.message, "error");
                    }
                }
            });
        } else {
            appliedCoupons.common = null;
            updateCouponDisplay();
            updateTotalPrice();
        }
    });
    
    // Xử lý áp dụng mã giảm giá riêng
    $('#apply_private_coupon').click(function(){
        var coupon_code = $('#input_private_coupon').val().trim();
        var total_price = $(this).data('total_price');
        var _token = $('input[name="_token"]').val();
        
        if (coupon_code != "") {
            $.ajax({
                url: window.routes.private_coupons_check,
                method: 'POST',
                data:{
                    code: coupon_code,
                    order_amount: total_price,
                    _token: _token,
                },
                success: function(data){
                    if(data.status == true){
                        appliedCoupons.private = {
                            code: coupon_code,
                            discount: data.discount,
                            name: data.coupon.name
                        };
                        updateCouponDisplay();
                        updateTotalPrice();
                        $('#input_private_coupon').val('');
                        swal("Thành công!", data.message, "success");
                    } else {
                        swal("Thất bại!", data.message, "error");
                    }
                },
                error: function(){
                    swal("Lỗi!", "Có lỗi xảy ra khi kiểm tra mã giảm giá", "error");
                }
            });
        } else {
            swal("Cảnh báo!", "Vui lòng nhập mã giảm giá", "warning");
        }
    });
    
    // Cập nhật hiển thị mã giảm giá
    function updateCouponDisplay() {
        let html = '';
        let totalDiscount = 0;
        
        if (appliedCoupons.common) {
            html += `<div class="applied-coupon-item mb-2">
                <span class="badge badge-primary">Mã chung: ${appliedCoupons.common.name}</span>
                <span class="text-success">-${formatNumber(appliedCoupons.common.discount)}đ</span>
                <button class="btn btn-sm btn-outline-danger ml-2" onclick="removeCommonCoupon()">×</button>
            </div>`;
            totalDiscount += appliedCoupons.common.discount;
        }
        
        if (appliedCoupons.private) {
            html += `<div class="applied-coupon-item mb-2">
                <span class="badge badge-success">Mã riêng: ${appliedCoupons.private.name}</span>
                <span class="text-success">-${formatNumber(appliedCoupons.private.discount)}đ</span>
                <button class="btn btn-sm btn-outline-danger ml-2" onclick="removePrivateCoupon()">×</button>
            </div>`;
            totalDiscount += appliedCoupons.private.discount;
        }
        
        if (totalDiscount > 0) {
            html += `<div class="total-discount mt-2">
                <strong class="text-success">Tổng giảm: -${formatNumber(totalDiscount)}đ</strong>
            </div>`;
        }
        
        $('#applied_coupons').html(html);
        $('.coupon_number_display').html(html);
    }
    
    // Cập nhật tổng tiền
    function updateTotalPrice() {
        let totalDiscount = 0;
        if (appliedCoupons.common) totalDiscount += appliedCoupons.common.discount;
        if (appliedCoupons.private) totalDiscount += appliedCoupons.private.discount;
        
        let productPrice = window.totalPrice || 0;
        let shippingCost = window.currentShippingCost || 30000;
        let finalTotal = productPrice + shippingCost - totalDiscount;
        
        $('.table-right-info-totalPrice').html(formatNumber(finalTotal) + 'đ');
        
        // Cập nhật session nếu cần
        if (typeof window.refreshTotalPrice === 'function') {
            window.refreshTotalPrice();
        }
    }
    
    // Hàm xóa mã giảm giá chung
    window.removeCommonCoupon = function() {
        appliedCoupons.common = null;
        $('#common_coupon').val('');
        updateCouponDisplay();
        updateTotalPrice();
    };
    
    // Hàm xóa mã giảm giá riêng
    window.removePrivateCoupon = function() {
        appliedCoupons.private = null;
        updateCouponDisplay();
        updateTotalPrice();
    };
    
    // Hàm format số
    function formatNumber(num) {
        return new Intl.NumberFormat('vi-VN').format(num);
    }
    
    // Xử lý Enter trong input private coupon
    $('#input_private_coupon').keypress(function(event) {
        if (event.which === 13) {
            $('#apply_private_coupon').click();
        }
    });
});
