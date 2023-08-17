<?php
/**
 *  Custom ACF Gutenberg blocks.
 *
 * @package WP-rock
 * @since 4.4.0
 */

/**
 * Registering ACF blocks.
 */
class WP_Rock_Blocks {



    /**
     * Array with blocks defining.
     *
     * @var array|array[]
     */
    protected array $blocks = array(
        'hero' => array(
            'title' => 'Hero',
        ),
        'external-news' => array(
            'title' => 'External news',
        ),
        'partners-slider' => array(
            'title' => 'Partners slider',
        ),
        'tiktok-videos' => array(
            'title' => 'TikTok videos',
        ),
        'shop-now' => array(
            'title' => 'Shop now',
        ),
        'loyalty-program-banner' => array(
            'title' => 'Loyalty program banner with banner',
        ),
        'loyalty-program' => array(
            'title' => 'Loyalty program',
        ),
        'products-slider' => array(
            'title' => 'Products slider',
        ),
        'partners-logo-slider' => array(
            'title' => 'Partners logo slider',
        ),
        'banner' => array(
            'title' => 'Banner',
        ),
        'banner-v2' => array(
            'title' => 'Banner v2',
        ),
        'blog-filters' => array(
            'title' => 'Blog filters',
        ),
        'blog-posts' => array(
            'title' => 'Blog posts',
        ),
        'timeline-slider' => array(
            'title' => 'Timeline slider',
        ),
        'image-gallery' => array(
            'title' => 'Image gallery',
            'post_types' => array( 'post' ),
        ),
        'history-and-achievements' => array(
            'title' => 'History and achievements',
        ),
        'faqs' => array(
            'title' => 'FAQs',
        ),
        'contact-us' => array(
            'title' => 'Contact us',
            'full_height' => true,
        ),
        'matches-list' => array(
            'title' => 'Matches list',
        ),
        'content' => array(
            'title' => 'Content',
            'post_types' => array( 'page', 'post' ),
        ),
        'our-team' => array(
            'title' => 'Our team',
        ),
        'loyalty-banner' => array(
            'title' => 'Loyalty banner',
        ),
        'loyalty-benefits' => array(
            'title' => 'Loyalty benefits',
        ),
        'cta-section' => array(
            'title' => 'CTA block',
        ),
        'league-table' => array(
            'title' => 'League table',
        ),
        'text-content' => array(
            'title' => 'Text content',
        ),
        'sponsors-list' => array(
            'title' => 'Sponsors list',
        ),
        'live-stream' => array(
            'title' => 'Live stream',
        ),
        'latest-news' => array(
            'title' => 'Latest news',
        ),
    );
    /**
     * List of Allowed blocks
     * core/freeform  - it's standard WYSIWYG.
     *
     * @var string[]
     */
    protected array $allowed = array( 'core/freeform' );


    /**
     *  Construct of the class
     */
    public function __construct() {
         add_action( 'init', array( $this, 'add_custom_blocks' ) );
        add_filter( 'allowed_block_types_all', array( $this, 'filter_allowed_blocks' ), 10, 2 );
    }

    /**
     * Function for `allowed_block_types_all` filter-hook.
     *
     * @param bool|string[]           $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
     * @param WP_Block_Editor_Context $editor_context The current block editor context.
     *
     * @return bool|string[]
     */
    public function filter_allowed_blocks( $allowed_block_types, WP_Block_Editor_Context $editor_context ) {
        if ( ! empty( $editor_context->post ) ) {
            $allowed = array_map( array( $this, 'add_prefix' ), array_keys( $this->blocks ) );

            if ( ! empty( $this->allowed ) ) {
                foreach ( $this->allowed as $block ) {
                    $allowed[] = $block;
                }
            }

            return $allowed;
        }
        return $allowed_block_types;
    }

    /**
     * Just adding prefix to blocks.
     *
     * @param string $value - name of block.
     * @return string
     */
    public function add_prefix( string $value ): string {
        return 'acf/' . $value;
    }

    /**
     * Final registration blocks
     *
     * @return void
     */
    public function add_custom_blocks(): void {
        if ( function_exists( 'acf_register_block_type' ) ) {
            foreach ( $this->blocks as $id => $block ) {

                $title = $block['title'];
                $description = $block['description'];

                $args = array(
                    'name' => $id,
                    'title' => __( $title, 'headless_wp' ),
                    'description' => __( $description, 'headless_wp' ),
                    'render_template' => '/src/template-parts/acf-blocks/block-' . $id . '.php',
                    'category' => 'layout',
                    'post_types' => $block['post_types'] ?: array( 'page' ),
                    'mode' => $block['mode'] ?: 'preview',
                    'supports' => array(
                        'align' => false,
                        'full_height' => $block['full_height'] ?: false,
                    ),
                    'example' => array(
                        'attributes' => array(
                            'data' => array( 'is_example' => true ),
                        ),
                    ),

                );

                if ( file_exists( THEME_DIR . '/assets/public/css/block-' . $id . '.css' ) ) {
                    $args['enqueue_style'] = ASSETS_CSS . 'block-' . $id . '.css';
                }

                if ( file_exists( THEME_DIR . '/assets/public/js/block-' . $id . '.js' ) ) {
                    $args['enqueue_script'] = ASSETS_JS . 'block-' . $id . '.js';
                }

                acf_register_block_type( $args );
            }
        }
    }
}

new WP_Rock_Blocks();
