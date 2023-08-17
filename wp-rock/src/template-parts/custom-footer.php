<?php
/**
 * Custom footer template
 *
 * @package WP-rock
 */

global $global_options;

$logo              = get_field_value( $global_options, 'logo' );
$footer_cta        = get_field_value( $global_options, 'footer_cta' );
$footer_copyrights = get_field_value( $global_options, 'footer_copyrights' );
?>
<footer id="site-footer" class="py-4 site-footer">
    <div class="container site-footer__container">

        <div class="row site-footer__main">
            <div class="col-md-auto pe-xl-5">
                <?php
                if ( function_exists( 'the_custom_logo' ) ) {
                    the_custom_logo();
                }
                ?>
            </div>
            <div class="col-md-auto pt-1 pt-lg-3">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer_menu',
                        'container' => 'nav',
                        'container_class' => 'site-footer__menu-list',
                        'menu_class' => 'site-footer__menu js-menu-wrapper',
                    )
                );
                ?>
            </div>
            <div class="col-md-auto pt-2">
                <?php
                if ( $footer_cta ) {
                    echo '<a href="' . esc_html( $footer_cta['url'] ) . '" class="btn"' . ( $footer_cta['target'] ? ' target="_blank"' : '' ) . '>' . esc_html( $footer_cta['title'] ) . '</a>';
                }
                ?>
            </div>
            <div class="col-md-auto ms-auto pt-5 pt-lg-3">
                <?php echo esc_html( get_template_part( 'src/template-parts/custom', 'social-media-links' ) ); ?>
            </div>
        </div>

        <div class="row justify-content-between mt-3 site-footer__bottom">
            <div class="col-md-auto pt-1">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer_menu_bottom',
                        'container' => 'nav',
                        'container_class' => 'site-footer__bottom-menu-list',
                        'menu_class' => 'site-footer__bottom-menu',
                    )
                );
                ?>
            </div>
            <div class="col-md-auto pt-1">
                <?php
                if ( $footer_copyrights ) {
                    echo '<p class="site-footer__copyrights">' . do_shortcode( $footer_copyrights ) . '</p>';
                }
                ?>
            </div>

        </div>
    </div>
</footer>
