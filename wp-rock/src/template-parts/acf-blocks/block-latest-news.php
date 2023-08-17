<?php
/**
 * Block Name: Latest news
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$latest_news_hide = get_field_value( $page_fields, 'latest_news_hide' );

/*
* exit if section is hidden
*/
if ( $latest_news_hide ) {
    return;}

$latest_news_title = get_field_value( $page_fields, 'latest_news_title' );
$latest_news_text = get_field_value( $page_fields, 'latest_news_text' );
$latest_news_button = get_field_value( $page_fields, 'latest_news_button' );
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    ?>
<section class="latest-news my-10 <?php echo esc_html( $class_name ); ?>" id="latest-news">
    <div class="container latest-news__container">
        <?php if ( $latest_news_title ) { ?>
            <h2 class="latest-news__title h3 h2-lg mb-1 mb-lg-2 mb-lg-3 text-center"><?php echo esc_html( $latest_news_title ); ?></h2>
        <?php } ?>
        <?php if ( $latest_news_text ) { ?>
            <div class="latest-news__text subtitle text-center mb-3 mt-1 mt-lg-2 mb-lg-2"><?php echo wp_kses_post( $latest_news_text ); ?></div>
        <?php } ?>
        <?php
            echo '<div class="latest-news__wrapper">';
        while ( $query->have_posts() ) {
            $query->the_post();
            global $post;
            ?>
                <div class="post-card">
                    <a href="<?php the_permalink(); ?>" class="post-card__link">
                <?php

                $single_post_preview = get_field( 'single_post_preview', $post->ID );
                $single_post_preview = ! $single_post_preview ? 'featured' : $single_post_preview;

                if ( 'featured' === $single_post_preview ) {
                    $image_id = get_post_thumbnail_id( $post->ID );
                    $attachment = wp_get_attachment_image_src( $image_id, 'full' );
                    $image = aq_resize( $attachment[0], 408, 240, true, false, true );
                    $image_mob = aq_resize( $attachment[0], 358, 214, true, false, true );
                    ?>
                        <picture>
                            <source srcset="<?php echo esc_url( $image_mob[0] ); ?>" media="(max-width: 390px)">
                            <img src="<?php echo esc_url( $image[0] ); ?>" class="post-card__image" width="<?php echo esc_html( $image[1] ); ?>" height="<?php echo esc_html( $image[2] ); ?>" alt="<?php echo esc_html( $item['name'] ); ?>">
                        </picture>
                        <?php
                } elseif ( 'video' === $single_post_preview ) {
                    $single_post_video = get_field( 'single_post_video', $post->ID );
                    $single_post_video_poster = get_field( 'single_post_video_poster', $post->ID );
                    if ( ! empty( $single_post_video ) ) {
                        ?>
                        <video class="post-card__video" width="408" height="240" autoplay muted playsinline loop poster="<?php echo esc_url( $single_post_video_poster['url'] ); ?>" >
                            <source src="<?php echo esc_url( $single_post_video['url'] ); ?>" type="video/mp4">
                            Your browser doesn't support HTML5 video tag.
                        </video>
                            <?php
                    }
                } elseif ( 'gif' === $single_post_preview ) {
                    $single_post_gif = get_field( 'single_post_gif', $post->ID );
                    if ( ! empty( $single_post_gif ) ) {
                        ?>
                        <img src="<?php echo esc_url( $single_post_gif['url'] ); ?>" class="post-card__image" width="<?php echo esc_html( $single_post_gif['width'] ); ?>" height="<?php echo esc_html( $single_post_gif['height'] ); ?>" alt="<?php echo esc_html( $item['name'] ); ?>">
                            <?php
                    }
                }


                ?>
                        <span class="post-card__content">
                        <?php
                        $category_detail = get_the_category( $post->ID );
                        $cat_names = array(); // Create an array to store the cat_name values.

                        foreach ( $category_detail as $cd ) {
                            $cat_names[] = $cd->cat_name; // Add each cat_name to the array.
                        }
                        ?>
                            <span class="post-card__category"><?php echo esc_html( implode( ', ', $cat_names ) ); ?></span>
                            <span class="post-card__name"><?php the_title(); ?></span>
                        </span>
                    </a>
                </div>
                <?php
        }
            echo '</div>';
        ?>
        <?php if ( $latest_news_button ) { ?>
            <div class="latest-news__button-wrapper text-center mt-3 mt-lg-5">
                <a href="<?php echo esc_url( $latest_news_button['url'] ); ?>"
                   class="latest-news__button btn btn-arrow"<?php echo( $latest_news_button['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $latest_news_button['title'] ); ?></a>
            </div>
        <?php } ?>
    </div>
</section>
    <?php
}
// Restore original post data.
wp_reset_postdata();
?>
