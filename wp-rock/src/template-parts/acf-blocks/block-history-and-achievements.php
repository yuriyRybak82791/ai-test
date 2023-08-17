<?php
/**
 * Block Name: History and achievements
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$h_a_hide = get_field_value( $page_fields, 'h_a_hide' );

/*
* exit if section is hidden
*/
if ( $h_a_hide ) {
    return;
}

$h_a_text = get_field_value( $page_fields, 'h_a_text' );
$h_a_tab_1_name = get_field_value( $page_fields, 'h_a_tab_1_name' );
$h_a_slider_1 = get_field_value( $page_fields, 'h_a_slider_1' );
$h_a_tab_2_name = get_field_value( $page_fields, 'h_a_tab_2_name' );
$h_a_slider_2 = get_field_value( $page_fields, 'h_a_slider_2' );
$h_a_tab_3_name = get_field_value( $page_fields, 'h_a_tab_3_name' );
$h_a_slider_3 = get_field_value( $page_fields, 'h_a_slider_3' );
$h_a_tab_4_name = get_field_value( $page_fields, 'h_a_tab_4_name' );
$h_a_slider_4 = get_field_value( $page_fields, 'h_a_slider_4' );
$h_a_tab_1_hide = get_field_value( $page_fields, 'h_a_tab_1_hide' );
$h_a_tab_2_hide = get_field_value( $page_fields, 'h_a_tab_2_hide' );
$h_a_tab_3_hide = get_field_value( $page_fields, 'h_a_tab_3_hide' );
$h_a_tab_4_hide = get_field_value( $page_fields, 'h_a_tab_4_hide' );

$tabs_array = array();
if ( $h_a_tab_4_name && ! $h_a_tab_4_hide ) {
    $tabs_array[0]['name'] = $h_a_tab_4_name;
}
if ( $h_a_slider_4 && ! $h_a_tab_4_hide ) {
    $tabs_array[0]['slider'] = $h_a_slider_4;
}

if ( $h_a_tab_2_name && ! $h_a_tab_2_hide ) {
    $tabs_array[1]['name'] = $h_a_tab_2_name;
}
if ( $h_a_slider_2 && ! $h_a_tab_2_hide ) {
    $tabs_array[1]['slider'] = $h_a_slider_2;
}

if ( $h_a_tab_3_name && ! $h_a_tab_3_hide ) {
    $tabs_array[2]['name'] = $h_a_tab_3_name;
}
if ( $h_a_slider_3 && ! $h_a_tab_3_hide ) {
    $tabs_array[2]['slider'] = $h_a_slider_3;
}

if ( $h_a_tab_1_name && ! $h_a_tab_1_hide ) {
    $tabs_array[3]['name'] = $h_a_tab_1_name;
}
if ( $h_a_slider_1 && ! $h_a_tab_1_hide ) {
    $tabs_array[3]['slider'] = $h_a_slider_1;
}

?>
<section class="history-and-achievements pt-3 <?php echo esc_html( $class_name ); ?>">
    <div class="history-and-achievements__container">
        <?php if ( $h_a_text ) { ?>
            <p class="history-and-achievements__text d-block mx-auto text-center text-white px-2 mb-5"><?php echo esc_html( $h_a_text ); ?></p>
        <?php } ?>
        <div class="history-and-achievements__heading mb-4">
            <?php
            $c = 1;
            foreach ( $tabs_array as $item ) {
                if ( ! empty( $item['name'] ) ) {
                    $active = 1 === $c ? ' active' : '';
                    ?>
                    <a href="#tab-<?php echo esc_attr( $c ); ?>"
                       class="history-and-achievements__tab-name js-tab-name<?php echo esc_attr( $active ); ?>"><?php echo esc_html( $item['name'] ); ?></a>
                    <?php
                }
                $c++;
            }
            ?>
        </div>
        <div class="history-and-achievements__tabs-wrapper">
            <?php
            $c = 1;
            foreach ( $tabs_array as $item ) {
                if ( ! empty( $item['slider'] ) ) {
                    $active = 1 === $c ? ' active' : '';
                    ?>
                    <div class="js-tab history-and-achievements__tab<?php echo esc_attr( $active ); ?>"
                         id="tab-<?php echo esc_attr( $c ); ?>">
                        <div class="history-and-achievements__images-slider-outer mb-6 mb-lg2 px-2">
                            <div class="history-and-achievements__images-slider-container">
                                <div class="history-and-achievements__images-slider swiper js-ha-images-slider">
                                    <!-- Additional required wrapper -->
                                    <div class="history-and-achievements__images-slider-wrapper swiper-wrapper">
                                        <!-- Slides -->
                                        <?php
                                        $i = 0;
                                        foreach ( $item['slider'] as $slide ) {
                                            ?>
                                            <div class="history-and-achievements__image-block swiper-slide"
                                                data-index="tab-image-<?php echo esc_attr( $c . $i ); ?>" data-tab="<?php echo esc_attr( $c ); ?>">
                                                <picture>
                                                    <?php if ( ! empty( $slide['mobile_image'] ) ) { ?>
                                                        <source data-srcset="<?php echo esc_url( $slide['mobile_image']['url'] ); ?>"
                                                                media="(max-width: 575px)">
                                                    <?php } ?>
                                                    <img
                                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                                                            data-src="<?php echo esc_url( $slide['desktop_image']['url'] ); ?>"
                                                            class="history-and-achievements__image swiper-lazy"
                                                            width="<?php echo esc_attr( $slide['desktop_image']['width'] ); ?>"
                                                            height="<?php echo esc_attr( $slide['desktop_image']['height'] ); ?>"
                                                            alt="<?php echo esc_attr( $slide['desktop_image']['alt'] ); ?>"
                                                    >
                                                </picture>
                                                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="history-and-achievements__content-wrapper">
                                    <!-- Slides -->
                                    <?php
                                    $i = 0;
                                    foreach ( $item['slider'] as $slide ) {
                                        ?>
                                        <?php
                                        if ( ! empty( $slide['text'] ) ) {
                                            $active = 0 === $i ? ' active' : '';
                                            ?>
                                            <div class="history-and-achievements__image-content js-content 
                                            <?php
                                            echo esc_attr( 'js-content-'.$c . $i );
                                            echo esc_attr( $active );
                                            ?>
                                            ">
                                                <p class="history-and-achievements__image-text"><?php echo esc_html( $slide['text'] ); ?></p>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="history-and-achievements__timeline">
                            <div class="container-fluid">
                                <div class="history-and-achievements__slider swiper js-ha-timeline-slider">
                                    <!-- Additional required wrapper -->
                                    <div class="history-and-achievements__slider-wrapper swiper-wrapper">
                                        <!-- Slides -->
                                        <?php
                                        $i = 0;
                                        foreach ( $item['slider'] as $slide ) {
                                            ?>
                                            <div class="history-and-achievements__slide swiper-slide"
                                                 data-index="tab-image-<?php echo esc_attr( $c . $i ); ?>">
                                                <div class="history-and-achievements__slide-year js-slide-year"><?php echo esc_html( $slide['year'] ); ?></div>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                    <!-- If we need navigation buttons -->
                                    <div class="history-and-achievements__slider-navigation">
                                        <div class="button-prev d-none d-lg-block"></div>
                                        <div class="button-next d-none d-lg-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                $c++;
            }
            ?>
        </div>
    </div>
</section>
