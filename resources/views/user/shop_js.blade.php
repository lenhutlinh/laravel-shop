<!-- include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- include jQuery validate library -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- include Ajax  library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    $(document).ready(function(){
        $('.choose_subcategory').on('click',function(){
            var subcategory_id = $(this).attr('data-subcategory-id');
            // var shop_id = $(this).attr('data-shop-id');
            var shop_id = $('#shop_id').val(); 
            // console.log(subcategory_id);
            $.ajax({
                url: '{{route('choose_subcategory')}}',
                method: 'GET',
                data:{
                    subcategory_id: subcategory_id,
                    shop_id: shop_id,
                },
                success: function(data){
                    var $html = data.html;
                    $('.shop-search-result-view').html($html);
                    
                },
                error: function(data){
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
        
    })
</script>
<script>
    $(document).ready(function(){
        $('.choose_arrange').on('click',function(){
            var shop_id = $('#shop_id').val(); 
            var arrange = $(this).data('choose_id');
            var subcategory_id = $('#subcategory_id').val(); 
            
            if (subcategory_id == null) {
                if (arrange == "popular") {
                    $.ajax({
                        url: '{{route('choose_popular')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
                if (arrange == "newest") {  
                    $.ajax({
                        url: '{{route('choose_newest')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
                if (arrange == "best_sell") {
                    $.ajax({
                        url: '{{route('choose_best_sell')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
                if (arrange == "high_low") {
                    $.ajax({
                        url: '{{route('choose_high_low')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
                if (arrange == "low_high") {
                    $.ajax({
                        url: '{{route('choose_low_high')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
            }else{
                console.log(subcategory_id);
                if (arrange == "popular") {
                    $.ajax({
                        url: '{{route('choose_popular')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                            subcategory_id: subcategory_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                
                }
                if (arrange == "newest") {
                    $.ajax({
                        url: '{{route('choose_newest')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                            subcategory_id: subcategory_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
                if (arrange == "best_sell") {
                    $.ajax({
                        url: '{{route('choose_best_sell')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                            subcategory_id: subcategory_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
                if (arrange == "high_low") {
                    $.ajax({
                        url: '{{route('choose_high_low')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                            subcategory_id: subcategory_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
                if (arrange == "low_high") {
                    $.ajax({
                        url: '{{route('choose_low_high')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            shop_id: shop_id,
                            subcategory_id: subcategory_id,
                        },
                        success: function(data){
                            var $html = data.html;
                            $('.shop-search-result-view').html($html);
                            
                        },
                        error: function(data){
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
            }
        });
    })
</script>