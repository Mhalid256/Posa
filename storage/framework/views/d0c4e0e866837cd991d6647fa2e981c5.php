<?php $__env->startSection('title', translate('invoice_Settings')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="mb-3 mb-sm-20">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <?php echo e(translate('business_Setup')); ?>

            </h2>
        </div>
        <?php echo $__env->make('admin-views.business-settings.business-setup-inline-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <form action="<?php echo e(route('admin.business-settings.invoice-settings.update')); ?>" method="post"
              enctype="multipart/form-data" id="update-invoice-settings">
            <?php echo csrf_field(); ?>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="mb-3 mb-sm-4">
                        <h3><?php echo e(translate('General_Setup')); ?></h3>
                        <p class="mb-0 fs-12">
                            <?php echo e(translate('complete_the_basic_settings_for_invoice_presentation')); ?>

                        </p>
                    </div>
                    <div class="p-sm-20 p-12 bg-section rounded">
                        <div class="form-group">
                            <label class="form-label" for=""><?php echo e(translate('Terms_&_Condition')); ?>

                                <span class="tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="right"
                                      data-bs-title="<?php echo e(translate('Enter_your_terms_&_condition')); ?>">
                                    <i class="fi fi-sr-info"></i>
                                </span>
                            </label>
                            <textarea class="form-control" name="terms_and_condition" id="terms_and_condition" rows="3"
                                      placeholder="<?php echo e(translate('Terms_&_Condition')); ?>"
                                      required><?php echo e($invoiceSettings['terms_and_condition'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <?php
                        $businessIdentityStatus = getWebConfig('invoice_settings')
                    ?>
                    <div class="mb-3 mb-sm-4 d-flex justify-content-between align-items-center gap-3">
                        <div>
                            <h3><?php echo e(translate('Business_Identity')); ?></h3>
                            <p class="mb-0 fs-12">
                                <?php echo e(translate('select_your_business_identity_type_from_the_provided_options_and_enter_the_identification_information')); ?>

                            </p>
                        </div>
                        <div>
                            <label class="switcher" for="business_identity_status">
                                <input
                                    class="switcher_input custom-modal-plugin"
                                    type="checkbox" value="1" name="business_identity_status"
                                    id="business_identity_status"
                                    <?php echo e(isset($businessIdentityStatus['business_identity_status']) && $businessIdentityStatus['business_identity_status'] == 1 ? 'checked' : ''); ?>

                                    data-modal-type="input-change"
                                    data-modal-form="#update-invoice-settings"
                                    data-on-image="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/img/modal/general-icon.png')); ?>"
                                    data-off-image="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/img/modal/general-icon.png')); ?>"
                                    data-on-title="<?php echo e(translate('want_to_Turn_ON_the_Business_Identity_button')); ?>"
                                    data-off-title="<?php echo e(translate('want_to_Turn_OFF_the_Business_Identity_button')); ?>"
                                    data-on-message="<p><?php echo e(translate('if_enabled_the_Business_Identity_information_will_be_show_in_the_invoice')); ?></p>"
                                    data-off-message="<p><?php echo e(translate('if_disabled_the_Business_Identity_information_will_be_hidden_from_the_invoice')); ?></p>"
                                    data-on-button-text="<?php echo e(translate('turn_on')); ?>"
                                    data-off-button-text="<?php echo e(translate('turn_off')); ?>">
                                <span class="switcher_control"></span>
                            </label>
                        </div>
                    </div>
                    <div class="p-sm-20 p-12 bg-section rounded">
                        <div class="row g-4 align-items-end">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-capitalize" for="">
                                        <?php echo e(translate('Choose_Business_Identity')); ?>

                                    </label>
                                    <div
                                        class="min-h-40 bg-white d-flex align-items-center justify-content-around border rounded px-3 py-1 flex-wrap flex-sm-nowrap gap-2 gap-sm-20">
                                        <label class="form-check d-flex gap-5px flex-grow-1">
                                            <input type="radio" name="business_identity"
                                                   class="business-identity form-check-input radio--input"
                                                   value="Tax ID" <?php echo e(empty($invoiceSettings['business_identity']) || $invoiceSettings['business_identity'] == 'Tax ID'? 'checked' : ''); ?>>
                                            <span class="form-check-label"><?php echo e(translate('tax_Id')); ?></span>
                                        </label>
                                        <label class="form-check d-flex gap-5px flex-grow-1">
                                            <input type="radio" name="business_identity"
                                                   class="business-identity form-check-input radio--input"
                                                   value="Bin Number" <?php echo e($invoiceSettings['business_identity'] == 'Bin Number'? 'checked' : ''); ?>>
                                            <span class="form-check-label"><?php echo e(translate('bin_Number')); ?></span>
                                        </label>
                                        <label class="form-check d-flex gap-5px flex-grow-1">
                                            <input type="radio" name="business_identity"
                                                   class="business-identity form-check-input radio--input"
                                                   value="Musak" <?php echo e($invoiceSettings['business_identity'] == 'Musak'? 'checked' : ''); ?>>
                                            <span class="form-check-label"><?php echo e(translate('musak')); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label identity-number" for="">
                                        <?php echo e(translate('Tax_Number')); ?>

                                    </label>
                                    <input type="text" name="business_identity_value" class="form-control"
                                           value="<?php echo e($invoiceSettings['business_identity_value']?? ''); ?>"
                                           id="business-identity-value"
                                           placeholder="<?php echo e(translate('enter').' '.$invoiceSettings['business_identity']); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <?php
                    $invoiceLogoStatus = getWebConfig('invoice_settings')
                ?>
                <div class="card-body p-20">
                    <div class="mb-3 mb-sm-4 d-flex justify-content-between align-items-center gap-3">
                        <div>
                            <h3 class="text-capitalize"><?php echo e(translate('logo_on_invoice')); ?></h3>
                            <p class="mb-0 fs-12">
                                <?php echo e(translate('enable_the_option_to_update_the_logo_that_appears_on_invoices')); ?>

                            </p>
                        </div>
                        <div>
                            <label class="switcher mx-auto" for="invoice-logo-status">
                                <input
                                    class="switcher_input custom-modal-plugin"
                                    type="checkbox" value="1" name="invoice_logo_status"
                                    id="invoice-logo-status"
                                    <?php echo e(isset($invoiceLogoStatus['invoice_logo_status']) && $invoiceLogoStatus['invoice_logo_status'] == 1 ? 'checked' : ''); ?>

                                    data-modal-type="input-change"
                                    data-modal-form="#update-invoice-settings"
                                    data-on-image="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/img/modal/general-icon.png')); ?>"
                                    data-off-image="<?php echo e(dynamicAsset(path: 'public/assets/new/back-end/img/modal/general-icon.png')); ?>"
                                    data-on-title="<?php echo e(translate('want_to_Turn_ON_the_Logo_on_invoice')); ?>"
                                    data-off-title="<?php echo e(translate('want_to_Turn_OFF_the_Logo_on_invoice')); ?>"
                                    data-on-message="<p><?php echo e(translate('if_enabled_the_Logo_will_be_show_in_the_invoice')); ?></p>"
                                    data-off-message="<p><?php echo e(translate('if_disabled_the_Logo_will_be_hidden_from_the_invoice')); ?></p>"
                                    data-on-button-text="<?php echo e(translate('turn_on')); ?>"
                                    data-off-button-text="<?php echo e(translate('turn_off')); ?>">
                                <span class="switcher_control"></span>
                            </label>
                        </div>
                    </div>
                    <div class="p-sm-20 p-12 bg-section rounded card-disabled-wrapper">
                        <div class="row align-items-center g-4 flex-wrap mb-3 mb-sm-4">
                            <div class="col-xxl-8 col-lg-6">
                                <div>
                                    <h3 class="text-capitalize"><?php echo e(translate('choose_how_to_display_the_logo')); ?></h3>
                                    <p class="mb-0 fs-12">
                                        <?php echo e(translate('select_invoice_logo_option_from_the_available_alternatives')); ?>

                                    </p>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-lg-6">
                                <div
                                    class="min-h-40 bg-white d-flex align-items-center justify-content-around border rounded px-3 py-1 flex-wrap flex-sm-nowrap gap-2 gap-sm-20">
                                    <div class="flex-grow-1">
                                        <label class="form-check d-flex gap-5px">
                                            <input type="radio" name="invoice_logo_type"
                                                   class=" form-check-input radio--input"
                                                   value="custom" <?php echo e(isset($invoiceLogoStatus['invoice_logo_type']) && $invoiceLogoStatus['invoice_logo_type'] == "custom" ? 'checked' : ''); ?>>
                                            <span class="form-check-label"><?php echo e(translate('Upload_New')); ?></span>
                                        </label>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="form-check d-flex gap-5px">
                                            <input type="radio" name="invoice_logo_type" id="useCurrentLogo"
                                                   class="form-check-input radio--input"
                                                   value="default" <?php echo e(!isset($invoiceLogoStatus['invoice_logo_type']) || $invoiceLogoStatus['invoice_logo_type'] == "default" ? 'checked' : ''); ?>>
                                            <span
                                                class="form-check-label text-capitalize"><?php echo e(translate('use_current_logo')); ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-sm <?php echo e(isset($invoiceLogoStatus['invoice_logo_type']) && $invoiceLogoStatus['invoice_logo_type'] == "default" ? 'disabled' : ''); ?>">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-lg-0">
                                            <label for="" class="form-label fw-semibold mb-1">
                                                <?php echo e(translate('Upload_Logo')); ?>

                                            </label>
                                            <p class="fs-12 mb-0">
                                                <?php echo e(translate('upload_your_logo_here_this_image_will_be_displayed_on_invoices')); ?>

                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="d-flex flex-column gap-20 p-12 p-sm-20 bg-section rounded <?php echo e(isset($invoiceLogoStatus['invoice_logo_type']) && $invoiceLogoStatus['invoice_logo_type'] == "default" ? 'd-none' : ''); ?>" id="invoice-logo-type-custom">
                                            <?php
                                            $imageArray = [
                                                'image_name' => $invoiceSettings['image']['image_name'] ?? $invoiceSettings['image'],
                                                'storage' => $invoiceSettings['image']['storage'] ?? 'public',
                                            ];
                                            $imagePath = storageLink('company', $imageArray['image_name'], $imageArray['storage']);
                                            ?>
                                            <div class="upload-file">
                                                <input type="file" name="image"
                                                       class="upload-file__input single_file_input"
                                                       accept=".webp, .jpg, .jpeg, .png, .gif"
                                                       value="<?php echo e(getStorageImages(path:$imagePath,type: 'backend-placeholder') ?? ''); ?>">
                                                <label
                                                    class="upload-file__wrapper w-325">
                                                    <div
                                                        class="upload-file-textbox text-center <?php echo e(!empty($imagePath['path']) ? 'd-none' : ''); ?>">
                                                        <img width="34" height="34" class="svg"
                                                             src="<?php echo e(getStorageImages(path:$imagePath,type: 'backend-placeholder') ?? ''); ?>"
                                                             alt="image upload">
                                                        <h6 class="mt-1 fw-medium lh-base text-center">
                                                            <span
                                                                class="text-info text-capitalize"><?php echo e(translate('click_to_upload')); ?></span>
                                                            <br>
                                                            <?php echo e(translate('or_drag_and_drop')); ?>

                                                        </h6>
                                                    </div>
                                                    <img class="upload-file-img" loading="lazy"
                                                         src="<?php echo e(!empty($imagePath['path']) ? getStorageImages(path:$imagePath,type: 'backend-placeholder') ?? '' :  ''); ?>"
                                                         alt="">
                                                </label>
                                                <div class="overlay">
                                                    <div
                                                        class="d-flex gap-10 justify-content-center align-items-center h-100">
                                                        <button type="button"
                                                                class="btn btn-outline-info icon-btn edit_btn">
                                                            <i class="fi fi-rr-camera"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="fs-10 mb-0 text-center"><?php echo e(translate('jpg,_jpeg,_png,_gif_image_size')); ?>

                                                : <?php echo e(translate('Max_1_MB')); ?> <span
                                                    class="fw-medium"><?php echo e("(325 x 100 px)"); ?></span></p>
                                        </div>

                                        <div class="d-flex flex-column gap-20 p-12 p-sm-20 bg-section rounded <?php echo e(isset($invoiceLogoStatus['invoice_logo_type']) && $invoiceLogoStatus['invoice_logo_type'] == "default" ? '' : 'd-none'); ?>" id="invoice-logo-type-default">
                                            <div class="upload-file">
                                                <input type="file"
                                                       class="upload-file__input single_file_input"
                                                       accept=".webp, .jpg, .jpeg, .png, .gif">
                                                <label
                                                    class="upload-file__wrapper w-325">
                                                    <div
                                                        class="upload-file-textbox text-center">
                                                        <img width="34" height="34" class="svg"
                                                             src="<?php echo e(getStorageImages(path: getWebConfig(name: 'company_web_logo'), type: 'backend-logo')); ?>"
                                                             alt="<?php echo e(translate('logo')); ?>"> ?? '' }}"
                                                             alt="image upload">
                                                        <h6 class="mt-1 fw-medium lh-base text-center">
                                                            <span
                                                                class="text-info text-capitalize"><?php echo e(translate('click_to_upload')); ?></span>
                                                            <br>
                                                            <?php echo e(translate('or_drag_and_drop')); ?>

                                                        </h6>
                                                    </div>
                                                    <img class="upload-file-img" loading="lazy"
                                                         src="<?php echo e(getStorageImages(path: getWebConfig(name: 'company_web_logo'), type: 'backend-logo')); ?>"
                                                         alt="">
                                                </label>
                                                <div class="overlay">
                                                    <div
                                                        class="d-flex gap-10 justify-content-center align-items-center h-100">
                                                        <button type="button"
                                                                class="btn btn-outline-info icon-btn edit_btn">
                                                            <i class="fi fi-rr-camera"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="fs-10 mb-0 text-center"><?php echo e(translate('jpg,_jpeg,_png,_gif_image_size')); ?>

                                                : <?php echo e(translate('Max_1_MB')); ?> <span
                                                    class="fw-medium"><?php echo e("(325 x 100 px)"); ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end trans3 mt-3 mt-sm-4">
                <div
                    class="d-flex justify-content-sm-end justify-content-center gap-3 flex-grow-1 flex-grow-sm-0 bg-white action-btn-wrapper trans3">
                    <button type="reset" class="btn btn-secondary px-4 w-120"><?php echo e(translate('reset')); ?></button>
                    <button type="submit"
                            class="btn btn-primary px-4 <?php echo e(env('APP_MODE')!= 'demo'? '' : 'call-demo-alert'); ?>">
                        <i class="fi fi-sr-disk"></i>
                        <?php echo e(translate('save_information')); ?>

                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php echo $__env->make("layouts.admin.partials.offcanvas._invoice-setup", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(dynamicAsset(path: 'public/assets/backend/admin/js/business-settings/invoice-settings.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            $('input[name="invoice_logo_type"]').on('change', function () {
                let parentContainer = $(this).closest('.card-disabled-wrapper');
                let associatedCard = parentContainer.find('.card');

                if ($(this).attr('id') === 'useCurrentLogo' && $(this).is(':checked')) {
                    associatedCard.addClass('disabled');
                    $('#invoice-logo-type-default').removeClass('d-none');
                    $('#invoice-logo-type-custom').addClass('d-none');
                } else {
                    associatedCard.removeClass('disabled');
                    $('#invoice-logo-type-default').addClass('d-none');
                    $('#invoice-logo-type-custom').removeClass('d-none');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/business-settings/invoice-settings/index.blade.php ENDPATH**/ ?>