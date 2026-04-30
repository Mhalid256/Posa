<div class="position-relative nav--tab-wrapper mb-4">
    <ul class="nav nav-pills nav--tab me-5" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/web-config') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.business-settings.web-config.index')); ?>">
                <?php echo e(translate('General')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/website-setup') ? 'active' : ''); ?>"
            href="<?php echo e(route('admin.business-settings.website-setup')); ?>">
                <?php echo e(translate('Website_Setup')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/vendor-settings') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.business-settings.vendor-settings.index')); ?>">
                <?php echo e(translate('Vendors')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/product-settings') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.business-settings.product-settings.index')); ?>">
                <?php echo e(translate('Products')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/delivery-man-settings') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.business-settings.delivery-man-settings.index')); ?>">
                <?php echo e(translate('Delivery_Men')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/customer-settings') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.business-settings.customer-settings')); ?>">
                <?php echo e(translate('Customer')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/order-settings/index') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.business-settings.order-settings.index')); ?>">
                <?php echo e(translate('Orders')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/refund-setup') ? 'active' : ''); ?>"
            href="<?php echo e(route('admin.business-settings.refund-setup')); ?>">
                <?php echo e(translate('Refund')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/shipping-method/index') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.business-settings.shipping-method.index')); ?>">
                <?php echo e(translate('Shipping_Method')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/delivery-restriction') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.business-settings.delivery-restriction.index')); ?>">
                <?php echo e(translate('Delivery_Restriction')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('admin/business-settings/invoice-settings') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.business-settings.invoice-settings.index')); ?>">
                <?php echo e(translate('Invoice')); ?>

            </a>
        </li>
    </ul>
    <div class="nav--tab__prev">
        <button class="btn btn-circle border-0 bg-white text-primary">
            <i class="fi fi-sr-angle-left"></i>
        </button>
    </div>
    <div class="nav--tab__next">
        <button class="btn btn-circle border-0 bg-white text-primary">
            <i class="fi fi-sr-angle-right"></i>
        </button>
    </div>

</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/admin-views/business-settings/business-setup-inline-menu.blade.php ENDPATH**/ ?>