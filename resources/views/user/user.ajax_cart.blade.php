<!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- include jQuery validate library -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- include Ajax  library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
$(document).ready(function() {
    $('#apply_coupon_cart').click(function() {
        // Lấy mã từ ô nhập hoặc dropdown
        let code = $('#input_coupon_cart').val() || $('.choose_coupon_cart').val();
        let total_price = $(this).data('total_price');

        $.ajax({
            url: '{{ route("choose_coupon") }}',
            method: 'GET',
            data: {
                coupon_code: code,
                total_price: total_price
            },
            success: function(res) {
                if (res.status) {
                    // Hiển thị nội dung mã giảm giá đã áp dụng
                    $('.coupon_number_display').html(res.html);
                    // Cập nhật lại giá tổng cộng sau khi giảm
                    $('.cart-table-right-bot-price-new span').text(res.total_price_display);
                    // Thông báo thành công
                    swal("Thành công", res.message, "success");
                    // Ẩn modal
                    $('#cartCouponModal').modal('hide');
                } else {
                    // Nếu lỗi: hiển thị thông báo
                    swal("Lỗi", res.message, "error");
                }
            },
            error: function() {
                swal("Lỗi", "Có lỗi khi gửi yêu cầu đến server", "error");
            }
        });
    });
});
</script>
