<?php
/**
 * Block Name: Live stream
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$live_stream_hide = get_field_value( $page_fields, 'live_stream_hide' );
$live_stream_stream = get_field_value( $page_fields, 'live_stream_stream' );
/*
* exit if section is hidden
*/
if ( $live_stream_hide || ! $live_stream_stream ) {
    return;}



?>
<section class="live-stream-section mb-6 mb-md-11 mt-6 mt-sm-11 <?php echo esc_html( $class_name ); ?>">
    <div class="container live-stream-section__container">
        <iframe src="<?php echo esc_url( $live_stream_stream ); ?>" class="live-stream-section__iframe" width="100%" height="100%" allowfullscreen webkitallowfullscreen frameborder="0"></iframe>
    </div>
</section>
