<?php
/**
 * Block Name: Our team
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$our_team_hide = get_field_value( $page_fields, 'our_team_hide' );

/*
* exit if section is hidden
*/
if ( $our_team_hide ) {
    return;
}

$our_team_tab_1_name = get_field_value( $page_fields, 'our_team_tab_1_name' );
$our_team_tab_2_name = get_field_value( $page_fields, 'our_team_tab_2_name' );
$our_team_tab_3_name = get_field_value( $page_fields, 'our_team_tab_3_name' );
$our_team_tab_4_name = get_field_value( $page_fields, 'our_team_tab_4_name' );
$our_team_tab_1_list = get_field_value( $page_fields, 'our_team_tab_1_list' );
$our_team_tab_2_list = get_field_value( $page_fields, 'our_team_tab_2_list' );
$our_team_tab_3_list = get_field_value( $page_fields, 'our_team_tab_3_list' );
$our_team_tab_4_list = get_field_value( $page_fields, 'our_team_tab_4_list' );
$our_team_tab_1_hide = get_field_value( $page_fields, 'our_team_tab_1_hide' );
$our_team_tab_2_hide = get_field_value( $page_fields, 'our_team_tab_2_hide' );
$our_team_tab_3_hide = get_field_value( $page_fields, 'our_team_tab_3_hide' );
$our_team_tab_4_hide = get_field_value( $page_fields, 'our_team_tab_4_hide' );

$tabs_array = array();
$tabs_array[0]['name'] = $our_team_tab_1_name ? $our_team_tab_1_name : '';
$tabs_array[1]['name'] = $our_team_tab_2_name ? $our_team_tab_2_name : '';
$tabs_array[2]['name'] = $our_team_tab_3_name ? $our_team_tab_3_name : '';
$tabs_array[3]['name'] = $our_team_tab_4_name ? $our_team_tab_4_name : '';

$tabs_array[0]['list'] = $our_team_tab_1_list ? $our_team_tab_1_list : '';
$tabs_array[1]['list'] = $our_team_tab_2_list ? $our_team_tab_2_list : '';
$tabs_array[2]['list'] = $our_team_tab_3_list ? $our_team_tab_3_list : '';
$tabs_array[3]['list'] = $our_team_tab_4_list ? $our_team_tab_4_list : '';

$tabs_array[0]['hide'] = $our_team_tab_1_hide ? $our_team_tab_1_hide : '';
$tabs_array[1]['hide'] = $our_team_tab_2_hide ? $our_team_tab_2_hide : '';
$tabs_array[2]['hide'] = $our_team_tab_3_hide ? $our_team_tab_3_hide : '';
$tabs_array[3]['hide'] = $our_team_tab_4_hide ? $our_team_tab_4_hide : '';


?>
<div class="our-team__loader js-team-loader"></div>
<section class="our-team mt-n5 mt-sm-n8 mt-lg-n10 <?php echo esc_html( $class_name ); ?>">

    <div class="our-team__container">
        <div class="our-team__heading">
            <?php
            $c = 1;
            foreach ( $tabs_array as $item ) {
                if ( ! $item['hide'] ) {
                    $active = 1 === $c ? ' active' : '';
                    ?>
                    <a href="#tab-<?php echo esc_attr( $c ); ?>"
                       class="our-team__tab-name js-tab-name<?php echo esc_attr( $active ); ?>"><?php echo esc_html( $item['name'] ); ?></a>
                    <?php
                    $c++;
                }
            }
            ?>
        </div>
        <div class="our-team__tabs-wrapper">
            <?php
            $c = 1;
            foreach ( $tabs_array as $item ) {
                if ( ! $item['hide'] ) {
                    $active = 1 === $c ? ' active' : '';
                    $management_class = 4 === $c ? ' management' : '';
                    $add_class = ! empty( $item['list'] ) ? ' has-team' : '';
                    ?>
                    <div class="js-tab our-team__tab<?php echo esc_attr( $active . $add_class ); ?>"
                         id="tab-<?php echo esc_attr( $c ); ?>">
                        <div class="container">
                            <?php if ( ! empty( $item['list'] ) ) { ?>
                                <div class="our-team__row-wrapper">
                                    <?php foreach ( $item['list'] as $item ) { ?>
                                    <div class="our-team__row">
                                        <?php if ( ! empty( $item['title'] ) ) { ?>
                                            <h3 class="our-team__row-title text-center"><?php echo esc_html( $item['title'] ); ?></h3>
                                        <?php } ?>
                                        <?php if ( ! empty( $item['team_members'] ) ) { ?>
                                            <div class="our-team__row-list<?php echo esc_attr( $management_class ); ?>">
                                                <?php
                                                foreach ( $item['team_members'] as $member ) {
                                                    $image_id = get_post_thumbnail_id( $member->ID );
                                                    $post_type = get_post_type($member->ID); 
                                                    ?>
                                                 
                                                    <div class="our-team__member <?php echo esc_attr( $post_type ); ?>">
                                                        <button type="button" class="our-team__member-btn" data-href="#get-team-member-popup" data-id="<?php echo esc_attr( $member->ID ); ?>" data-role="show-team-member-info"></button>
                                                        <div class="our-team__member-img-wrapper">
                                                        <?php
                                                        echo wp_get_attachment_image(
                                                            $image_id,
                                                            'full',
                                                            '',
                                                            array(
                                                                'class' => 'our-team__member-img',
                                                                'alt' => $member->post_title,
                                                                'title' => $member->post_title,
                                                            )
                                                        );
                                                        ?>
                                                        </div>
                                                        <div class="our-team__member-bottom <?php echo esc_attr( $post_type ); ?>">
                                                            <h3 class="our-team__member-name"><?php echo esc_html( $member->post_title ); ?></h3>
                                                            <?php
                                                                $single_management_position = get_field( 'single_management_position', $member->ID );
                                                                if( 'management' == $post_type && ! empty( $single_management_position ) ){
                                                            ?>
                                                                <p class="our-team__member-position text-center"><?php echo esc_html( $single_management_position ); ?></p>
                                                            <?php } ?>
                                                        </div>
                                                        
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <h2 class="our-team__coming-soon"><?php esc_html_e( 'Coming soon', 'wp-rock' ); ?></h2>
                            <?php } ?> 
                        </div>
                    </div>

                    <?php
                    $c++;
                }
            }
            ?>
        </div>
    </div>
</section>
<?php
    echo do_shortcode( '[popup_box box_id="get-team-member-popup"][/popup_box]' );
?>
