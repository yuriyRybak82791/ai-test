<?php
/**
 * Block Name: Timeline slider
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$timeline_slider_hide = get_field_value( $page_fields, 'timeline_slider_hide' );

/*
* exit if section is hidden
*/
if ( $timeline_slider_hide ) {
    return;}

$timeline_slider_title = get_field_value( $page_fields, 'timeline_slider_title' );
$timeline_slider_slider = get_field_value( $page_fields, 'timeline_slider_slider' );

?>

<section class="timeline-slider mt-9 mt-lg-14 <?php echo esc_html( $class_name ); ?>">
    <div class="container">
        <?php if ( $timeline_slider_title ) { ?>
            <h2 class="timeline-slider__title"><?php echo $timeline_slider_title; ?></h2>
        <?php } ?>
    </div>
    <?php if ( $timeline_slider_slider ) { ?>
        <div class="timeline-slider__timeline-images">
            <div class="timeline-slider__timeline-images__slider swiper js-timeline-slider-timeline-images">
                <!-- Additional required wrapper -->
                <div class="timeline-slider__timeline-images__wrapper swiper-wrapper">
                    <!-- Slides -->
                    <?php
                    $i = 0;
                    ?>
                    <?php
                    $i++;
                    foreach ( $timeline_slider_slider as $slide ) {
                        ?>
                        <div class="timeline-slider__timeline-images__item-wrapper swiper-slide">
                            <div class="timeline-slider__timeline-images__item"
                                 data-index="<?php echo $i; ?>">
                                <picture>
                                    <?php if ( ! empty( $slide['mobile_image'] ) ) { ?>
                                        <source data-srcset="<?php echo esc_url( $slide['mobile_image']['url'] ); ?>"
                                                media="(max-width: 575px)">
                                    <?php } ?>
                                    <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                                            data-src="<?php echo esc_url( $slide['desktop_image']['url'] ); ?>"
                                            class="timeline-slider__timeline-images__image swiper-lazy"
                                            width="<?php echo esc_attr( $slide['desktop_image']['width'] ); ?>"
                                            height="<?php echo esc_attr( $slide['desktop_image']['height'] ); ?>"
                                            alt="<?php echo esc_attr( $slide['desktop_image']['alt'] ); ?>"
                                    >
                                </picture>
                                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                                <?php if ( $slide['text'] ) { ?>
                                    <p class="timeline-slider__timeline-images__text mb-0"><?php echo esc_html( $slide['text'] ); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- If we need navigation buttons -->
                <div class="timeline-slider__timeline-slider__slider-navigation">
                    <div class="button-prev d-none d-lg-block"></div>
                    <div class="button-next d-none d-lg-block"></div>
                </div>
            </div>
        </div>
        <div class="timeline-slider__timeline-slider">
            <div class="container-fluid p-0">
                <div class="timeline-slider__timeline-slider-outer swiper js-timeline-slider-timeline-slider">
                    <!-- Additional required wrapper -->
                    <div class="timeline-slider__timeline-slider__slider-wrapper swiper-wrapper">
                        <!-- Slides -->
                        <?php
                        $i = 0;
                        foreach ( $timeline_slider_slider as $slide ) {
                            $i++;
                            ?>
                            <div class="timeline-slider__timeline-slider__slide swiper-slide"
                                 data-index="<?php echo $i; ?>">
                                <div class="timeline-slider__timeline-slider__slide-year js-slide-year"><?php echo esc_html( $slide['year'] ); ?></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</section>

