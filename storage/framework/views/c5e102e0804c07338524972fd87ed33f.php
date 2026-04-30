<?php $__currentLoopData = $productReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="">
        <div class="row product-review d-flex mb-3">
            <div class="col-md-4 d-flex mb-3">
                <div class="media media-ie-fix me-4 <?php echo e($productReview->reply ? 'before-content-border' : ''); ?>">
                    <img class="rounded-circle __img-64 object-cover"
                         src="<?php echo e(isset($productReview->user) ? getStorageImages(path: $productReview->user->image_full_url, type: 'avatar') : theme_asset(path: 'public/assets/front-end/img/image-place-holder.png')); ?>"
                         alt="<?php echo e(isset($productReview->user)?$productReview->user->f_name : translate('not exist')); ?>"/>
                    <div
                        class="media-body <?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?> text-body">
                        <span class="mb-0 text-body font-semi-bold fs-13"><?php echo e(isset($productReview->user)?$productReview->user->f_name.' '.$productReview->user->l_name : translate('not exist')); ?></span>
                        <div class="d-flex ">
                            <div class="me-2">
                                <i class="sr-star czi-star-filled active"></i>
                            </div>
                            <div class="text-body text-nowrap">
                                <?php echo e(isset($productReview->rating) ? $productReview->rating : 0); ?> / 5
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-body __text-sm text-break m-0"><?php echo e(isset($productReview->comment) ? $productReview->comment : ''); ?></p>
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <?php if(!empty($productReview->attachment_full_url)): ?>
                        <?php $__currentLoopData = $productReview->attachment_full_url; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img data-link="<?php echo e(getStorageImages(path: $attachment, type: 'product')); ?>"
                                 class="cz-image-zoom __img-70 rounded border show-instant-image"
                                 src="<?php echo e(getStorageImages(path: $attachment, type: 'product')); ?>"
                                 alt="<?php echo e(translate('product')); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-2 text-body">
                <span class="float-end font-semi-bold fs-13"><?php echo e(isset($productReview->updated_at) ? $productReview->updated_at->format('M-d-Y') : ''); ?></span>
            </div>
        </div>
    </div>

    <?php if($productReview->reply): ?>
        <div class="pl-md-4 mt-3 mb-3">
            <div class="review-reply rounded bg-E9F3FF80 p-3 ml-md-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <img src="<?php echo e(dynamicAsset('public/assets/front-end/img/seller-reply-icon.png')); ?>" alt="">
                        <h6 class="font-bold fs-14 m-0"><?php echo e(translate('Reply_by_Seller')); ?></h6>
                    </div>
                    <span class="opacity-50 fs-12">
                        <?php echo e(isset($productReview->reply->created_at) ? $productReview->reply->created_at->format('M-d-Y') : ''); ?>

                    </span>
                </div>
                <p class="fs-14">
                    <?php echo $productReview->reply->reply_text; ?>

                </p>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/partials/_product-reviews.blade.php ENDPATH**/ ?>