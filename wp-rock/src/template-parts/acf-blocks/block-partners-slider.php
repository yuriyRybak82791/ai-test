<?php
/**
 * Block Name: Partners slider
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$partners_slider_hide = get_field_value( $page_fields, 'partners_slider_hide' );
$pag_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$selected_category = ( isset( $_GET['blog-categories'] ) ) ? sanitize_text_field( wp_unslash( $_GET['blog-categories'] ) ) : '';
$selected_order = ( isset( $_GET['blog-order'] ) ) ? sanitize_text_field( wp_unslash( $_GET['blog-order'] ) ) : '';

/*
* exit if section is hidden
*/
if ( $partners_slider_hide || $pag_paged > 1 || ! empty( $selected_category ) || ! empty( $selected_order ) ) {
    return;
}

$partners_slider_slider = get_field_value( $page_fields, 'partners_slider_slider' );

?>
<section class="partners-slider <?php echo esc_attr( $class_name ); ?>">
    <div class="partners-slider__container container">
        <!-- Slider main container -->
        <div class="partners-slider__slider pb-8 pb-lg-0 mb-lg-1 mt-1 swiper js-partners-slider">
            <!-- Additional required wrapper -->
            <div class="partners-slider__wrapper swiper-wrapper">
                <!-- Slides -->
                <?php foreach ( $partners_slider_slider as $item ) { ?>
                    <div class="partners-slider__slide swiper-slide row flex-lg-row-reverse mx-0">

                        <div class="partners-slider__slide-image-wrapper col-lg-6 col-xl-7 px-0">
                            <?php
                            $image = aq_resize( $item['image']['url'], 779, 508, true, false, true );
                            $image_mob = aq_resize( $item['image']['url'], 358, 214, true, false, true );
                            ?>
                            <picture>
                                <source srcset="<?php echo esc_url( $image_mob[0] ); ?>" media="(max-width: 390px)">
                                <img src="<?php echo esc_url( $image[0] ); ?>" class="partners-slider__slide-image"
                                     width="<?php echo esc_attr( $image[1] ); ?>"
                                     height="<?php echo esc_attr( $image[2] ); ?>"
                                     alt="<?php echo esc_attr( $item['title'] ); ?>">
                            </picture>
                        </div>

                        <div class="partners-slider__slide-content d-flex flex-wrap col-lg-6 col-xl-5 px-2 px-lg-4">
                            <div class="partners-slider__slide-logo-wrapper mb-2">
                                <img src="<?php echo esc_url( $item['logo']['url'] ); ?>"
                                     class="partners-slider__slide-logo-image" width="auto" height="auto"
                                     alt="<?php echo esc_attr( $item['logo']['alt'] ); ?>">
                            </div>
                            <div class="partners-slider__slide-heading pt-3 pt-lg-0 pe-2 pe-lg-0">
                                <?php if ( $item['title'] ) { ?>
                                    <h3 class="partners-slider__slide-title font-primary mb-1 mb-lg-0"><?php echo esc_html( $item['title'] ); ?></h3>
                                <?php } ?>
                                <?php if ( $item['text'] ) { ?>
                                    <p class="partners-slider__slide-text mb-0"><?php echo esc_html( $item['text'] ); ?></p>
                                <?php } ?>
                            </div>
                            <div class="partners-slider__slide-body py-1 my-2 py-lg-3 my-lg-3 w-100">
                                <?php if ( $item['title_2'] ) { ?>
                                    <h3 class="partners-slider__slide-second-title font-primary"><?php echo esc_html( $item['title_2'] ); ?></h3>
                                <?php } ?>
                                <?php if ( $item['text_2'] ) { ?>
                                    <p class="partners-slider__slide-text mb-1 mb-lg-0"><?php echo esc_html( $item['text_2'] ); ?></p>
                                <?php } ?>
                            </div>
                            <?php if ( $item['description'] ) { ?>
                                <p class="partners-slider__slide-description w-100"><?php echo esc_html( $item['description'] ); ?></p>
                            <?php } ?>
                            <?php if ( $item['button'] ) { ?>
                                <div class="partners-slider__slide-button-wrapper mt-3 mt-lg-auto w-100">
                                    <a href="<?php echo esc_url( $item['button']['url'] ); ?>"
                                       class="partners-slider__slide-button btn btn-arrow"<?php echo( $item['button']['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $item['button']['title'] ); ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination d-lg-none"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button swiper-button-prev d-none d-lg-block"></div>
            <div class="swiper-button swiper-button-next d-none d-lg-block"></div>
        </div>
    </div>
</section>
