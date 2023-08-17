<?php
/**
 * General template for single posts
 *
 * @package WP-rock
 * @since 4.4.0
 */

get_header();

$page_fields = get_fields();
global $global_options;

$single_post_source = get_field_value( $page_fields, 'single_post_source' );
$single_post_date = get_field_value( $page_fields, 'single_post_date' );
$single_post_return_link = get_field_value( $global_options, 'single_post_return_link' );

do_action( 'wp_rock_before_page_content' );
echo esc_html( get_template_part( 'src/template-parts/custom', 'single-banner' ) );
?>

    <div class="container single-blog mt-4 mt-lg-7 mb-3 mb-lg-6">
        <div class="row">
           
            <div class="col-12">
                <?php
                    // Share post links for mobile.
                    echo esc_html( get_template_part( 'src/template-parts/custom', 'single-share', array( 'type' => 'mobile' ) ) );
                ?>
                <div class="single-post-heading">
                    <div class="single-post-heading__content mb-3 mb-md-10">
                        <div class="single-post-heading__content-wrapper">
                        <?php

                            $category_detail = get_the_category( $post->ID );
                            $cat_names = array(); // Create an array to store the cat_name values.

                        foreach ( $category_detail as $cd ) {
                            $cat_names[] = $cd->cat_name; // Add each cat_name to the array.
                        }
                        ?>
                            <h3 class="single-post-heading__category mb-1 mb-lg-2"><?php echo esc_html( implode( ', ', $cat_names ) ); ?></h3>
                            <h1 class="single-post-heading__title mb-1"><?php echo esc_html( get_the_title( $i_d ) ); ?></h1>
                            <p class="single-post-heading__excerpt mb-3 mb-lg-4"><?php echo esc_html( get_the_excerpt( $i_d ) ); ?></p>
                            <?php if ( $single_post_source ) { ?>
                                <p class="single-post-heading__source"><?php echo esc_html( $single_post_source ); ?></p>
                            <?php } ?>
                            <?php if ( $single_post_date ) { ?>
                                <p class="single-post-heading__date"><?php echo esc_html( $single_post_date ); ?></p>
                            <?php } ?>
                            <?php if ( $single_post_return_link ) { ?>  
                                <div class="single-post-heading__button-wrapper mt-3 mt-lg-5">
                                    <a href="<?php echo esc_url( $single_post_return_link['url'] ); ?>" class="btn btn-arrow single-post-heading__button"<?php echo ( $single_post_return_link['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $single_post_return_link['title'] ); ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="section-content single-post-content">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
                </div>
                
            </div>
        </div>
    </div>

<?php do_action( 'wp_rock_after_page_content' ); ?>
<?php
get_footer();
