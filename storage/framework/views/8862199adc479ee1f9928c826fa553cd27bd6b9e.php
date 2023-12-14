       
                               <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="body-index-products colum-1-9">
                                <a href="<?php echo e(route('detail_product',$product->id)); ?>">
                                    <div class="body-index-products-info">
                                        <div class="body-index-products-img ">
                                            <img src="<?php echo e(asset('storage/'.$product->previewImage)); ?>" alt="" class="product-img-index">
                                        </div>
                                        <div class="body-index-products-detail">
                                            <div class="body-index-products-detail-name">
                                                <div id="body-index-products-detail-name-span">
                                                    <?php echo e($product->productName); ?>

                                                </div>
                                            </div>
                                            <div class="body-index-products-detail-price">
                                                <div id="body-index-products-detail-price-span">
                                                    <?php echo e(number_format($product->price, 0, ',', '.')); ?>đ
                                                </div>
                                            </div>
                                            <div class="body-index-products-detail-sold">
                                                <div id="body-index-products-detail-sold-span">
                                                    <?php if($product->sales_quantity > 1): ?>
                                                        Đã bán <?php echo e($product->sales_quantity); ?>

                                                    <?php else: ?>
                                                        Đã bán 0
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                <?php if(isset($price_from)): ?>
                                    <input type="hidden" name="price_from" value="<?php echo e($price_from); ?>"/>
                                <?php endif; ?>
                                <?php if(isset($price_to)): ?>
                                    <input type="hidden" name="price_to" value="<?php echo e($price_to); ?>"/>
                                <?php endif; ?><?php /**PATH D:\Ecommerce\resources\views/user/ajax_search.blade.php ENDPATH**/ ?>