<?php
/**
 * Block Name: Text content
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$text_content_hide = get_field_value( $page_fields, 'text_content_hide' );
$text_content_content = get_field_value( $page_fields, 'text_content_content' );
/*
* exit if section is hidden
*/
if ( $text_content_hide || ! $text_content_content ) {
    return;}

?>
<section class="text-content-section mb-6 mb-md-11 mt-5 mt-sm-11 <?php echo esc_html( $class_name ); ?>">
    <div class="container">
        <div class="text-content-section__container">
        <?php echo $text_content_content; ?>
        </div>
    </div>
</section>
