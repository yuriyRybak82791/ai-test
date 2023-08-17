<?php
/**
 * Checkout terms and conditions area.
 *
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( apply_filters( 'woocommerce_checkout_show_terms', true ) && function_exists( 'wc_terms_and_conditions_checkbox_enabled' ) ) {
    do_action( 'woocommerce_checkout_before_terms_and_conditions' );

    ?>
    <div class="woocommerce-terms-and-conditions-wrapper">

        <?php if ( wc_terms_and_conditions_checkbox_enabled() ) : ?>
            <p class="form-row validate-required styled-checkbox woocommerce-form-checkbox">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox styled-checkbox__label">
                <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox styled-checkbox__checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); // WPCS: input var ok, csrf ok. ?> id="terms" />
                    <span class="woocommerce-terms-and-conditions-checkbox-text styled-checkbox__span"><?php wc_terms_and_conditions_checkbox_text(); ?></span>
                </label>
                <input type="hidden" name="terms-field" value="1" />
            </p>
        <?php endif; ?>

        <?php
        /**
         * Terms and conditions hook used to inject content.
         *
         * @since 3.4.0.
         * @hooked wc_checkout_privacy_policy_text() Shows custom privacy policy text. Priority 20.
         * @hooked wc_terms_and_conditions_page_content() Shows t&c page content. Priority 30.
         */
        do_action( 'woocommerce_checkout_terms_and_conditions' );
        ?>
    </div>
    <?php

    do_action( 'woocommerce_checkout_after_terms_and_conditions' );
}
