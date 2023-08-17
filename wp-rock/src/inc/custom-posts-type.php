<?php
/**
 * Register our custom post types
 *
 * @package WP-rock
 * @since 4.4.0
 */

foreach ( glob( THEME_DIR . '/src/inc/custom-post-types/*.php' ) as $file ) {
    require $file;
}
