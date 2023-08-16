<?php
/**
 * Block Name: TikTok videos
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$tiktok_videos_hide = get_field_value( $page_fields, 'tiktok_videos_hide' );

/*
* exit if section is hidden
*/
if ( $tiktok_videos_hide ) {
    return;
}

$tiktok_videos_hastag = get_field_value( $page_fields, 'tiktok_videos_hastag' );
$tiktok_videos_videos = get_field_value( $page_fields, 'tiktok_videos_videos' );

?>
<section class="tiktok-videos my-9 my-lg-12<?php echo esc_html( $class_name ); ?>">
    <div class="container tiktok-videos__container">
        <?php if ( $tiktok_videos_hastag ) { ?>
            <div class="tiktok-videos__hastag text-center"
                 data-text="<?php echo esc_html( $tiktok_videos_hastag ); ?>"><?php echo esc_html( $tiktok_videos_hastag ); ?></div>
        <?php } ?>
        <?php if ( $tiktok_videos_videos ) { ?>
            <div class="tiktok-videos__wrapper">
                    <?php foreach ( $tiktok_videos_videos as $video ) { ?>
                        <div class="tiktok-videos__item">
                            <a href="<?php echo esc_url( $video['link'] ); ?>" class="tiktok-videos__item-link">
                                <video class="tiktok-videos__item-video" width="342" height="609" autoplay muted
                                       playsinline loop poster="<?php echo esc_html( $video['video_poster']['url'] ); ?>">
                                    <source src="<?php echo esc_url( $video['video'] ); ?>" type="video/mp4">
                                    Your browser doesn't support HTML5 video tag.
                                </video>
                            </a>
                        </div>
                    <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
