

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
        $('#price_arround').on('click',function(){
            var price_from = $('#price_from').val();
            var price_to = $('#price_to').val();
            var keyword = $('#keyword').val();
            console.log(price_to);
            console.log(price_from);
            console.log(keyword);

            $.ajax({
                url: '{{route('price_arround')}}',
                method: 'GET',
                data:{
                    price_from: price_from,
                    price_to: price_to,
                    keyword:keyword,
                },
                success: function(data){
                    $html = data.html;
                    $status = data.status;
                    $message = data.message;
                    if ($status == true) {
                        $('.shop-search-result-view').html($html);
                    }
                    else{
                        swal("Thông báo", $message, "error");
                    }
                    
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
            var arrange = $(this).data('choose_id');
            var price_from = $('input[name="price_from"]').val();
            var price_to = $('input[name="price_to"]').val();
            var keyword = $('#keyword').val();
            console.log(price_to);
            console.log(price_from);
            console.log(keyword);
            console.log(arrange);
            if (price_to == null) {
                if (arrange == "popular") {
                    $.ajax({
                        url: '{{route('search_choose_popular')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
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
                        url: '{{route('search_choose_newest')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
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
                        url: '{{route('search_choose_best_sell')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
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
                        url: '{{route('search_choose_high_low')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
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
                        url: '{{route('search_choose_low_high')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
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
                if (arrange == "popular") {
                    $.ajax({
                        url: '{{route('search_choose_popular')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
                            price_from: price_from,
                            price_to: price_to,
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
                        url: '{{route('search_choose_newest')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
                            price_from: price_from,
                            price_to: price_to,
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
                        url: '{{route('search_choose_best_sell')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
                            price_from: price_from,
                            price_to: price_to,
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
                        url: '{{route('search_choose_high_low')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
                            price_from: price_from,
                            price_to: price_to,
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
                        url: '{{route('search_choose_low_high')}}',
                        method: 'GET',
                        data:{
                            arrange: arrange,
                            keyword: keyword,
                            price_from: price_from,
                            price_to: price_to,
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