<?php
/**
 * Block Name: Banner v2
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';

$banner_v2_desktop_image = get_field_value( $page_fields, 'banner_v2_desktop_image' );
$banner_v2_tablet_image = get_field_value( $page_fields, 'banner_v2_tablet_image' );
$banner_v2_mobile_image = get_field_value( $page_fields, 'banner_v2_mobile_image' );
$banner_v2_title = get_field_value( $page_fields, 'banner_v2_title' );

?>
<section class="page-banner-v2 <?php echo esc_html( $class_name ); ?>">
    <div class="page-banner-v2__container">
        <?php // $image = aq_resize( $banner_v2_desktop_image['url'], 1440, 505, true, false, true ); ?>
        <picture>
            <?php
            if ( $banner_v2_mobile_image ) {
                // $image_mob = aq_resize( $banner_v2_mobile_image['url'], 390, 434, true, false, true );
                ?>
                <source srcset="<?php echo esc_url( $banner_v2_mobile_image['url'] ); ?>" media="(max-width: 575px)">
            <?php } ?>
            <?php
            if ( $banner_v2_tablet_image ) {
                // $image_tablet = aq_resize( $banner_v2_tablet_image['url'], 768, 265, true, false, true );
                ?>
                <source srcset="<?php echo esc_url( $banner_v2_tablet_image['url'] ); ?>" media="(max-width: 768px)">
            <?php } ?>            
            <img src="<?php echo esc_url( $banner_v2_desktop_image['url'] ); ?>" class="page-banner-v2__image" width="1440" height="505" alt="<?php echo esc_html( $banner_v2_title ); ?>">
        </picture>
        <div class="page-banner-v2__content px-2">
            <?php if ( $banner_v2_title ) { ?>
                <h1 class="page-banner-v2__title" data-text="<?php echo esc_html( $banner_v2_title ); ?>"><span class="page-banner-v2__title_bg"></span> <?php echo esc_html( $banner_v2_title ); ?></h1>
            <?php } ?>
        </div>
    </div>
</section>
