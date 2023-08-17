<?php
/**
 * Block Name: Contact us
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$contact_us_hide = get_field_value( $page_fields, 'contact_us_hide' );

/*
* exit if section is hidden
*/
if ( $contact_us_hide ) {
    return;}

$fullHeight = $block['full_height'];
$contact_us_title = get_field_value( $page_fields, 'contact_us_title' );
$contact_us_form = get_field_value( $page_fields, 'contact_us_form' );

?>
<section class="section-contact-us
<?php
echo $fullHeight ? ' section-contact-us_full-height h-100' : ' mt-12 mb-10';
echo esc_html( $class_name );
?>
">
    <div class="contact-us__container container row mx-auto flex-column flex-lg-row<?php echo $fullHeight ? ' h-100' : ''; ?>">
        <div class="contact-us__aside">
            <?php if ( $contact_us_title ) { ?>
                <h2 class="contact-us__title" data-text="<?php echo esc_html( $contact_us_title ); ?>"><span class="contact-us__title_bg"></span><?php echo esc_html( $contact_us_title ); ?></h2>
            <?php } ?>
        </div>
        <div class="contact-us__form<?php echo $fullHeight ? ' d-flex align-items-center' : ''; ?>">
            <?php
            if ( $contact_us_form ) {
                echo do_shortcode( $contact_us_form );
            }
            ?>
            <div class="contact-us__line d-none d-lg-block"></div>
        </div>
    </div>
</section>
