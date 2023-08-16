<?php
/**
 * Different Ajax requests
 *
 * @package WP-rock/ajax_requests
 */

$wp_rock = new WP_Rock();

$wp_rock->ajax_front_to_backend( 'more_archive_posts', 'more_archive_posts' );
/**
 *  Get more archive posts
 */
function more_archive_posts() {
     $page     = filter_input( INPUT_POST, 'page', FILTER_SANITIZE_STRING );
    $cat_id    = filter_input( INPUT_POST, 'cat_id', FILTER_SANITIZE_STRING );
    $tax_id    = filter_input( INPUT_POST, 'tax_id', FILTER_SANITIZE_STRING );
    $terms_ids = array();

    $args = array(
        'suppress_filters' => true,
        'post_type' => 'resources',
        'post_status' => 'publish',
        'posts_per_page' => get_option( 'posts_per_page' ),
        'posts_per_archive_page' => get_option( 'posts_per_page' ),
        'paged' => $page,
    );

    if ( $cat_id ) :
        if ( 'all' !== $cat_id ) :
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'resources-category',
                    'field' => 'id',
                    'terms' => $cat_id,
                ),
            );
        endif;

        if ( 'all' === $cat_id ) :
            $terms_arr = get_terms(
                'resources-category',
                array(
                    'hide_empty' => false,
                )
            );

            foreach ( $terms_arr as $r_terms ) :
                array_push( $terms_ids, $r_terms->term_id );
            endforeach;

            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'resources-category',
                    'field' => 'id',
                    'terms' => $terms_ids,
                ),
            );
        endif;
    endif;

    if ( $tax_id ) :
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'resources-tags',
                'field' => 'id',
                'terms' => $tax_id,
            ),
        );
    endif;

    $loop = new WP_Query( $args );

    ob_start();
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) :
            $loop->the_post();
            echo esc_html( get_template_part( 'src/template-parts/template', 'small-posts' ) );
        endwhile;
    endif;
    $data = ob_get_clean();
    wp_reset_postdata();
    wp_send_json_success( $data );
}

$wp_rock->ajax_front_to_backend( 'get_team_member_info', 'get_team_member_info' );
/**
 *  get taeam member info
 */
function get_team_member_info() {
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { // check if it's ajax request (simple defence)
		// Check nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'hta_nonce')) {
            wp_send_json_error('Invalid nonce');
        }
        if ( isset( $_POST['memberID'] ) ) {
            $member_id = filter_input( INPUT_POST, 'memberID', FILTER_SANITIZE_NUMBER_INT );
            if ( $member_id ) {
                
                $member_name = get_the_title( $member_id );
                
                
                
                $post_type = get_post_type($member_id); 
                if( 'management' === $post_type ){
                    $single_team_position = get_field( 'single_management_position', $member_id );
                    $single_team_desktop_image = get_field( 'single_management_desktop_image', $member_id );
                    $single_team_mobile_image = get_field( 'single_management_mobile_image', $member_id );
                    $gallery_desktop =  get_template_directory_uri() . '/assets/public/images/team-popup-management-img.svg';
                    $gallery_mobile = get_template_directory_uri() . '/assets/public/images/team-popup-management-mobile-img.svg';
                    $single_team_about = get_field( 'single_management_about', $member_id );

                    $desktop_image = ! empty( $single_team_desktop_image ) ? $single_team_desktop_image['url'] : '';
                    $desktop_image_width = ! empty( $single_team_desktop_image ) ? $single_team_desktop_image['width'] : '353';
                    $desktop_image_height = ! empty( $single_team_desktop_image ) ? $single_team_desktop_image['height'] : '894';

                    $mobile_image = ! empty( $single_team_mobile_image ) ? $single_team_mobile_image['url'] : '';

                    $gallery_desktop_width = '254';
                    $gallery_desktop_height = '832';

                }else{
                    $single_team_age = get_field( 'single_team_age', $member_id );
                    $single_team_experience = get_field( 'single_team_experience', $member_id );
                    $single_team_number = get_field( 'single_team_number', $member_id );
                    $single_team_position = get_field( 'single_team_position', $member_id );
                    $single_team_desktop_image = get_field( 'single_team_desktop_image', $member_id );
                    $single_team_mobile_image = get_field( 'single_team_mobile_image', $member_id );
                    $single_team_gallery_desktop = get_field( 'single_team_gallery_desktop', $member_id );
                    $single_team_gallery_mobile = get_field( 'single_team_gallery_mobile', $member_id );
                    $single_team_about = get_field( 'single_team_about', $member_id );

                    $desktop_image = ! empty( $single_team_desktop_image ) ? $single_team_desktop_image['url'] : '';
                    $desktop_image_width = ! empty( $single_team_desktop_image ) ? $single_team_desktop_image['width'] : '353';
                    $desktop_image_height = ! empty( $single_team_desktop_image ) ? $single_team_desktop_image['height'] : '894';

                    $mobile_image = ! empty( $single_team_mobile_image ) ? $single_team_mobile_image['url'] : '';
                    $gallery_desktop = ! empty( $single_team_gallery_desktop ) ? $single_team_gallery_desktop['url'] : '';
                    $gallery_desktop_width = ! empty( $single_team_gallery_desktop ) ? $single_team_gallery_desktop['width'] : '254';
                    $gallery_desktop_height = ! empty( $single_team_gallery_desktop ) ? $single_team_gallery_desktop['height'] : '832';

                    $gallery_mobile = ! empty( $single_team_gallery_mobile ) ? $single_team_gallery_mobile['url'] : '';
                }
    
                ob_start(); // Start output buffering
                ?>
                <div class="team-popup">
                    <div class="team-popup__net-wrapper">
                        <div class="team-popup__net"></div>
                    </div>
                    <div class="team-popup__main">
                        <div class="team-popup__main-info">
                            <div class="team-popup__main-info-wrapper">
                                <button data-role="login-close" class="popup-close js-popup-close">close popup</button>
                                <h3 class="team-popup__name"><?php echo esc_html( $member_name ); ?></h3>
                                <?php if ( ! empty( $single_team_position ) ) : ?>
                                    <p class="team-popup__position"><?php echo esc_html( $single_team_position ); ?></p>
                                <?php endif; ?>
                                <?php  if( 'team' === $post_type ): ?>
                                    <?php if ( ! empty( $single_team_age ) ) : ?>
                                        <p class="team-popup__age"><?php echo esc_html( $single_team_age ); ?></p>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $single_team_experience ) ) : ?>
                                        <p class="team-popup__experience"><?php echo esc_html( $single_team_experience ); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="team-popup__content"><?php echo wp_kses_post( $single_team_about ); ?></div>
                            </div>
                        </div>
                        <div class="team-popup__main-img-wrapper">
                            <picture>
                                <source srcset="<?php echo esc_url( $mobile_image ); ?>" media="(max-width: 991px)">
                                <img src="<?php echo esc_url( $desktop_image ); ?>" class="team-popup__main-player" width="<?php echo esc_attr( $desktop_image_width ); ?>" height="<?php echo esc_attr( $desktop_image_height ); ?>" alt="<?php echo esc_attr( $member_name ); ?>">
                            </picture>
                            <div class="team-popup__main-bg">
                                <div class="team-popup__main-number"><?php echo esc_html( $single_team_number ); ?></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="team-popup__gallery <?php echo esc_attr( $post_type ); ?>">
                        <picture>
                            <source srcset="<?php echo esc_url( $gallery_mobile ); ?>" media="(max-width: 991px)">
                            <img src="<?php echo esc_url( $gallery_desktop ); ?>" class="team-popup__gallery-img <?php echo esc_attr( $post_type ); ?>" width="<?php echo esc_attr( $gallery_desktop_width ); ?>" height="<?php echo esc_attr( $gallery_desktop_height ); ?>" alt="<?php echo esc_attr( $member_name ); ?> gallery">
                        </picture>
                    </div>
                </div>
                <?php
                $html = ob_get_clean(); // Get the buffered content and clean the buffer
    
                wp_send_json_success( $html );
            }
        }
        wp_send_json_error( 'Invalid request or missing member ID.' );
	}
}
