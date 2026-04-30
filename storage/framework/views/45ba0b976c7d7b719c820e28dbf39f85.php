<div class="second-el d--none">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-4"><?php echo e(translate('create_an_account')); ?></h3>
                        <div class="border p-3 p-xl-4 rounded">
                            <h4 class="mb-3"><?php echo e(translate('vendor_information')); ?></h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label  for="f_name"><?php echo e(translate('first_name')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="f_name" placeholder="<?php echo e(translate('ex').': John'); ?>" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label  for="l_name"><?php echo e(translate('last_name')); ?> <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="l_name" placeholder="<?php echo e(translate('ex').': Doe'); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column gap-3 align-items-center">
                                        <div class="upload-file">
                                            <input type="file" class="upload-file__input" name="image" accept="image/*" required>
                                            <div class="upload-file__img">
                                                <div class="temp-img-box">
                                                    <div class="d-flex align-items-center flex-column gap-2">
                                                        <i class="tio-upload fs-30"></i>
                                                        <div class="fs-12 text-muted text-capitalize"><?php echo e(translate('upload_file')); ?></div>
                                                    </div>
                                                </div>
                                                <img src="#" class="dark-support img-fit-contain border" alt="" hidden>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column gap-1 upload-img-content text-center">
                                            <h6 class="text-uppercase mb-1 fs-14"><?php echo e(translate('vendor_image')); ?></h6>
                                            <div class="text-muted text-capitalize fs-12"><?php echo e(translate('image_ratio').' '.'1:1'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border p-3 p-xl-4 rounded mt-4">
                            <h4 class="mb-3 text-capitalize"><?php echo e(translate('shop_information')); ?></h4>

                            <div class="form-group mb-4">
                                <label for="store_name" class="text-capitalize"><?php echo e(translate('shop_Name')); ?> <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="shop_name"  name="shop_name" placeholder="<?php echo e(translate('Ex: XYZ store')); ?>" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="store_address" class="text-capitalize"><?php echo e(translate('shop_address')); ?> <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="shop_address" id="shop_address" rows="4" placeholder="<?php echo e(translate('shop_address')); ?>" required></textarea>
                            </div>

                            <div class="border p-3 p-xl-4 rounded mb-4">
                                <div class="d-flex flex-column gap-3 align-items-center">
                                    <div class="upload-file">
                                        <input type="file" class="upload-file__input" name="logo" accept="image/*" required>
                                        <div class="upload-file__img">
                                            <div class="temp-img-box">
                                                <div class="d-flex align-items-center flex-column gap-2">
                                                    <i class="tio-upload fs-30"></i>
                                                    <div class="fs-12 text-muted text-capitalize"><?php echo e(translate('upload_file')); ?></div>
                                                </div>
                                            </div>
                                            <img src="#" class="dark-support img-fit-contain border" alt="" hidden>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column gap-1 upload-img-content text-center">
                                        <h6 class="text-uppercase mb-1 fs-14"><?php echo e(translate('upload_logo')); ?></h6>
                                        <div class="text-muted text-capitalize fs-12"><?php echo e(translate('image_ratio').' '.'1:1'); ?></div>
                                        <div class="text-muted text-capitalize fs-12"><?php echo e(translate('Image Size : Max 2 MB')); ?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="border p-3 p-xl-4 rounded">
                                <div class="d-flex flex-column gap-3 align-items-center">
                                    <div class="upload-file">
                                        <input type="file" class="upload-file__input" name="banner" accept="image/*" required>
                                        <div class="upload-file__img style--two">
                                            <div class="temp-img-box">
                                                <div class="d-flex align-items-center flex-column gap-2">
                                                    <i class="tio-upload fs-30"></i>
                                                    <div class="fs-12 text-muted text-capitalize"><?php echo e(translate('upload_file')); ?></div>
                                                </div>
                                            </div>
                                            <img src="#" class="dark-support img-fit-contain border" alt="" hidden>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column gap-1 upload-img-content text-center">
                                        <h6 class="text-uppercase mb-1 fs-14"><?php echo e(translate('upload_banner')); ?></h6>
                                        <div class="text-muted text-capitalize fs-12"><?php echo e(translate('image_ratio').' '.'2:1'); ?></div>
                                        <div class="text-muted text-capitalize fs-12"><?php echo e(translate('Image Size : Max 2 MB')); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php ($recaptcha = getWebConfig(name: 'recaptcha')); ?>
                        <?php if(isset($recaptcha) && $recaptcha['status'] == 1): ?>
                            <div id="recaptcha-element-vendor-register" class="w-100 pt-2" data-type="image"></div>
                        <?php else: ?>
                            <div class="mt-2">
                                <div class="row py-2">
                                    <div class="col-6 pr-0">
                                        <input type="text" class="form-control __h-40" name="default_recaptcha_id_seller_regi" id="default-recaptcha-id-vendor-register" value=""
                                               placeholder="<?php echo e(translate('enter_captcha_value')); ?>" autocomplete="off" required>
                                    </div>
                                    <div class="col-6 input-icons mb-2 w-100 rounded bg-white">
                                    <span class="d-flex align-items-center align-items-center get-vendor-regi-recaptcha-verify"
                                          data-link="<?php echo e(route('vendor.auth.recaptcha', ['tmp'=>':dummy-id'])); ?>">
                                        <img src="<?php echo e(route('vendor.auth.recaptcha', ['tmp'=>1]).'?captcha_session_id=vendorRecaptchaSessionKey'); ?>" alt="" class="rounded __h-40" id="default_recaptcha_id">
                                        <i class="tio-refresh position-relative cursor-pointer p-2"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="d-flex justify-content-start mt-2">
                            <label class="custom-checkbox align-items-center">
                                <input type="checkbox" class="" id="terms-checkbox" >
                                <span class="form-check-label"><?php echo e(translate('i_agree_with_the')); ?> <a
                                        href="<?php echo e(route('business-page.view', ['slug' => 'terms-and-conditions'])); ?>" target="_blank" class="text-underline color-bs-primary-force">
                                        <?php echo e(translate('terms_&_conditions')); ?>

                                    </a>
                                </span>
                            </label>
                        </div>
                        <div class="d-flex justify-content-end mb-2 gap-2">
                            <button type="button" class="btn btn-secondary back-to-main-page"> <?php echo e(translate('back')); ?> </button>
                            <button type="button" class="btn btn--primary"  id="vendor-apply-submit" disabled="disabled"> <?php echo e(translate('submit')); ?> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/seller-view/auth/partial/vendor-information-form.blade.php ENDPATH**/ ?>