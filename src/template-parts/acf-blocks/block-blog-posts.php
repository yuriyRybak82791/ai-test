<?php
/**
 * Block Name: Blog posts
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$blog_posts_hide = get_field_value( $page_fields, 'blog_posts_hide' );

/*
* exit if section is hidden
*/
if ( $blog_posts_hide ) {
    return;}

?>
<section class="blog-posts <?php echo esc_html( $class_name ); ?>" id="blog-posts">
    <div class="container blog-posts__container">
        
        <?php
        $current_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $selected_category = ( isset( $_GET['blog-categories'] ) ) ? sanitize_text_field( wp_unslash( $_GET['blog-categories'] ) ) : '';
        $selected_order = ( isset( $_GET['blog-order'] ) ) ? sanitize_text_field( wp_unslash( $_GET['blog-order'] ) ) : '';
        $add_args = array();
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 9,
            'paged' => $current_paged,
            'orderby' => 'post_date',
            'order' => 'DESC',
        );
        if ( ! empty( $selected_category ) ) {
            $args['cat'] = (int) $selected_category;
            $add_args['blog-categories'] = (int) $selected_category;
        }
        if ( ! empty( $selected_category ) ) {
            $args['order'] = $selected_order;
            $add_args['blog-order'] = $$selected_order;
        }
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            echo '<div class="blog-posts__wrapper">';
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

            // Pagination links.
            echo '<div class="pagination-wrapper">';
            echo paginate_links(
                array(
                    'total' => $query->max_num_pages,
                    'current' => max( 1, get_query_var( 'paged' ) ),
                    'prev_next' => true,
                    'prev_text' => '<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.999999 9L5 5L1 1" stroke="#6D052A"/>
                    </svg>',
                    'next_text' => '<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L1 5L5 9" stroke="#6D052A"/>
                    </svg>',
                    'format' => 'page/%#%/#blog-posts',
                    'add_args' => $add_args,
                )
            );
            echo '</div>';

        } else {
            echo '<h3 class="not-found">' . esc_html__( 'Sorry, no news was found!', 'wp-rock' ) . '</h3>';
        }
        // Restore original post data.
        wp_reset_postdata();
        ?>
    </div>
</section>
