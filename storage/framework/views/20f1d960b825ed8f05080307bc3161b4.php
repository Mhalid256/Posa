<?php ($helpTopicStatus = getWebConfig('vendor_registration_faq_status')); ?>
<?php if($helpTopicStatus): ?>
        <section class="pt-4 pt-lg-5">
        <div class="container">
            <div class="d-flex flex-column gap-2 align-items-center text-center">
                <h2 class="section-title mb-2"><?php echo e(translate('Frequently Asked Questions')); ?></h2>
                <p class="max-w-500 mb-4"><?php echo e(translate('got_questions_about_becoming_a_vendor').' ? '.translate('explore_our_vendor_FAQ_section_for_answers_to_any_queries_you_may_have_about_joining_our_platform_as_a_vendor')); ?></p>
            </div>

            <div class="accordion__custom" id="accordion">
                <?php $__currentLoopData = $helpTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card">
                        <div class="card-header" id="heading-<?php echo e($key); ?>">
                            <h6 class="faq-title mb-0 py-2 collapsed" data-toggle="collapse" data-target="#collapse-<?php echo e($key); ?>" aria-expanded="true" aria-controls="collapse-<?php echo e($key); ?>">
                                <?php echo e($topic->question); ?>

                            </h6>
                        </div>

                        <div id="collapse-<?php echo e($key); ?>" class="collapse" aria-labelledby="heading-<?php echo e($key); ?>" data-parent="#accordion">
                            <div class="card-body">
                                <?php echo e($topic->answer); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\themes\default/web-views/seller-view/auth/partial/faq.blade.php ENDPATH**/ ?>