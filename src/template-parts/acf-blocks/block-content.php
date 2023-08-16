<?php
/**
 * Block Name: Content
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';

$content = get_field_value( $page_fields, 'content' );

?>
<section class="section-content my-8">
    <div class="content__container container">
        <?php echo apply_filters( 'the_content', $content ); ?>
    </div>
</section>
