<?php
/**
 * Custom video preview template
 *
 * @package WP-rock
 */

global $global_options;

$preview_desktop_video = get_field_value( $global_options, 'preview_desktop_video' );
$preview_desktop_video_poster = get_field_value( $global_options, 'preview_desktop_video_poster' );
$preview_mobile_video = get_field_value( $global_options, 'preview_mobile_video' );
$preview_mobile_video_poster = get_field_value( $global_options, 'preview_mobile_video_poster' );

$detect = new \Detection\MobileDetect();

// Determine the appropriate video URL based on the device type.
if ( $detect->isMobile() && ! $detect->isTablet() ) {
    $video_url = $preview_mobile_video['url'];
    $video_poster = $preview_mobile_video_poster;
} else {
    $video_url = $preview_desktop_video['url'];
    $video_poster = $preview_desktop_video_poster;
}

?>

<div class="video-preview js-video-preview-container">
    <video class="video-preview__video js-video-preview" preload="none" autoplay muted playsinline poster="<?php echo esc_url( $video_poster ); ?>">
        <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
        Your browser doesn't support HTML5 video tag.
    </video>
    <div class="video-preview__controls">
        <button type="button" class="video-preview__btn video-preview__skip js-skip-preview" aria-label="Skip" title="Skip"><?php esc_html_e( 'Skip', 'wp-rock' ); ?></button>
        <button type="button" class="video-preview__btn video-preview__play-stop js-play-stop-preview" aria-label="Play/Stop" title="Play/Stop"></button>
        <button type="button" class="video-preview__btn video-preview__mute-unmute js-mute-unmute-preview" aria-label="Mute/Unmute" title="Mute/Unmute"></button>
    </div>
    
</div>
