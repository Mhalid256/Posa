<div class="col-lg-4">
    <div class="">
        <div class="d-flex justify-content-center">
            <div class="ext-center">
                <h3 class="mb-2 text-capitalize"><?php echo e($vendorRegistrationHeader?->title ?? translate('vendor_registration')); ?></h3>
                <p><?php echo e($vendorRegistrationHeader?->sub_title ?? translate('create_your_own_store').'.'.translate('already_have_store').'?'); ?>

                    <a class="text-primary fw-bold" href="<?php echo e(route('vendor.auth.login')); ?>"><?php echo e(translate('login')); ?></a>
                </p>
                <div class="my-4 text-center">
                    <img width="308" src="<?php echo e(!empty($vendorRegistrationHeader?->image)  ? getStorageImages(path:imagePathProcessing(imageData: $vendorRegistrationHeader?->image, path: 'vendor-registration-setting'),type: 'product') : theme_asset('public/assets/front-end/img/media/seller-registration.png')); ?>" alt="" class="dark-support">
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/seller-view/auth/partial/header.blade.php ENDPATH**/ ?>