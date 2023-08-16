<?php
/**
 * Block Name: Partners logo slider
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$partners_logo_slider_hide = get_field_value( $page_fields, 'partners_logo_slider_hide' );
$partners_logo_slider_logos = get_field_value( $page_fields, 'partners_logo_slider_logos' );
/*
* exit if section is hidden
*/
if ( $partners_logo_slider_hide || ! $partners_logo_slider_logos ) {
    return;}

$partners_logo_slider_title = get_field_value( $page_fields, 'partners_logo_slider_title' );


?>
<section class="partners-logo-slider mt-8 mb-10 mb-lg-8 <?php echo esc_html( $class_name ); ?>">
    <div class="partners-logo-slider__container">
        <?php if ( $partners_logo_slider_title ) { ?>
            <h2 class="partners-logo-slider__title"><?php echo esc_html( $partners_logo_slider_title ); ?></h2>
        <?php } ?>
        <div class="swiper partners-logo-slider__slider js-partners-logo-slider">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper partners-logo-slider__wrapper">
                <?php foreach ( $partners_logo_slider_logos as $slide ) { ?>
                    <?php if ( ! empty( $slide['image'] ) ) { ?>
                    <div class="swiper-slide partners-logo-slider__slide">
                        <?php
                            $logo_width = 0 === $item['logo']['width'] ? 'auto' : $item['logo']['width'];
                            $logo_height = 0 === $item['logo']['height'] ? 'auto' : $item['logo']['height'];
                        ?>
                        <img src="<?php echo esc_url( $slide['image']['url'] ); ?>" class="partners-logo-slider__slide-image" width="<?php echo esc_attr( $logo_width ); ?>" height="<?php echo esc_attr( $logo_height ); ?>" alt="<?php echo esc_html( $slide['image']['alt'] ); ?>">
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
