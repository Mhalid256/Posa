<?php
    $last5Orders = \App\Models\Order::where('order_status', 'pending')->with('details.productAllStatus')->orderBy('id', 'desc')->take(5)->get();
?>

<header class="header fixed-top navbar-fixed shadow-sm bg-white">
    <div class="d-flex align-items-center justify-content-between gap-3">
        <div class="">
            <button type="button" class="d-none d-lg-block btn-icon border-0">
                <i class="fi fi-rr-menu-burger" data-bs-toggle="tooltip" data-bs-title="Expand"></i>
            </button>
            <button type="button" class="d-lg-none p-0 bg-transparent border-0" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasAside">
                <i class="fi fi-rr-menu-burger"></i>
            </button>
        </div>

        <div class="navbar-nav-wrap-content-right">
            <ul class="navbar-nav align-items-center flex-row gap-3">
                <li class="nav-item">
                    <a class="btn-icon" href="<?php echo e(route('home')); ?>" target="_blank" data-bs-toggle="tooltip"
                       data-bs-title="<?php echo e(translate('Website')); ?>">
                        <i class="fi fi-rr-globe fs-18"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <?php ( $local = session()->has('local') ? session('local'):'en'); ?>
                    <?php ($lang = \App\Models\BusinessSetting::where('type', 'language')->first()); ?>
                    <div class="topbar-text dropdown">
                        <a class="btn-icon topbar-link" href="javascript:" data-bs-toggle="dropdown">
                            <?php $__currentLoopData = json_decode($lang['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data['code']==$local): ?>
                                    <img width="20"
                                         src="<?php echo e(dynamicAsset(path: 'public/assets/front-end/img/flags/'.$data['code'].'.png')); ?>"
                                         alt="<?php echo e($data['name']); ?>">
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php $__currentLoopData = json_decode($lang['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data['status']==1): ?>
                                    <li class="change-language" data-action="<?php echo e(route('change-language')); ?>"
                                        data-language-code="<?php echo e($data['code']); ?>">
                                        <a class="d-flex gap-2 align-items-center justify-content-between dropdown-item <?php echo e($data['code']==$local ? 'active' : ':'); ?>"
                                           href="javascript:">
                                            <div class="d-flex gap-2 align-items-center">
                                                <img width="20"
                                                     src="<?php echo e(dynamicAsset(path: 'public/assets/front-end/img/flags/'.$data['code'].'.png')); ?>"
                                                     alt="<?php echo e($data['name']); ?>"/>
                                                <span class="text-capitalize"><?php echo e($data['name']); ?></span>
                                            </div>
                                            <?php echo $data['code'] == $local ? '<i class="fi fi-rr-check"></i>' : ''; ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </li>

                <?php if(\App\Utils\Helpers::module_permission_check('order_management')): ?>
                    <li class="dropdown nav-item">
                        <a class="btn-icon" href="<?php echo e(route('admin.orders.list',['status'=>'pending'])); ?>"
                           data-bs-toggle="dropdown">
                            <?php ($pendingOrderCount = \App\Models\Order::where('order_status','pending')->count()); ?>
                            <div class="position-relative">
                                <i class="fi fi-sr-shopping-cart fs-18"></i>
                                <?php if($pendingOrderCount > 0): ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo e($pendingOrderCount > 99 ? '99+' : $pendingOrderCount); ?>

                                    <span class="visually-hidden"><?php echo e(translate('pending_Orders')); ?></span>
                                </span>
                                <?php endif; ?>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-cart dropdown-menu-end">
                            <div class="d-flex flex-column gap-2 px-3 pb-2">
                                <button type="button" class="d-flex d-sm-none btn-close border-0 btn-circle w-20 h-20 p-1 fs-10 bg-section2 shadow-none position-absolute top-0 inset-inline-end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="d-flex flex-wrap flex-column flex-sm-row column-gap-1 row-gap-3 justify-content-between py-2">
                                    <div class="d-flex gap-2 align-items-center">
                                        <h4 class="text-capitalize mb-0"><?php echo e(translate('total_orders')); ?></h4>
                                        <span class="text-body-light">
                                            (<?php echo e(\App\Models\Order::where('order_status','pending')->count()); ?>)
                                        </span>
                                    </div>
                                    <a href="<?php echo e(route('admin.orders.list',['status'=>'pending'])); ?>"
                                       class="text-primary d-flex gap-1 lh-1"><?php echo e(translate('view_all')); ?> <i class="fi fi-rr-arrow-small-right"></i></a>
                                </div>
                                <div class="overflow-auto max-h-65vh bg-body rounded">
                                    <div class="py-2 bg-body rounded">
                                        <table
                                        class="table bg-transparent table-borderless align-middle">
                                            <tbody>
                                                <?php $__currentLoopData = $last5Orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <div class="d-flex align-items-center flex-shrink-0 w-100px">
                                                                    <?php ($productImages = []); ?>
                                                                    <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($details?->productAllStatus?->thumbnail_full_url && $details?->productAllStatus?->thumbnail_full_url['status'] === 200): ?>
                                                                        <?php ($productImages[] = $details?->productAllStatus?->thumbnail_full_url); ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(count($productImages)): ?>
                                                                        <?php $__currentLoopData = $productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageKey => $productImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div class="w-100 ms-n-6px dropdown-cart-image <?php echo e($imageKey == 2 ? 'position-relative' : ''); ?> <?php echo e($imageKey > 2 ? 'd-none' : ''); ?>">
                                                                                <img
                                                                                    class="border bg-white rounded object-fit-cover w-100 shadow-left"
                                                                                    height="36" alt="product image"
                                                                                    src="<?php echo e(getStorageImages(path: $productImage, type: 'backend-product')); ?>">
                                                                                <?php if($imageKey == 2 && count($productImages) > 3): ?>
                                                                                    <div class="extra-images rounded">
                                                                                        <span class="extra-image-count">
                                                                                            + <?php echo e(count($productImages) - 3); ?>

                                                                                        </span>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php else: ?>
                                                                        <img class="border bg-white rounded object-fit-cover w-100"
                                                                            height="36" src="https://placehold.co/40x40" alt="placeholder">
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1 fs-12">
                                                                <div class="d-flex gap-2 align-items-center">
                                                                    <div class="min-w-80 text-start"><?php echo e(translate('Order_id')); ?></div>
                                                                    :
                                                                    <span class="text-dark"><?php echo e($order->id); ?></span>
                                                                </div>
                                                                <div class="d-flex gap-2 align-items-center">
                                                                    <div class="min-w-80 text-start"><?php echo e(translate('Order_Amount')); ?></div>
                                                                    :
                                                                    <span class="text-dark">
                                                                        <?php echo e(setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->order_amount), currencyCode: getCurrencyCode())); ?>

                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="<?php echo e(route('admin.orders.details', ['id' => $order['id']])); ?>"
                                                                class="btn btn-outline-primary btn-square">
                                                                    <i class="fi fi-sr-eye"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(\App\Utils\Helpers::module_permission_check('support_section')): ?>
                    <li class="nav-item">
                        <a class="btn-icon" href="<?php echo e(route('admin.contact.list')); ?>"
                           data-bs-title="<?php echo e(translate('message')); ?>" data-bs-toggle="tooltip">
                            <i class="fi fi-sr-comment-alt-dots fs-18"></i>

                            <?php ($message=\App\Models\Contact::where('seen',0)->count()); ?>
                            <?php if($message!=0): ?>
                                <span class="btn-status btn-sm-status btn-status-danger">
                                    <?php echo e($message); ?>

                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <div class="dropdown">
                        <a class="d-flex" href="javascript:" data-bs-toggle="dropdown">
                            <img class="rounded-circle border border-2 min-w-36 aspect-1" width="36"
                                 src="<?php echo e(getStorageImages(path: auth('admin')->user()->image_full_url, type: 'backend-profile')); ?>"
                                 alt="<?php echo e(translate('image_description')); ?>">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="dropdown-item">
                                <div class="media gap-2 align-items-center">
                                    <img class="rounded-circle border border-2 aspect-1" width="40"
                                         src="<?php echo e(getStorageImages(path: auth('admin')->user()->image_full_url, type: 'backend-profile')); ?>"
                                         alt="<?php echo e(translate('image_description')); ?>">

                                    <div class="media-body">
                                        <h4 class="fw-bold mb-1"><?php echo e(auth('admin')->user()->name); ?></h4>
                                        <p class="fs-12 text-body-light fw-medium">
                                            <?php echo e(ucwords(auth('admin')->user()->role->name) ?? ''); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item media gap-2 align-items-center"
                               href="<?php echo e(route('admin.profile.update', ['id' => auth('admin')->user()->id])); ?>">
                                <i class="fi fi-rr-settings text-body-light"></i>
                                <span class="text-truncate media-body" title="<?php echo e(translate('settings')); ?>">
                                    <?php echo e(translate('settings')); ?>

                                </span>
                            </a>
                            <a class="dropdown-item media gap-2 align-items-center" href="javascript:"
                               data-bs-toggle="modal" data-bs-target="#sign-out-modal">
                                <i class="fi fi-sr-sign-out-alt text-body-light"></i>
                                <span class="text-truncate media-body" title="<?php echo e(translate('logout')); ?>">
                                    <?php echo e(translate('logout')); ?>

                                </span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest\POSA\resources\views/layouts/admin/partials/_header.blade.php ENDPATH**/ ?>