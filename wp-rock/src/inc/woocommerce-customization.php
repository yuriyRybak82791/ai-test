<?php
/**
 * Woocommerce customization
 *
 * @package woocommerce/customization
 */

 /**
  * Add the opening <div> for the wrapper before the checkout form
  *
  * @return string
  */
function custom_before_checkout_form() {
    echo '<div class="container checkout-container">';
}
add_action( 'woocommerce_before_checkout_form', 'custom_before_checkout_form', 0 );

/**
 * Add the closing </div> for the wrapper after the checkout form
 *
 * @return string
 */
function custom_after_checkout_form() {
    echo '</div>';
}
add_action( 'woocommerce_after_checkout_form', 'custom_after_checkout_form', 0 );

/**
 * Redirect the Add-to-Cart action from the shop page and individual product page to the Checkout page
 *
 * @return string
*/
add_filter( 'add_to_cart_redirect', 'wp_rock_add_to_cart_redirect' );
function wp_rock_add_to_cart_redirect() {
    global $woocommerce;
    $wp_rock_redirect_checkout = $woocommerce->cart->get_checkout_url();
    return $wp_rock_redirect_checkout;
}

/**
 * Remove order review table on checkout(before order pay)
*/
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );

/**
 * Removes Order Notes Title - Additional Information & Notes Field
*/
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

/**
 * Modify the WooCommerce privacy policy text on the checkout page using the 'woocommerce_get_privacy_policy_text' filter.
 *
 * @param string $text The default privacy policy text.
 * @return string Modified privacy policy text to display on the checkout page.
 */
function custom_woocommerce_privacy_policy_text( $text ) {
    $custom_text = '<a href="' . get_privacy_policy_url() . '">' . esc_html__( 'למדיניות הפרטיות', 'wp-rock' ) . '</a>';
    return $custom_text;
}

// Add the filter to customize the privacy policy text on the checkout page.
add_filter( 'woocommerce_get_privacy_policy_text', 'custom_woocommerce_privacy_policy_text' );

/**
 * Modify the WooCommerce checkout button HTML.
 *
 * @param string $button_html Default button HTML.
 * @return string Modified button HTML.
 */
function custom_checkout_button_html( $button_html ) {
    // Change the button label to your desired text.
    $button_label = esc_html__( 'מעבר לתשלום', 'wp-rock' );

    // Add a new class to the checkout button.
    // $button_html = str_replace( 'button', 'button ', $button_html );

    // Replace the default button label with the custom one.
    $button_html = str_replace( 'Place order', $button_label, $button_html );

    return $button_html;
}

// Add the filter to customize the checkout button.
add_filter( 'woocommerce_order_button_html', 'custom_checkout_button_html' );

/**
 * Edit fields on checkout page.
 *
 * @param array $fields The array containing the checkout fields.
 * @return array The modified array after removing the phone field.
 */
function wp_rock_custom_checkout_fields( $fields ) {
    // remove fields
    unset( $fields['billing']['billing_company'] );

    return $fields;

}
add_filter( 'woocommerce_checkout_fields', 'wp_rock_custom_checkout_fields' );

/**
 * Add custom required checkbox field before "Terms and Conditions" on the WooCommerce checkout page.
 */
function add_custom_checkbox_before_terms() {
    // Output the checkbox field HTML.
    ?>
    <p class="form-row agree-receive-hta-messages styled-checkbox woocommerce-form-checkbox"> 
        <label class="styled-checkbox__label" for="agree_receive_hta_messages">
            <input type="checkbox" class="input-checkbox styled-checkbox__checkbox" name="agree_receive_hta_messages" id="agree_receive_hta_messages" value="1" />
            <span class="styled-checkbox__span"><?php esc_html_e( 'אני מאשר קבלת מסרים שיווקיים באמצעות דוא״ל ו/או מסרונים מטעם מועדון הנאמנות של אוהדים הפועל תל אביב', 'wp-rock' ); ?></span>
        </label>
    </p>
    <?php
}
add_action( 'woocommerce_checkout_terms_and_conditions', 'add_custom_checkbox_before_terms', 10 );

/**
 * Validate the custom checkbox field.
 */
function custom_checkbox_validation() {
    // if (empty($_POST['agree_receive_hta_messages']) || '1' != $_POST['agree_receive_hta_messages'] ) {
    // wc_add_notice('Please check the Custom Checkbox before proceeding.', 'error');
    // }
}
add_action( 'woocommerce_checkout_process', 'custom_checkbox_validation' );

/**
 * Change the text of the WooCommerce "Terms and Conditions" checkbox label.
 *
 * @param string $text The default checkbox label text.
 * @return string The modified checkbox label text.
 */
function change_terms_and_conditions_checkbox_text( $text ) {
    // Change the checkbox label text to your desired text.
    $new_text = 'אני מסכים <a href="' . get_permalink( get_option( 'woocommerce_terms_page_id' ) ) . '">לתנאי התקנון</a>'; // Replace this with your custom text.
    return $new_text;
}
add_filter( 'woocommerce_get_terms_and_conditions_checkbox_text', 'change_terms_and_conditions_checkbox_text' );
