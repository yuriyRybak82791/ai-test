<?php
/**
 * Block Name: Hero
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$hero_video = get_field_value( $page_fields, 'hero_video' );
$hero__mobile_video = get_field_value( $page_fields, 'hero__mobile_video' );
$hero_video_poster = get_field_value( $page_fields, 'hero_video_poster' );
$hero_mobile_video_poster = get_field_value( $page_fields, 'hero_mobile_video_poster' );
$hero_title = get_field_value( $page_fields, 'hero_title' );
$hero_team_logo_1 = get_field_value( $page_fields, 'hero_team_logo_1' );
$hero_team_logo_2 = get_field_value( $page_fields, 'hero_team_logo_2' );
$hero_text = get_field_value( $page_fields, 'hero_text' );
$hero_button = get_field_value( $page_fields, 'hero_button' );
$hero_slider = get_field_value( $page_fields, 'hero_slider' );
?>
<section class="hero <?php echo esc_html( $class_name ); ?>">
    <?php if ( $hero_slider ) { ?>
        <div class="hero__timeline-images">
            <div class="hero__timeline-images__slider swiper js-hero-timeline-images">
                <?php
                $detect = new \Detection\MobileDetect();
                // Determine the appropriate video URL based on the device type.
                if ( $detect->isMobile() && ! $detect->isTablet() ) {
                    $video_url = $hero__mobile_video;
                    $video_poster = $hero_mobile_video_poster;
                } else {
                    $video_url = $hero_video;
                    $video_poster = $hero_video_poster;
                }
                ?>
                <video class="hero__timeline-banner__video" width="100%" height="100%" autoplay muted playsinline
                       loop
                       poster="<?php echo esc_url( $video_poster ); ?>">
                    <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
                    Your browser doesn't support HTML5 video tag.
                </video>
                <!-- Additional required wrapper -->
                <div class="hero__timeline-images__wrapper swiper-wrapper">
                    <!-- Slides -->
                    <?php
                    $i = 0;
                    ?>
                    <div class="hero__timeline-images__item-wrapper swiper-slide">
                        <div class="hero__timeline-banner d-flex align-items-center">
                            <div class="container hero__timeline-banner__container">
                                <div class="row">
                                    <div class="hero__timeline-banner__aside col-md-5">
                                        <?php if ( $hero_title ) { ?>
                                            <div class="hero__timeline-banner__text-wrapper">
                                                <p class="hero__timeline-banner__text mb-1 mb-md-0"
                                                   data-text="<?php echo esc_html( $hero_title ); ?>"><span
                                                            class="hero__timeline-banner__text_bg"></span><?php echo esc_html( $hero_title ); ?>
                                                </p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-7">
                                        <?php if ( $hero_team_logo_1 && $hero_team_logo_2 ) { ?>
                                            <div class="hero__upcoming-game text-center">
                                                <div class="hero__upcoming-game__teams">
                                                    <img src="<?php echo esc_url( $hero_team_logo_1['url'] ); ?>"
                                                         class="hero__upcoming-game__logo" width="auto" height="auto"
                                                         alt="<?php echo esc_html( $hero_team_logo_1['alt'] ); ?>">
                                                    <div class="hero__upcoming-game__vs pt-1 pt-xl-7">VS</div>
                                                    <img src="<?php echo esc_url( $hero_team_logo_2['url'] ); ?>"
                                                         class="hero__upcoming-game__logo" width="auto" height="auto"
                                                         alt="<?php echo esc_html( $hero_team_logo_2['alt'] ); ?>">
                                                </div>
                                                <?php if ( $hero_text ) { ?>
                                                    <p class="hero__upcoming-game__text mt-3 mt-md-2 mt-lg-5 mb-2 mb-lg-5"><?php echo esc_html( $hero_text ); ?></p>
                                                <?php } ?>
                                                <?php if ( $hero_button ) { ?>
                                                    <div class="hero__upcoming-game__button-wrapper">
                                                        <a href="<?php echo esc_url( $hero_button['url'] ); ?>"
                                                           class="hero__upcoming-game__button btn"<?php echo( $hero_button['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $hero_button['title'] ); ?></a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                    foreach ( $hero_slider as $slide ) {
                        ?>
                        <div class="hero__timeline-images__item-wrapper swiper-slide">
                            <div class="hero__timeline-images__item"
                                 data-index="<?php echo $i; ?>">
                                <picture>
                                    <?php if ( ! empty( $slide['mobile_image'] ) ) { ?>
                                        <source data-srcset="<?php echo esc_url( $slide['mobile_image']['url'] ); ?>"
                                                media="(max-width: 575px)">
                                    <?php } ?>
                                    <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                                            data-src="<?php echo esc_url( $slide['desktop_image']['url'] ); ?>"
                                            class="hero__timeline-images__image swiper-lazy"
                                            width="<?php echo esc_attr( $slide['desktop_image']['width'] ); ?>"
                                            height="<?php echo esc_attr( $slide['desktop_image']['height'] ); ?>"
                                            alt="<?php echo esc_attr( $slide['desktop_image']['alt'] ); ?>"
                                    >
                                </picture>
                                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                                <?php if ( $slide['text'] ) { ?>
                                    <p class="hero__timeline-images__text mb-0"><?php echo esc_html( $slide['text'] ); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- If we need navigation buttons -->
                <div class="hero__timeline-slider__slider-navigation">
                    <div class="button-prev d-none d-lg-block"></div>
                    <div class="button-next d-none d-lg-block"></div>
                </div>
            </div>
        </div>
        <div class="hero__timeline-slider">
            <div class="container-fluid p-0">
                <div class="hero__timeline-slider-outer swiper js-hero-timeline-slider">
                    <!-- Additional required wrapper -->
                    <div class="hero__timeline-slider__slider-wrapper swiper-wrapper">
                        <!-- Slides -->
                        <?php
                        $i = 0;
                        ?>
                        <div class="hero__timeline-slider__slide swiper-slide"
                             data-index="<?php echo $i; ?>">
                            <div class="js-slide-year link-today"><?php echo __( 'היום', 'wp-rock' ); ?></div>
                        </div>
                        <?php
                        foreach ( $hero_slider as $slide ) {
                            $i++;
                            ?>
                            <div class="hero__timeline-slider__slide swiper-slide"
                                 data-index="<?php echo $i; ?>">
                                <div class="hero__timeline-slider__slide-year js-slide-year"><?php echo esc_html( $slide['year'] ); ?></div>
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
