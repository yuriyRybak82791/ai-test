<?php
/**
 * Connecting scripts to site
 *
 * @package WP-rock
 */

/**
 * Get file last time update date for put as version in Enqueue scripts and styles
 *
 * @param {string} $file_path - file for analyze.
 *
 * @return string
 */
function get_file_modification_time( $file_path ) {
     return gmdate( 'ymd-Gis', filemtime( $file_path ) );
}

/**
 * Enqueue scripts and styles.
 *
 * @return void
 */
function px_site_scripts() {
    $general_style_ver = get_file_modification_time( get_stylesheet_directory() . '/style.css' );
    $custom_style_ver = get_file_modification_time( get_stylesheet_directory() . '/assets/public/css/frontend.css' );
    $custom_js_ver = get_file_modification_time( get_stylesheet_directory() . '/assets/public/js/frontend.js' );

    // Load our main stylesheet.
    wp_enqueue_style( 'wp-rock-style', STYLE_URI, $general_style_ver );

    wp_enqueue_style( 'wp-rock_style', THEME_URI . '/assets/public/css/frontend.css', array(), $custom_style_ver );

    wp_enqueue_style( 'swiper_css', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', array(), null );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_single() ) {
        wp_enqueue_style( 'block-content', THEME_URI . '/assets/public/css/block-content.css', array(), $custom_style_ver );
        wp_enqueue_style( 'page-single-post', THEME_URI . '/assets/public/css/page-single-post.css', array(), $custom_style_ver );
    }

    if ( is_404() ) {
        wp_enqueue_style( 'page-404', THEME_URI . '/assets/public/css/page-404.css', array(), $custom_style_ver );
    }

    if ( function_exists( 'is_checkout' ) && is_checkout() ) {
        wp_enqueue_style( 'wc-checkout', THEME_URI . '/assets/public/css/wc-checkout.css', array(), $custom_style_ver );
    }

    wp_enqueue_script( 'frontend_js', ASSETS_JS . 'frontend.js', array( 'jquery' ), $custom_js_ver, true );

    global $global_options;

    

    $vars = array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'theme_path' => get_stylesheet_directory_uri(),
        'site_url' => get_site_url(),
        'nonce' => wp_create_nonce( 'hta_nonce' ),
    );

    wp_localize_script( 'frontend_js', 'var_from_php', $vars );

    remove_action( 'wp_head', 'wp_print_scripts' );
    remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
    remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );

    add_action( 'wp_footer', 'wp_print_scripts', 5 );
    add_action( 'wp_footer', 'wp_enqueue_scripts', 5 );
    add_action( 'wp_footer', 'wp_print_head_scripts', 5 );

}

add_action( 'wp_enqueue_scripts', 'px_site_scripts' );


add_action(
    'admin_enqueue_scripts',
    function () {
        wp_enqueue_style( 'wp-rock_style_admin', ASSETS_CSS . 'backend.css', array(), '1.2.0' );

        wp_enqueue_script(
            'backend_js',
            ASSETS_JS . 'backend.js',
            array(
                'jquery',
            ),
            '1.2.0',
            true
        );
    },
    99
);

