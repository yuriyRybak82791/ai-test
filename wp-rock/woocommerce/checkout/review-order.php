<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table checkout-order-table">
    <div class="checkout-order-table__products">
    <?php
        do_action( 'woocommerce_review_order_before_cart_contents' );

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            ?>
                <div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> checkout-order-table__item">
                    <div class="checkout-order-table__product-info">
                        <div class="checkout-order-table__product-thumbnail">
                    <?php
                        echo wp_get_attachment_image( $_product->get_image_id(), 'full', false );
                    ?>
                        </div>
                        <p class="checkout-order-table__product-name">
                        <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                        </p>
                    </div>
                    <div class="checkout-order-table__product-total">
                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>
                </div>
                <?php
        }
    }

        do_action( 'woocommerce_review_order_after_cart_contents' );
    ?>
    </div>
    
    <div class="checkout-order-table__bottom">
        <div class="checkout-order-table__subtotal checkout-order-table__bottom-item">
            <div class="checkout-order-table__bottom-label"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div>
            <div class="checkout-order-table__bottom-value"><?php wc_cart_totals_subtotal_html(); ?></div>
        </div>
        <div class="checkout-order-table__shipping checkout-order-table__bottom-item">
            <?php
                // Get the chosen shipping method(s).
                $chosen_shipping_methods = WC()->session->get( 'chosen_shipping_methods' );

                // Get the first chosen shipping method ID.
                $chosen_shipping_method_id = $chosen_shipping_methods[0];

                // Get all available shipping packages.
                $packages = WC()->shipping->get_packages();

                // Get the first package.
                $package = $packages[0];

                // Get the rates for the first package.
                $rates = $package['rates'];

                // Get the selected shipping method rate.
                $chosen_rate = $rates[ $chosen_shipping_method_id ];

                // Get the selected shipping method name.
                $chosen_shipping_method_name = $chosen_rate->get_label();

                // Get the selected shipping method cost.
                $chosen_shipping_method_cost = WC()->cart->get_cart_shipping_total();
            if ( ! empty( $chosen_shipping_method_name ) ) {
                ?>
                <div class="checkout-order-table__bottom-label"><?php echo esc_html( $chosen_shipping_method_name ); ?></div>
                <div class="checkout-order-table__bottom-value"><?php echo $chosen_shipping_method_cost; ?></div>
                <?php
            }
            ?>
            
        </div>
    </div>
    <div class="checkout-order-table__footer">
        <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
        <div class="checkout-order-table__subtotal checkout-order-table__footer-item">
            <div class="checkout-order-table__footer-side">
                <div class="checkout-order-table__footer-label">
                    <?php esc_html_e( 'Total', 'woocommerce' ); ?>
                </div>
                <div class="checkout-order-table__footer-tax">
                    <?php
                    if ( 'itemized' !== get_option( 'woocommerce_tax_total_display' ) ) {
                        esc_html_e( 'כולל ', 'wp-rock' );
                        wc_cart_totals_taxes_total_html();
                        esc_html_e( ' מע״מ', 'wp-rock' );

                    }
                    ?>
                </div>
                
            </div>
            <div class="checkout-order-table__footer-value"><?php wc_cart_totals_order_total_html(); ?></div>
        </div>
        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
    </div>
</div>

