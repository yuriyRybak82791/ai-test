<?php
/**
 * Custom header template
 *
 * @package WP-rock
 */

global $global_options;

$logo = get_field_value( $global_options, 'logo' );
$header_cta = get_field_value( $global_options, 'header_cta' );
?>

<header id="site-header" class="site-header js-site-header">
    <div class="container-fluid site-header__container">
        <div class="row justify-content-between align-items-center">
            <div class="col-sm-auto d-flex align-items-center pe-sm-5 justify-content-between site-header__logo-wrap<?php echo is_rtl() ? ' site-header__logo-wrap_rtl' : ' site-header__logo-wrap_ltr'; ?>">
                <?php
                if ( function_exists( 'the_custom_logo' ) ) {
                    the_custom_logo();
                }
                ?>
                <button type="button" class="menu-btn js-menu-btn" aria-label="Menu" title="Menu"
                        data-role="menu-action">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
            <div class="col-auto d-none d-sm-block">
                <?php
                if ( $header_cta ) {
                    ?>
                    <a href="<?php echo esc_html( $header_cta['url'] ); ?>"
                       class="btn"<?php echo $header_cta['target'] ? ' target="_blank"' : ''; ?>><?php echo esc_html( $header_cta['title'] ); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>


    <div class="main-menu js-main-menu">
        <div class="main-menu__wrapper">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary_menu',
                    'container' => 'nav',
                    'container_class' => 'main-menu__container',
                    'menu_class' => 'main-menu__list js-menu-wrapper',
                )
            );
            ?>
        </div>
    </div>
</header>
