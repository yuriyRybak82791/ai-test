<?php
/**
 * Block Name: Banner
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';

$banner_desktop_image = get_field_value( $page_fields, 'banner_desktop_image' );
$banner_tablet_image = get_field_value( $page_fields, 'banner_tablet_image' );
$banner_mobile_image = get_field_value( $page_fields, 'banner_mobile_image' );
$banner_subtitle = get_field_value( $page_fields, 'banner_subtitle' );
$banner_title = get_field_value( $page_fields, 'banner_title' );
$banner_show_logo = get_field_value( $page_fields, 'banner_show_logo' );
$banner_logo = get_field_value( $page_fields, 'banner_logo' );

?>
<section class="page-banner mb-5 mb-sm-8 mb-lg-10 <?php echo esc_html( $class_name ); ?>">
    <div class="page-banner__container">
        <?php // $image = aq_resize( $banner_desktop_image['url'], 1440, 505, true, false, true ); ?>
        <picture>
            <?php
            if ( $banner_mobile_image ) {
                // $image_mob = aq_resize( $banner_mobile_image['url'], 390, 434, true, false, true );
                ?>
                <source srcset="<?php echo esc_url( $banner_mobile_image['url'] ); ?>" media="(max-width: 575px)">
            <?php } ?>
            <?php
            if ( $banner_tablet_image ) {
                // $image_tablet = aq_resize( $banner_tablet_image['url'], 768, 265, true, false, true );
                ?>
                <source srcset="<?php echo esc_url( $banner_tablet_image['url'] ); ?>" media="(max-width: 768px)">
            <?php } ?>            
            <img src="<?php echo esc_url( $banner_desktop_image['url'] ); ?>" class="page-banner__image" width="1440" height="505" alt="<?php echo esc_attr( $banner_title ); ?>">
        </picture>
        <div class="page-banner__content">
            <?php if ( $banner_subtitle ) { ?>
                <h2 class="page-banner__subtitle"><?php echo esc_html( $banner_subtitle ); ?></h2>
            <?php } ?>
            <?php if ( $banner_title ) { ?>
                <h1 class="page-banner__title"><?php echo esc_html( $banner_title ); ?></h1>
            <?php } ?>
        </div>
        <?php if ( $banner_show_logo && $banner_logo ) { ?>
            <?php
                $logo_width = 0 === $banner_logo['width'] ? 'auto' : $banner_logo['width'];
                $logo_height = 0 === $banner_logo['height'] ? 'auto' : $banner_logo['height'];
            ?>
            <img src="<?php echo esc_url( $banner_logo['url'] ); ?>" class="page-banner__logo" width="<?php echo esc_attr( $logo_width ); ?>" height="<?php echo esc_attr( $logo_height ); ?>" alt="<?php echo esc_attr( $banner_logo['alt'] ); ?>">
        <?php } ?>
    </div>
</section>
