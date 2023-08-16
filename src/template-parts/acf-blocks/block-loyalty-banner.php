<?php
/**
 * Block Name: Loyalty banner
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';

$loyalty_banner_desktop_image = get_field_value( $page_fields, 'loyalty_banner_desktop_image' );
$loyalty_banner_tablet_image = get_field_value( $page_fields, 'loyalty_banner_tablet_image' );
$loyalty_banner_mobile_image = get_field_value( $page_fields, 'loyalty_banner_mobile_image' );
$loyalty_banner_logo = get_field_value( $page_fields, 'loyalty_banner_logo' );
$loyalty_banner_title = get_field_value( $page_fields, 'loyalty_banner_title' );
$loyalty_banner_text = get_field_value( $page_fields, 'loyalty_banner_text' );
$loyalty_banner_button = get_field_value( $page_fields, 'loyalty_banner_button' );

if ( $loyalty_banner_tablet_image ) {
    $image_tablet_url = $loyalty_banner_tablet_image['url'];
} else {
    $image_tablet = aq_resize( $loyalty_banner_desktop_image['url'], 768, 265, true, false, true );
    $image_tablet_url = $image_tablet[0];
}
if ( $loyalty_banner_mobile_image ) {
    $image_mob_big_url = $loyalty_banner_mobile_image['url'];
    $image_mob = aq_resize( $loyalty_banner_mobile_image['url'], 390, 434, true, false, true );
    $image_mob_url = $image_mob[0];
} else {
    $image_mob_big = aq_resize( $loyalty_banner_desktop_image['url'], 575, 642, true, false, true );
    $image_mob = aq_resize( $loyalty_banner_desktop_image['url'], 390, 434, true, false, true );
    $image_mob_big_url = $image_mob_big[0];
    $image_mob_url = $image_mob[0];
}

?>
<section class="page-loyalty-banner <?php echo esc_html( $class_name ); ?>">
    <div class="page-loyalty-banner__container">
        <div class="page-loyalty-banner__image-wrapper">
            <picture>
                <source srcset="<?php echo esc_url( $image_mob_url ); ?>" media="(max-width: 390px)">
                <source srcset="<?php echo esc_url( $image_mob_big_url ); ?>" media="(max-width: 575px)">
                <source srcset="<?php echo esc_url( $loyalty_banner_tablet_image['url'] ); ?>" media="(max-width: 768px)">
                <?php $image_desktop = aq_resize( $loyalty_banner_desktop_image['url'], 1440, 494, true, false, true ); ?>
                <source srcset="<?php echo esc_url( $image_desktop[0] ); ?>" media="(max-width: 1440px)">        
                <img src="<?php echo esc_url( $loyalty_banner_desktop_image['url'] ); ?>" class="page-loyalty-banner__image" width="1920" height="658" alt="<?php echo esc_attr( $loyalty_banner_title ); ?>">
            </picture>
            <?php
                $logo_width = 0 === $loyalty_banner_logo['width'] ? 'auto' : $loyalty_banner_logo['width'];
                $logo_height = 0 === $loyalty_banner_logo['height'] ? 'auto' : $loyalty_banner_logo['height'];
            ?>
            <img src="<?php echo esc_url( $loyalty_banner_logo['url'] ); ?>" class="page-loyalty-banner__logo" width="<?php echo esc_attr( $logo_width ); ?>" height="<?php echo esc_attr( $logo_height ); ?>" alt="<?php echo esc_attr( $loyalty_banner_logo['alt'] ); ?>">
            <div class="figure figure-1"></div>
            <div class="figure figure-2"></div>
        </div>
        <div class="page-loyalty-banner__content">
            <div class="page-loyalty-banner__content-wrapper">
                <?php if ( $loyalty_banner_title ) { ?>
                    <h1 class="page-loyalty-banner__title text-center"><?php echo esc_html( $loyalty_banner_title ); ?></h1>
                <?php } ?>
                <?php if ( $loyalty_banner_text ) { ?>
                    <p class="page-loyalty-banner__text text-center text-center"><?php echo esc_html( $loyalty_banner_text ); ?></p>
                <?php } ?>
                <?php if ( $loyalty_banner_button ) { ?>
                    <div class="page-loyalty-banner__button-wrapper text-center">
                        <a href="<?php echo esc_url( $loyalty_banner_button ['url'] ); ?>"
                        class="page-loyalty-banner__button btn btn-arrow"<?php echo( $loyalty_banner_button ['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $loyalty_banner_button ['title'] ); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
