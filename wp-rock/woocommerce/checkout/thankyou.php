<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="container woocommerce-order">
    <div class="woocommerce-thank-you">
        <div class="woocommerce-thank-you__wrapper">
            <?php
            if ( $order ) :

                do_action( 'woocommerce_before_thankyou', $order->get_id() );
                ?>

                <?php if ( $order->has_status( 'failed' ) ) : ?>

                    <p class="woocommerce-thank-you__text"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

                    <p class="woocommerce-thank-you__actions">
                        <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="btn pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
                    </p>

                <?php else : ?>
                    <div class="woocommerce-thank-you__icon"></div>
                    <h2 class="woocommerce-thank-you__title"><?php esc_html_e( 'תודה על ההזמנה', 'wp-rock' ); ?></h2>
                    <p class="woocommerce-thank-you__text"><?php esc_html_e( 'אישור הזמנה נשלח לדוא״ל', 'wp-rock' ); ?></p>
                    <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                        <p class="woocommerce-thank-you__text"><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <?php endif; ?>
                    
                <?php endif; ?>

            <?php else : ?>
                <div class="woocommerce-thank-you__icon"></div>
                <h2 class="woocommerce-thank-you__title"><?php esc_html_e( 'תודה על ההזמנה', 'wp-rock' ); ?></h2>
                <p class="woocommerce-thank-you__text"><?php esc_html_e( 'אישור הזמנה נשלח לדוא״ל', 'wp-rock' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
    

</div>
