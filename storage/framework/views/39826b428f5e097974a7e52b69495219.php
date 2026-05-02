<p class="view-footer-text">
    <?php echo e($footerText); ?>

</p>
<p><?php echo e(translate('Thanks_&_Regards')); ?>, <br> <?php echo e(getWebConfig('company_name')); ?></p>
<div class="bg-white rounded-10 px-2 py-4">
    <div class="d-flex justify-content-center mb-4">
        <img width="76" class="mx-auto" id="view-mail-logo" src="<?php echo e($template->logo_full_url['path'] ?? getStorageImages(path: $companyLogo, type:'backend-logo')); ?>" alt="">
    </div>
    <div class="d-flex justify-content-center gap-2">
        <ul class="list-unstyled d-flex flex-column flex-xl-row align-items-center p-0 gap-3 mx-auto" id="selected-pages">
            <?php if(!empty($template['pages']) && in_array('privacy_policy',$template['pages'])): ?>
                <li class="privacy-policy"><a href="<?php echo e(route('business-page.view', ['slug' => 'privacy-policy'])); ?>" class="text-dark fs-12"><?php echo e(translate('privacy_Policy')); ?></a></li>
            <?php endif; ?>
            <?php if(!empty($template['pages']) && in_array('refund_policy',$template['pages'])): ?>
                <li class="refund-policy"><a href="<?php echo e(route('business-page.view', ['slug' => 'refund-policy'])); ?>" class="text-dark fs-12 border_middle"><?php echo e(translate('refund_Policy')); ?></a></li>
            <?php endif; ?>
            <?php if(!empty($template['pages']) && in_array('cancellation_policy',$template['pages'])): ?>
                <li class="cancellation-policy"><a href="<?php echo e(route('business-page.view', ['slug' => 'cancellation-policy'])); ?>" class="text-dark fs-12 border_middle"><?php echo e(translate('cancellation_Policy')); ?></a></li>
            <?php endif; ?>
            <?php if(!empty($template['pages']) && in_array('contact_us',$template['pages'])): ?>
                <li class="contact-us"><a href="<?php echo e(route('contacts')); ?>" class="text-dark fs-12 border_middle"><?php echo e(translate('contact_Us')); ?></a></li>
            <?php endif; ?>
            <?php if(empty($template['pages'])): ?>
                <li class="privacy-policy"><a href="<?php echo e(route('business-page.view', ['slug' => 'privacy-policy'])); ?>" class="text-dark fs-12"><?php echo e(translate('privacy_Policy')); ?></a></li>
                <li class="refund-policy"><a href="<?php echo e(route('business-page.view', ['slug' => 'refund-policy'])); ?>" class="text-dark fs-12 border_middle"><?php echo e(translate('refund_Policy')); ?></a></li>
                <li class="cancellation-policy"><a href="<?php echo e(route('business-page.view', ['slug' => 'cancellation-policy'])); ?>" class="text-dark fs-12 border_middle"><?php echo e(translate('cancellation_Policy')); ?></a></li>
                <li class="contact-us"><a href="<?php echo e(route('contacts')); ?>" class="text-dark fs-12 border_middle"><?php echo e(translate('contact_Us')); ?></a></li>
            <?php endif; ?>
    
        </ul>
    </div>
    <div class="d-flex gap-4 justify-content-center align-items-center mb-3 fs-16 social-media-icon" id="selected-social-media">
        <?php $__currentLoopData = $socialMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($template['social_media'])): ?>
                <a class="<?php echo e($media['name']); ?> <?php echo e(in_array($media['name'],$template['social_media']) ? '' : 'd-none'); ?>" href="<?php echo e($media['link']); ?>" target="_blank">
                    <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/'.$media['name'].'.png')); ?>"
                        width="16" alt="">
                </a>
            <?php else: ?>
                <a class="<?php echo e($media['name']); ?>" href="<?php echo e($media['link']); ?>" target="_blank">
                    <img src="<?php echo e(dynamicAsset(path: 'public/assets/back-end/img/'.$media['name'].'.png')); ?>"
                        width="16" alt="">
                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <ul class="d-flex justify-content-center ps-3">
        <li class="view-copyright-text">
            <?php echo e($copyrightText); ?>

        </li>
    </ul>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/business-settings/email-template/partials-design/footer.blade.php ENDPATH**/ ?>