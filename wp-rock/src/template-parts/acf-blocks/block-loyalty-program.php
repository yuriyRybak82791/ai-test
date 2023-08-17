<?php
/**
 * Block Name: Loyalty program
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$loyalty_program_2_hide = get_field_value( $page_fields, 'loyalty_program_2_hide' );

/*
* exit if section is hidden
*/
if ( $loyalty_program_2_hide ) {
    return;}

$loyalty_program_2_video_list = get_field_value( $page_fields, 'loyalty_program_2_video_list' );
$loyalty_program_2_text_1 = get_field_value( $page_fields, 'loyalty_program_2_text_1' );
$loyalty_program_2_text_2 = get_field_value( $page_fields, 'loyalty_program_2_text_2' );
$loyalty_program_2_logo = get_field_value( $page_fields, 'loyalty_program_2_logo' );
$loyalty_program_2_net_video = get_field_value( $page_fields, 'loyalty_program_2_net_video' );
$loyalty_program_2_net_video_poster = get_field_value( $page_fields, 'loyalty_program_2_net_video_poster' );
$loyalty_program_2_style = get_field_value( $page_fields, 'loyalty_program_2_style' );
$style = 'two' === $loyalty_program_2_style ? ' style-two' : '';

?>
<section class="loyalty-program mb-9 mb-lg-14 mt-6 mt-lg-16 <?php echo esc_html( $class_name ); ?>">
    <div class="container loyalty-program__container">
        <div class="loyalty-program__line loyalty-program__line-1">
            <div class="loyalty-program__text-block loyalty-program__text-block-1<?php echo esc_attr( $style ); ?>">
                <?php if ( $loyalty_program_2_text_1 ) { ?>
                    <h2 class="loyalty-program__text loyalty-program__text-1<?php echo esc_attr( $style ); ?>"><?php echo esc_html( $loyalty_program_2_text_1 ); ?></h2>
                <?php } ?>
            </div>
            <div class="loyalty-program__mobile-text-block">
                <?php if ( $loyalty_program_2_text_1 ) { ?>
                    <h2 class="loyalty-program__mobile-text<?php echo esc_attr( $style ); ?>">
                        <?php
                        if ( $loyalty_program_2_text_1 ) {
                            echo esc_html( $loyalty_program_2_text_1 );
                        }
                        if ( $loyalty_program_2_text_2 ) {
                            echo ' ' . esc_html( $loyalty_program_2_text_2 );
                        }
                        ?>
                    </h2>
                <?php } ?>
            </div>
            
            <div class="loyalty-program__video">
                <a href="#loyalty-program-video-1" class="<?php echo ! empty( $loyalty_program_2_video_list[0]['video_link'] ) ? esc_attr( 'js-open-popup-activator' ) : ''; ?> loyalty-program__video-link">
                    <?php
                    $img_1 = aq_resize( $loyalty_program_2_video_list[0]['image']['url'], 285, 330, true, false, true );
                    $img_1_mob = aq_resize( $loyalty_program_2_video_list[0]['image']['url'], 179, 201, true, false, true );
                    ?>
                    <picture>
                        <source srcset="<?php echo esc_url( $img_1_mob[0] ); ?>" media="(max-width: 390px)">
                        <img src="<?php echo esc_url( $img_1[0] ); ?>" class="loyalty-program__video-preview" width="<?php echo esc_html( $img_1[1] ); ?>" height="<?php echo esc_html( $img_1[2] ); ?>" alt="<?php echo esc_html( $loyalty_program_2_video_list[0]['image']['alt'] ); ?>">
                    </picture>
                    <?php if ( $loyalty_program_2_video_list[0]['subtitle'] ) { ?>
                        <span class="loyalty-program__video-subtitle"><?php echo esc_html( $loyalty_program_2_video_list[0]['subtitle'] ); ?></span>
                    <?php } ?>
                    <?php if ( $loyalty_program_2_video_list[0]['title'] ) { ?>
                        <span class="loyalty-program__video-title"><?php echo esc_html( $loyalty_program_2_video_list[0]['title'] ); ?></span>
                    <?php } ?>
                </a>
            </div>
            <div class="loyalty-program__line-block loyalty-program__line-block-1<?php echo esc_attr( $style ); ?>"></div>
        </div>
        <div class="loyalty-program__line loyalty-program__line-2">
            <div class="loyalty-program__line-block loyalty-program__line-block-2<?php echo esc_attr( $style ); ?>">
                <?php if ( $loyalty_program_2_logo ) { ?>
                    <img src="<?php echo esc_url( $loyalty_program_2_logo['url'] ); ?>" class="loyalty-program__logo" width="auto" height="auto" alt="<?php echo esc_html( $loyalty_program_2_logo['alt'] ); ?>">
                <?php } ?>
            </div>
            <div class="loyalty-program__video">
                <a href="#loyalty-program-video-2" class="<?php echo ! empty( $loyalty_program_2_video_list[1]['video_link'] ) ? esc_attr( 'js-open-popup-activator' ) : ''; ?> loyalty-program__video-link">
                    <?php
                    $img_2 = aq_resize( $loyalty_program_2_video_list[1]['image']['url'], 285, 330, true, false, true );
                    $img_2_mob = aq_resize( $loyalty_program_2_video_list[1]['image']['url'], 179, 201, true, false, true );
                    ?>
                    <picture>
                        <source srcset="<?php echo esc_url( $img_2_mob[0] ); ?>" media="(max-width: 390px)">
                        <img src="<?php echo esc_url( $img_2[0] ); ?>" class="loyalty-program__video-preview" width="<?php echo esc_attr( $img_2[1] ); ?>" height="<?php echo esc_attr( $img_2[1] ); ?>" alt="<?php echo esc_attr( $loyalty_program_2_video_list[1]['image']['alt'] ); ?>">
                    </picture>
                    <?php if ( $loyalty_program_2_video_list[1]['subtitle'] ) { ?>
                        <span class="loyalty-program__video-subtitle"><?php echo esc_html( $loyalty_program_2_video_list[1]['subtitle'] ); ?></span>
                    <?php } ?>
                    <?php if ( $loyalty_program_2_video_list[1]['title'] ) { ?>
                        <span class="loyalty-program__video-title"><?php echo esc_html( $loyalty_program_2_video_list[1]['title'] ); ?></span>
                    <?php } ?>
                </a>
            </div>
            <div class="loyalty-program__text-block loyalty-program__text-block-2<?php echo esc_attr( $style ); ?>">
                <?php if ( $loyalty_program_2_text_2 ) { ?>
                    <h2 class="loyalty-program__text loyalty-program__text-2<?php echo esc_attr( $style ); ?>"><?php echo esc_html( $loyalty_program_2_text_2 ); ?></h2>
                <?php } ?>
            </div>
        </div>
        <div class="loyalty-program__line loyalty-program__line-3">
            <div class="loyalty-program__line-block loyalty-program__line-block-3">
                <video class="loyalty-program__line-net-video" width="100%" height="100%" autoplay muted playsinline loop poster="<?php echo esc_url( $loyalty_program_2_net_video_poster['url'] ); ?>" >
                    <source src="<?php echo esc_url( $loyalty_program_2_net_video['url'] ); ?>" type="video/mp4">
                    Your browser doesn't support HTML5 video tag.
                </video>
            </div>
            <div class="loyalty-program__video">
                <a href="#loyalty-program-video-3" class="<?php echo ! empty( $loyalty_program_2_video_list[2]['video_link'] ) ? esc_attr( 'js-open-popup-activator' ) : ''; ?> loyalty-program__video-link">
                    <?php
                    $img_3 = aq_resize( $loyalty_program_2_video_list[2]['image']['url'], 285, 330, true, false, true );
                    $img_3_mob = aq_resize( $loyalty_program_2_video_list[2]['image']['url'], 179, 201, true, false, true );
                    ?>
                    <picture>
                        <source srcset="<?php echo esc_url( $img_3_mob[0] ); ?>" media="(max-width: 390px)">
                        <img src="<?php echo esc_url( $img_3[0] ); ?>" class="loyalty-program__video-preview" width="<?php echo esc_html( $img_3[1] ); ?>" height="<?php echo esc_html( $img_3[2] ); ?>" alt="<?php echo esc_html( $loyalty_program_2_video_list[2]['image']['alt'] ); ?>">
                    </picture>
                    <?php if ( $loyalty_program_2_video_list[2]['subtitle'] ) { ?>
                        <span class="loyalty-program__video-subtitle"><?php echo esc_html( $loyalty_program_2_video_list[2]['subtitle'] ); ?></span>
                    <?php } ?>
                    <?php if ( $loyalty_program_2_video_list[2]['title'] ) { ?>
                        <span class="loyalty-program__video-title"><?php echo esc_html( $loyalty_program_2_video_list[2]['title'] ); ?></span>
                    <?php } ?>
                </a>
            </div>
            
        </div>
    </div>
</section>
 
<?php
$c = 1;
foreach ( $loyalty_program_video_list as $item ) {
    if ( ! empty( $item['video_link'] ) ) {
        preg_match( '#(?<=(?:v|i)=)[a-zA-Z0-9-_]+|(?<=(?:v|i)\/)[^&?\n]+|(?<=embed\/)[^"&?\n]+|(?<=‌​(?:v|i)=)[^&?\n]+|(?<=youtu.be\/)[^&?\n]+#', $item['video_link'], $matches );
        $video_id = $matches[0];
        echo do_shortcode( '[popup_box box_id="loyalty-program-video-' . $c . '"]<div class="popup-iframe-wrapper js-iframe-video" data-url="https://www.youtube.com/embed/' . $video_id . '"></div>[/popup_box]' );
    }
    $c++;
}

?>
