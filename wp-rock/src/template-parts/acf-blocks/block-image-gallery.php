<?php
/**
 * Block Name: Image gallery
 *
 * @package WP-rock
 * @since 4.4.0
 */

 $page_fields = get_fields();
 $class_name = isset( $block['className'] ) ? $class_name : '';
 $image_gallery_hide = get_field_value( $page_fields, 'image_gallery_hide' );

 /*
 * exit if section is hidden
 */
if ( $image_gallery_hide || $pag_paged > 1 ) {
    return;}

$image_gallery_gallery = get_field_value( $page_fields, 'image_gallery_gallery' );
?>
<section class="image-gallery <?php echo esc_attr( $class_name ); ?>">
    <div class="swiper image-gallery__slider js-image-gallery">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper image-gallery__wrapper">
            <!-- Slides -->
            <?php foreach ( $image_gallery_gallery as $slide ) { ?>
                <?php if ( ! empty( $slide ) ) { ?>
                <div class="swiper-slide image-gallery__slide">
                    <?php
                        $image_full = aq_resize( $slide['url'], 1100, 530, true, false, true );
                        $image_desktop = aq_resize( $slide['url'], 820, 398, true, false, true );
                        $image_mob = aq_resize( $slide['url'], 388, 248, true, false, true );
                    ?>
                    <picture>
                        <source srcset="<?php echo esc_url( $image_mob[0] ); ?>" media="(max-width: 430px)">
                        <source srcset="<?php echo esc_url( $image_desktop[0] ); ?>" media="(max-width: 1440px)">
                        <img src="<?php echo esc_url( $image_full[0] ); ?>" class="image-gallery__slide-image" width="<?php echo esc_attr( $image_full[1] ); ?>" height="<?php echo esc_attr( $image_full[2] ); ?>" alt="<?php echo esc_attr( $slide['alt'] ); ?>">
                    </picture>
                    
                </div>
                <?php } ?>
            <?php } ?>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>
