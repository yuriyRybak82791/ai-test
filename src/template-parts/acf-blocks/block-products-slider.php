<?php
/**
 * Block Name: External news
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$products_slider_hide = get_field_value( $page_fields, 'products_slider_hide' );

/*
* exit if section is hidden
*/
if ( $products_slider_hide ) {
    return;
}

$products_slider_title = get_field_value( $page_fields, 'products_slider_title' );
$products_slider_text = get_field_value( $page_fields, 'products_slider_text' );
$products_slider_button = get_field_value( $page_fields, 'products_slider_button' );
$products_slider_list = get_field_value( $page_fields, 'products_slider_list' );

?>
<section class="products-slider mt-8 mb-8 mb-lg-12 <?php echo esc_html( $class_name ); ?>">
    <div class="products-slider__container">
        <div class="products-slider__heading">
            <?php if ( $products_slider_title ) { ?>
                <h2 class="products-slider__heading-title mb-1"><?php echo $products_slider_title; ?></h2>
            <?php } ?>
            <?php if ( $products_slider_text ) { ?>
                <p class="products-slider__heading-text"><?php echo esc_html( $products_slider_text ); ?></p>
            <?php } ?>
            <?php if ( $products_slider_button ) { ?>
                <div class="products-slider__heading-button-wrapper d-none d-lg-block mt-5">
                    <a href="<?php echo esc_url( $products_slider_button['url'] ); ?>"
                       class="products-slider__heading-button btn btn-big btn-arrow"<?php echo( $products_slider_button['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $products_slider_button['title'] ); ?></a>
                </div>
            <?php } ?>
        </div>
        <div class="swiper products-slider__slider js-products-slider">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper products-slider__swapper">
                <!-- Slides -->
                <?php foreach ( $products_slider_list as $slide ) { ?>
                    <div class="products-slider__slide swiper-slide">
                        <a href="<?php echo esc_url( $slide['link'] ); ?>"
                           class="products-slider__slide-link">
                            <span class="products-slider__slide-image-wrapper">
                                <?php
                                $image = aq_resize( $slide['image']['url'], 594, 602, true, false, true );
                                $image_mob = aq_resize( $slide['image']['url'], 304, 325, true, false, true );
                                ?>
                                <picture>
                                    <source srcset="<?php echo esc_url( $image_mob[0] ); ?>" media="(max-width: 390px)">
                                    <img src="<?php echo esc_url( $image[0] ); ?>"
                                         class="products-slider__slide-image"
                                         width="<?php echo esc_html( $image[1] ); ?>"
                                         height="<?php echo esc_html( $image[2] ); ?>"
                                         alt="<?php echo esc_html( $slide['name'] ); ?>">
                                </picture>
                            </span>
                            <span class="products-slider__slide-bottom">
                            <?php if ( $slide['name'] ) { ?>
                                <span class="products-slider__slide-bottom-name"><?php echo esc_html( $slide['name'] ); ?></span>
                            <?php } ?>
                                <?php if ( $slide['price'] ) { ?>
                                    <span class="products-slider__slide-bottom-price"><?php echo esc_html( $slide['price'] ); ?></span>
                                <?php } ?>
                            </span>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination d-lg-none"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev d-none d-lg-block"></div>
            <div class="swiper-button-next d-none d-lg-block"></div>
        </div>
        <?php if ( $products_slider_button ) { ?>
            <div class="products-slider__heading-button-wrapper d-lg-none text-center">
                <a href="<?php echo esc_url( $products_slider_button['url'] ); ?>"
                   class="products-slider__heading-button btn btn-arrow"<?php echo( $products_slider_button['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $products_slider_button['title'] ); ?></a>
            </div>
        <?php } ?>
    </div>
</section>
