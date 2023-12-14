<!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- include jQuery validate library -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- include Ajax  library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- <script>
$("#cart-form").validate({
    rules: {
        "choice-shop": {
            required: true,
	    },
    },
    messages:{
        "choice-shop": {
            required: "Bạn phải chọn cửa hàng muốn mua trước khi đặt hàng",
        },
    },
    submitHandler: function(form) {
        $(form).submit();
    }

});
</script> -->

<script>
    $(document).ready(function(){
        $('.choose_shop_cart').click(function(){
            var shop_id = $(this).data('shop_id');
            var _token = $('input[name="_token"]').val();
            console.log(shop_id);
            
            $.ajax({
                    url: '<?php echo e(route('choose_shop')); ?>',
                    method: 'GET',
                    data:{
                        shop_id: shop_id,
                        _token: _token,
                    },error(data) {
    
                    },
                    success: function(data){
                        $status = data.status;
                        $count_price = data.count_price;
                        if($status == true){
                            $('#cart-table-right-bot-price-new').html($count_price);
                        }
                        else{
                          
                        }
                    }
                });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.number_cart').keyup (function(){
            var id = $(this).data('id_cart');
            var number = $(this).val(); 
            var avai_stock = $(this).data('avai_stock');
            var _token = $('input[name="_token"]').val();
            console.log(id);
            
            $.ajax({
                    url: '<?php echo e(route('update_cart_ajax')); ?>',
                    method: 'POST',
                    data:{
                        id: id,
                        quantity: number,
                        avaiable_stock: avai_stock,
                        _token: _token,
                    },error(data) {
                      
                    },
                    success: function(data){
                        $status = data.status;
                        $message = data.message;
                        $html = data.html;
                        if($status == true){
                            // $('#cart-table-left').html($html);
                        }
                        else{
                            swal("Thất bại!", $message, "error");
                        }
                    }
                });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.plus_cart').click(function(){
            var id = $(this).data('id_cart');
            var number = $('#number_cart_'+id).val(); 
            var avai_stock = $(this).data('avai_stock');
            var _token = $('input[name="_token"]').val();
            console.log(avai_stock);
            if(number > avai_stock){
                swal("Thất bại!", "Số lượng sản phẩm không đủ", "error");
            }
            else{
                $.ajax({
                    url: '<?php echo e(route('plus_cart_ajax')); ?>',
                    method: 'POST',
                    data:{
                        id: id,
                        quantity: number,
                        avaiable_stock: avai_stock,
                        _token: _token,
                    },error(data) {
                      
                    },
                    success: function(data){
                        $status = data.status;
                        $message = data.message;
                        $html = data.html;
                        //console.log($count_cart);
                        if($status == true){
                            $('#cart-table-left').html($html);
                        }
                        else{
                            swal("Thất bại!", $message, "error");
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.minus_cart').click(function(){
            var id = $(this).data('id_cart');
            var number = $('#number_cart_'+id).val(); 
            var avai_stock = $(this).data('avai_stock');
            var _token = $('input[name="_token"]').val();
            console.log(avai_stock);
            if(number <= 1){
                swal("Bạn có chắc chắn muốn xóa sản phẩm này không?", {
                    buttons: {
                        cancel: "Hủy",
                        catch: {
                        text: "Xóa",
                        value: "catch",
                        },
                    },
                })
                .then((value) => {
                    switch (value) {
                        case "catch":
                        $.ajax({
                            url: '<?php echo e(route('delete_cart_ajax')); ?>',
                            method: 'POST',
                            data:{
                                id: id,
                                _token: _token,
                            },
                            success: function(data){
                                $status = data.status;
                                if($status == true){
                                    location.reload();
                                }
                            }
                        });
                        break;
                        default:
                        swal("Hủy thành công!");        
                    }
                });
            }
            else{
                $.ajax({
                    url: '<?php echo e(route('minus_cart_ajax')); ?>',
                    method: 'POST',
                    data:{
                        id: id,
                        quantity: number,
                        avaiable_stock: avai_stock,
                        _token: _token,
                    },error(data) {
                      
                    },
                    success: function(data){
                        $status = data.status;
                        $message = data.message;
                        $html = data.html;
                        //console.log($count_cart);
                        if($status == true){
                            $('#cart-table-left').html($html);
                        }
                        else{
                            swal("Thất bại!", $message, "error");
                        }
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.delete_cart').click(function(){
            var id = $(this).data('id_cart');
            var _token = $('input[name="_token"]').val();
            console.log(id);
            swal("Bạn có chắc chắn muốn xóa sản phẩm này không?", {
                buttons: {
                    cancel: "Hủy",
                    catch: {
                    text: "Xóa",
                    value: "catch",
                    },
                },
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                    $.ajax({
                        url: '<?php echo e(route('delete_cart_ajax')); ?>',
                        method: 'POST',
                        data:{
                            id: id,
                            _token: _token,
                        },
                        success: function(data){
                            $status = data.status;
    
                            if($status == true){

                                location.reload();
                            }
                            else{
                                swal("Thất bại!", "error");
                            }
                        }
                    });
                    break;
                    default:
                    swal("Hủy thành công!");        
                }
            });
        });
    });
    
</script>
<?php /**PATH D:\Ecommerce\resources\views/user/ajax_cart.blade.php ENDPATH**/ ?>