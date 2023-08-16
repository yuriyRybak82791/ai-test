<?php
/**
 * Custom single posts banner
 *
 * @package WP-rock
 */


$i_d = get_the_ID();
$image_id = get_post_thumbnail_id( $i_d );
$attachment = wp_get_attachment_image_src( $image_id, 'full' );
$image_big = aq_resize( $attachment[0], 1092, 505, true, false, true );
$image = aq_resize( $attachment[0], 822, 505, true, false, true );
$image_mob = aq_resize( $attachment[0], 446, 274, true, false, true );
$image_mob_small = aq_resize( $attachment[0], 305, 266, true, false, true );

?>
<section class="single-post-banner">
    <div class="single-post-banner__container">
        <div class="single-post-banner__net">
        </div>
        <div class="single-post-banner__image-wrapper">
            <picture>
                <source srcset="<?php echo esc_url( $image_mob_small[0] ); ?>" media="(max-width: 390px)">
                <source srcset="<?php echo esc_url( $image_mob[0] ); ?>" media="(max-width: 575px)">
                <source srcset="<?php echo esc_url( $image[0] ); ?>" media="(max-width: 1440px)">
                <img src="<?php echo esc_url( $image_big[0] ); ?>" class="single-post-banner__image" width="<?php echo esc_html( $image_big[1] ); ?>" height="<?php echo esc_html( $image_big[2] ); ?>" alt="<?php echo esc_html( $item['name'] ); ?>">
            </picture>
        </div>

        <div class="single-post-banner__aside"></div>
    </div>    
</section>
