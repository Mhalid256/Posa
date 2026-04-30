<?php echo $__env->make("layouts.admin.partials.offcanvas._view-guideline-button", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasSetupGuide" aria-labelledby="offcanvasSetupGuideLabel"
     data-status="<?php echo e(request('offcanvasShow') && request('offcanvasShow') == 'offcanvasSetupGuide' ? 'show' : ''); ?>">

    <div class="offcanvas-header bg-body">
        <h3 class="mb-0"><?php echo e(translate('business_setup')); ?></h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        <div class="p-12 p-sm-20 bg-section rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_01" aria-expanded="true">
                    <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                        <i class="fi fi-sr-angle-right"></i>
                    </div>
                    <span class="fw-bold text-start"><?php echo e(translate('maintenance_mode')); ?></span>
                </button>

            </div>

            <div class="collapse mt-3 show" id="collapseGeneralSetup_01">
                <div class="card card-body">
                    <p class="fs-12">
                        <?php echo e(translate('turning_on_maintenance_mode_will_temporarily_close_your_online_store.') . ' ' . translate('so_that_the_admin_can_do_important_updates_or_fixes.')); ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="p-12 p-sm-20 bg-section rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_02" aria-expanded="true">
                    <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                        <i class="fi fi-sr-angle-right"></i>
                    </div>
                    <span class="fw-bold text-start"><?php echo e(translate('basic_information')); ?></span>
                </button>

            </div>

            <div class="collapse mt-3" id="collapseGeneralSetup_02">
                <div class="card card-body">
                    <p class="fs-12">
                        <strong><?php echo e(translate('company_Name')); ?>:</strong>
                        <?php echo e(translate('the_company_name_often_serves_as_the_primary_identifier_for_your_business_as_a_legal_entity.')); ?>

                    </p>
                    <p class="fs-12">
                        <strong><?php echo e(translate('email')); ?>:</strong>
                        <?php echo e(translate('a_company_email_system_often_provides_centralized_management_and_archiving_of_business_communications.')); ?>

                    </p>
                    <p class="fs-12">
                        <strong><?php echo e(translate('phone')); ?>:</strong>
                        <?php echo e(translate('a_phone_number_provides_customers_and_partners_with_a_direct_and_immediate_way_to_reach_your_business_for_urgent_inquiries,_support_needs,_or_quick_questions.')); ?>

                    </p>
                    <p class="fs-12">
                        <strong><?php echo e(translate('country')); ?>:</strong>
                        <?php echo e(translate('country_name_field_when_setting_up_a_business_is_essential_for_a_multitude_of_reasons,_touching_upon_legal,_operational,_financial,_and_marketing_aspects.')); ?>

                    </p>
                    <p class="fs-12">
                        <strong><?php echo e(translate('address')); ?>:</strong>
                        <?php echo e(translate('an_address_is_legally_required_in_every_country_and_builds_trust_with_your_customers_online._')); ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="p-12 p-sm-20 bg-section rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_03" aria-expanded="true">
                    <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                        <i class="fi fi-sr-angle-right"></i>
                    </div>
                    <span class="fw-bold text-start"><?php echo e(translate('general_setup')); ?></span>
                </button>

            </div>

            <div class="collapse mt-3" id="collapseGeneralSetup_03">
                <div class="card card-body">
                    <p class="fs-12">
                        <?php echo e(translate('general_setup_is_the_foundational_step_where_you_configure_essential_business_details_like_your_address,_legal_information,_and_basic_operational_settings.')); ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="p-12 p-sm-20 bg-section rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_04" aria-expanded="true">
                    <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                        <i class="fi fi-sr-angle-right"></i>
                    </div>
                    <span class="fw-bold text-start"><?php echo e(translate('currency_setup')); ?></span>
                </button>

            </div>

            <div class="collapse mt-3" id="collapseGeneralSetup_04">
                <div class="card card-body">
                    <p class="fs-12">
                        <?php echo e(translate('currency_setup_lets_you_choose_the_main_(default)_currency_for_your_online_store.')); ?>

                    </p>
                    <p class="fs-12">
                        <?php echo e(translate('you_can_add_multiple_currencies_from_the_currency_setup_page.') . ' ' . translate('but_the_default_currency_is_the_one_you_select_from_this_dropdown.')); ?>

                    </p>
                    <p class="fs-12">
                        <?php echo e(translate('currency_position_allows_you_to_choose_where_the_currency_symbol_appears_before_(left)_or_after_(right)_the_amount.')); ?>

                    </p>
                    <p class="fs-12">
                        <?php echo e(translate('digits_after_decimal_point_means_how_many_numbers_will_be_shown_after_the_decimal_point_(for_example_10.00_or_10.000).')); ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="p-12 p-sm-20 bg-section rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_05" aria-expanded="true">
                    <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                        <i class="fi fi-sr-angle-right"></i>
                    </div>
                    <span class="fw-bold text-start"><?php echo e(translate('business_model_setup')); ?></span>
                </button>

            </div>

            <div class="collapse mt-3" id="collapseGeneralSetup_05">
                <div class="card card-body">
                    <h5> <?php echo e(translate('single_vendor')); ?></h5>
                    <p class="fs-12">
                        <?php echo e(translate('a_single_vendor_e-commerce_setup_means_one_business_or_individual_is_selling_their_own_products_or_services_directly_to_customers_through_their_online_store.')); ?>

                    </p>
                    <h5> <?php echo e(translate('multi_vendor')); ?></h5>
                    <p class="fs-12">
                        <?php echo e(translate('a_multi_vendor_e-commerce_setup_is_like_an_online_shopping_mall_where_multiple_independent_sellers_can_list_and_sell_their_products_or_services_all_on_the_same_website.')); ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="p-12 p-sm-20 bg-section rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_06" aria-expanded="true">
                    <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                        <i class="fi fi-sr-angle-right"></i>
                    </div>
                    <span class="fw-bold text-start"><?php echo e(translate('payment_options')); ?></span>
                </button>

            </div>

            <div class="collapse mt-3" id="collapseGeneralSetup_06">
                <div class="card card-body">
                    <h5> <?php echo e(translate('cash_on_delivery')); ?></h5>
                    <p class="fs-12">
                        <?php echo e(translate('cash_on_delivery_(cod)_means_customers_pay_for_their_online_order_with_cash_when_the_delivery_person_brings_it_to_their_address.') . ' ' . translate('they_deliver_the_products_and_then_collect_the_payment_and_forward_it_to_your_business.')); ?>

                    </p>
                    <h5> <?php echo e(translate('digital_payment')); ?></h5>
                    <p class="fs-12">
                        <?php echo e(translate('digital_payment_lets_customers_pay_online_for_their_orders_using_methods_like_mobile_wallets_eg_(bkash,_nagad,_rocket)_credit_debit_cards_or_internet_banking_integrated_within_the_system_when_the_order_is_placed.') . ' ' . translate('it_is_processed_automatically_and_sent_to_the_business_account_of_admin.')); ?>

                    </p>
                    <h5> <?php echo e(translate('offline_payment')); ?></h5>
                    <p class="fs-12">
                        <?php echo e(translate('offline_payment_means_the_customer_places_an_order_on_your_website_but_pays_later_using_a_method_outside_the_website_like_a_direct_bank_transfer_or_paying_cash_in_person.') . ' ' . translate('after_the_payment,_the_customer_or_admin_must_update_the_payment_details_in_the_order.')); ?>

                    </p>
                    <p class="fs-12">
                        <?php echo e(translate('the_admin_will_then_check_the_payment_and_manually_confirm_the_order.')); ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="p-12 p-sm-20 bg-section rounded mb-3 mb-sm-20">
            <div class="d-flex gap-3 align-items-center justify-content-between overflow-hidden">
                <button class="btn-collapse d-flex gap-3 align-items-center bg-transparent border-0 p-0 collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseGeneralSetup_07" aria-expanded="true">
                    <div class="btn-collapse-icon border bg-light icon-btn rounded-circle text-dark collapsed">
                        <i class="fi fi-sr-angle-right"></i>
                    </div>
                    <span class="fw-bold text-start"><?php echo e(translate('copyright_&_cookies_text')); ?></span>
                </button>

            </div>

            <div class="collapse mt-3" id="collapseGeneralSetup_07">
                <div class="card card-body">
                    <h5> <?php echo e(translate('copyright_text')); ?></h5>
                    <p class="fs-12">
                        <?php echo e(translate('this_is_a_short_statement_that_shows_your_company_owns_the_content_on_your_website.') . ' ' . translate('it_usually_includes_the_copyright_symbol_(©),_the_year,_and_your_company_name.')); ?>

                    </p>
                    <p class="fs-12">
                        <?php echo e(translate('it_tells_others_that_the_content_is_protected_by_copyright_law_and_cannot_be_copied_or_used_without_permission.')); ?>

                    </p>
                    <h5> <?php echo e(translate('company_cookies_text')); ?></h5>
                    <p class="fs-12">
                        <?php echo e(translate('this_is_a_short_message_shown_on_the_website_to_let_visitors_know_that_the_site_uses_cookies_to_collect_information_and_improve_their_browsing_experience.')); ?>

                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
<?php /**PATH C:\Users\musas\Desktop\softwares\6valley\POSA-latest version\POSA\resources\views/layouts/admin/partials/offcanvas/_general-setup.blade.php ENDPATH**/ ?>