<?php
/**
 * Page index
 *
 * @package WP-rock
 * @since 4.4.0
 */

?>

<?php get_header(); ?>

<?php

if ( have_posts() ) {

    // Load posts loop.
    while ( have_posts() ) {
        the_post();
        the_content();
    }
}
?>

<?php
get_footer();
