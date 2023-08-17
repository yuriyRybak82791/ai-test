<?php
/**
 * General template for 404 page
 *
 * @package WP-rock
 * @since 4.4.0
 */
get_header();
do_action( 'wp_rock_before_page_content' ); ?>

    <section class="section-404">
        <div class="section-404__bg">
            <div class="section-404__layer-4 order-4"></div>
            <div class="section-404__layer-3 order-2 order-md-3"></div>
            <div class="section-404__layer-2 order-3 order-md-2"></div>
            <div class="section-404__layer-1 d-none d-md-block order-1"></div>
        </div>
        <div class="section-404__body">
            <div class="container section-404__container">
                <div class="section-404__404" data-text="404">404</div>
                <h2 class="section-404__text"><?php esc_html_e( 'Page not found', 'wp-rock' ); ?></h2>
            </div>
        </div>
    </section>

<?php
do_action( 'wp_rock_after_page_content' );
get_footer();
?>
