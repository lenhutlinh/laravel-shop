<!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- include Ajax  library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- include jQuery validate library -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>


<script>
$("#form-detail").validate({
    rules: {
        "combination": {
            required: true,
	    },
    },
    messages:{
        "combination": {
            required: "Bạn phải chọn phân loại trước khi thêm vào giỏ hàng",
        },
    },
    submitHandler: function(form) {
        $(form).submit();
    }

});
</script>

<script>
    $(document).ready(function(){
        $('.choose_variation').on('click',function(){
            var avaiable_stock = $(this).attr('data-avai_stock');
            $('.show_avaiable').html(avaiable_stock.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' sản phẩm có sẵn');
        });
    })
</script>
<script>
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
            var id = $(this).data('id_product');
            var product_id = $('.product_id_' + id).val();
            var shop_id = $('.shop_id_' + id).val();
            var productName = $('.productName' + id).val();
            var previewImage = $('.previewImage' + id).val();
            var price = $('.price' + id).val();
            var quantity = $('.quantity' + id).val();
            var combination = $("input[type='radio'][name='combination']:checked").val();
            var avaiable_stock = $("input[type='radio'][name='combination']:checked").attr('data-avai_stock');
            var combination_id = $("input[type='radio'][name='combination']:checked").attr('data-combi_id');

            var _token = $('input[name="_token"]').val();
            if (typeof combination === 'undefined') {
                swal("Thất bại!", "Bạn phải chọn phân loại hàng", "error");
            }
            $.ajax({
                url: '{{route('add_cart_ajax')}}',
                method: 'POST',
                data:{
                    id_: product_id,
                    shop_id: shop_id,
                    productName: productName,
                    previewImage: previewImage,
                    price: price,
                    quantity: quantity,
                    combination: combination,
                    avaiable_stock:avaiable_stock,
                    combination_id:combination_id,
                    _token: _token,
                },error: function(data){
                    var errors = data.responseJSON;
                    console.log(errors);
                },
                success: function(data){
                    $status = data.status;
                    $message = data.message;
                    $count_cart = data.count_cart;
                    //console.log($count_cart);
                    if($status == true){
                        swal({
                            title: "Thêm vào giỏ hàng thành công",
                            text: "Bạn có muốn xem giỏ hàng không?",
                            icon: "success",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location.href = '{{route('show_cart_ajax') }}';
                            } 
                            
                        });
                        $('#count').html($count_cart);
                    }
                    else{
                        swal("Thất bại!", $message, "error");
                    }
                    if (parseInt(quantity)  > parseInt(avaiable_stock)){
                        swal("Thất bại!", "Số lượng sản phẩm trong kho không đủ", "error");
                    }
                    
                    if(quantity <= 0){
                        swal("Thất bại!", "Số lượng sản phẩm không hợp lệ!", "error");
                    }
                    if(avaiable_stock <= 0){
                        swal({
                            title: "Thất bại!",
                            text: "Sản phẩm này đã hết hàng. Vui lòng chọn sản phẩm khác!",
                            icon: "error",
                            
                        })
                    }
                }
            });
        });
    });
</script>
<!-- <script>

</script> -->
<script>
    $(document).ready(function(){
        $('#buy_now').click(function(){
            var id = $(this).data('id_product');
            var product_id = $('.product_id_' + id).val();
            var shop_id = $('.shop_id_' + id).val();
            var productName = $('.productName' + id).val();
            var previewImage = $('.previewImage' + id).val();
            var price = $('.price' + id).val();
            var quantity = $('.quantity' + id).val();
            var combination = $("input[type='radio'][name='combination']:checked").val();
            var avaiable_stock = $("input[type='radio'][name='combination']:checked").attr('data-avai_stock');
            var combination_id = $("input[type='radio'][name='combination']:checked").attr('data-combi_id');

            var _token = $('input[name="_token"]').val();
            // console.log(quantity);
            console.log(combination_id);

            if (typeof combination === 'undefined') {
                swal("Thất bại!", "Bạn phải chọn phân loại hàng", "error");
                return false;
            }
            if (quantity <= 0) {
                swal("Thất bại!", "Số lượng sản phẩm không hợp lệ!", "error");
                return false;
            }
            if(parseInt(quantity)  > parseInt(avaiable_stock)){
                swal("Thất bại!", "Số lượng sản phẩm trong kho không đủ", "error");
                return false;
            }
            $.ajax({
                url: '{{route('buy_now_ajax')}}',
                method: 'GET',
                data:{
                    product_id: product_id,
                    shop_id: shop_id,
                    productName: productName,
                    previewImage: previewImage,
                    price: price,
                    quantity: quantity,
                    combination: combination,
                    avaiable_stock:avaiable_stock,
                    combination_id:combination_id,
                    _token: _token,
                },error: function(data){
                    var errors = data.responseJSON;
                    console.log(errors);
                },
                success: function(data){
                    $status = data.status;

                    if($status == true){
                        swal({
                            title: "Chuyển đến trang đặt hàng ngay",
                            icon: "success",
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location.href = '{{route('checkout_now') }}';
                            } 
                            
                        });
                    }
                    else{
                        swal("Thất bại!", $message, "error");
                    }
                    if (parseInt(quantity)  > parseInt(avaiable_stock)){
                        swal("Thất bại!", "Số lượng sản phẩm trong kho không đủ", "error");
                    }
                    
                    if(quantity <= 0){
                        swal("Thất bại!", "Số lượng sản phẩm không hợp lệ!", "error");
                    }
                    if(avaiable_stock <= 0){
                        swal({
                            title: "Thất bại!",
                            text: "Sản phẩm này đã hết hàng. Vui lòng chọn sản phẩm khác!",
                            icon: "error",
                            
                        })
                    }
                }
                
            });
        });
    });
</script>
<script>
    const plus = document.querySelector('#plus');
    const minus = document.querySelector('#minus');
    const number = document.querySelector('#number');
    var a = 1;
    plus.addEventListener('click', () => {
        a++;
        number.value = a;
    });
    minus.addEventListener('click', () => {
        if(a > 1){
            a--;
            number.value = a;
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#number').keypress(function(event) {
            if (event.keyCode === 13) { // Kiểm tra nếu phím nhấn là Enter
                event.preventDefault(); // Ngăn chặn hành động mặc định của Enter (làm mới trang)
                // Thêm mã xử lý khác nếu cần
            }
        });
    });
</script>

<script>
    // Rating Filter Functionality
    $(document).ready(function(){
        // Handle filter button clicks
        $('.filter-btn').on('click', function(){
            var selectedRating = $(this).data('rating');
            
            // Update active button
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');
            
            // Filter ratings
            if(selectedRating === 'all') {
                $('.rating-item').show();
            } else {
                $('.rating-item').hide();
                $('.rating-item[data-rating="' + selectedRating + '"]').show();
            }
            
            // Update count display
            var visibleCount = $('.rating-item:visible').length;
            updateFilterCounts(selectedRating, visibleCount);
        });
        
        // Function to update filter counts
        function updateFilterCounts(selectedRating, visibleCount) {
            if(selectedRating === 'all') {
                $('.filter-btn[data-rating="all"] .count').text(visibleCount);
            } else {
                $('.filter-btn[data-rating="' + selectedRating + '"] .count').text(visibleCount);
            }
        }
        
        // Initialize with all ratings visible
        var totalRatings = $('.rating-item').length;
        $('.filter-btn[data-rating="all"] .count').text(totalRatings);
    });
    
    // Image Modal Functions
    function openImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
    
    function closeImageModal() {
        document.getElementById('imageModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore scrolling
    }
    
    // Close modal when clicking outside the image
    window.onclick = function(event) {
        var modal = document.getElementById('imageModal');
        if (event.target == modal) {
            closeImageModal();
        }
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeImageModal();
        }
    });
</script>
