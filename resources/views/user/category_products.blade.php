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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">    
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
    <title>{{$category->categoryName }}</title>
</head>
<body>
    
    <header>
        @include('header')
    </header>
    <main >
    <input type="hidden" id="category_id" value="{{$category_info->id}}">
        <div class="category-product-center">
            <div class="body-category">
                <div class="filter-panel">
                    <div class="filter_container">
                        <div  class="filter_menu">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                    <p class="filter_title">DANH MỤC PHỤ</p>
                                </div>
                                <div class="filter_list">
                                    @foreach($sub_category as $sub_cate)
                                    <div class="filter_item">    
                                        <label class="filter_item-checkbox-name">
                                            <input class="choose_subcategory" id="{{$sub_cate->id}}"  type="radio" name="subCategory"data-category-id="{{$category_info->id }}" data-subcategory-id="{{$sub_cate->id}}">
                                            <label class="shop_subcategory"  for="{{$sub_cate->id}}"> {{$sub_cate->subCategoryName}}</label> 
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                       
                    </div>
                    
                </div>
                <div class="body-category-item">
                    <div class="shopee-sort-bar">
                        <span class="shopee-sort-bar__label">Sắp xếp theo</span>
                        <div class="shopee-sort-by-options" >
                            <input class="choose_arrange" id="popular" checked  type="radio" name="choose_arrange"  data-choose_id="popular">
                            <label class=" shopee-sort-by-options__option "  for="popular"> Phổ Biến</label> 
                                        
                            <input class="choose_arrange" id="newest"  type="radio" name="choose_arrange"  data-choose_id="newest">
                            <label class=" shopee-sort-by-options__option "  for="newest"> Mới nhất</label>

                            <input class="choose_arrange" id="best_sell"  type="radio" name="choose_arrange"  data-choose_id="best_sell">
                            <label class="shopee-sort-by-options__option "  for="best_sell"> Bán Chạy</label>
                                        
                            <input class="choose_arrange" id="high_low"  type="radio" name="choose_arrange"  data-choose_id="high_low">
                            <label class="shopee-sort-by-options__option "  for="high_low"> Giá: Cao đến thấp</label>
                                        
                            <input class="choose_arrange" id="low_high"  type="radio" name="choose_arrange"  data-choose_id="low_high">
                            <label class="shopee-sort-by-options__option "  for="low_high"> Giá: Thấp đến cao</label>
                          
                                       
                        </div>
                    </div>
                    <div class="body-category-items">
                        <div class="shop-search-result-view" >
                            @foreach($products as $product)
                            <div class="body-index-products colum-1-9">
                                <a href="{{route('detail_product',$product->id)}}">
                                    <div class="body-index-products-info">
                                        <div class="body-index-products-img ">
                                            <img src="{{asset('storage/'.$product->previewImage)}}" alt="" class="product-img-index">
                                        </div>
                                        <div class="body-index-products-detail">
                                            <div class="body-index-products-detail-name">
                                                <div id="body-index-products-detail-name-span">
                                                    {{$product->productName}}
                                                </div>
                                            </div>
                                            <div class="body-index-products-detail-price">
                                                <div id="body-index-products-detail-price-span">
                                                    {{number_format($product->price, 0, ',', '.') }}đ
                                                </div>
                                            </div>
                                            <div class="body-index-products-detail-sold">
                                                <div id="body-index-products-detail-sold-span">
                                                    @if($product->sales_quantity > 1)
                                                        Đã bán {{$product->sales_quantity}}
                                                    @else
                                                        Đã bán 0
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach   
                        </div>
                        <div class="pagination">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    <footer>
       @include('footer')

    </footer>
@include('user.category_products_js')
</body>
   

</html>



