<?php
/**
 * Block Name: External news
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$external_news_hide = get_field_value( $page_fields, 'external_news_hide' );
$pag_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$selected_category = ( isset( $_GET['blog-categories'] ) ) ? sanitize_text_field( wp_unslash( $_GET['blog-categories'] ) ) : '';
$selected_order = ( isset( $_GET['blog-order'] ) ) ? sanitize_text_field( wp_unslash( $_GET['blog-order'] ) ) : '';


/*
* exit if section is hidden
*/
if ( $external_news_hide || $pag_paged > 1 || ! empty( $selected_category ) || ! empty( $selected_order ) ) {
    return;
}

$external_news_title = get_field_value( $page_fields, 'external_news_title' );
$external_news_text = get_field_value( $page_fields, 'external_news_text' );
$external_news_mirror = get_field_value( $page_fields, 'external_news_mirror' );
$external_news_list = get_field_value( $page_fields, 'external_news_list' );
$external_news_button = get_field_value( $page_fields, 'external_news_button' );
$external_news_mask = get_field_value( $page_fields, 'external_news_mask' );
$external_news_vertical_paddings = get_field_value( $page_fields, 'external_news_vertical_paddings' );
$vertical_paddings = ' my-10';

$mask_class = !$external_news_mask ? ' mask' : '';

if ( $external_news_vertical_paddings ) {
    if ( $external_news_vertical_paddings === 'remove-top' ) {
        $vertical_paddings = ' mt-1 mb-9';
    }
    if ( $external_news_vertical_paddings === 'remove-bottom' ) {
        $vertical_paddings = ' mt-4 mt-lg-9 mb-1';
    }
}
$merrored_class = $external_news_mirror ? ' flex-row-reverse' : '';
?>
<section class="external-news
<?php
echo esc_attr( $vertical_paddings );
echo esc_attr( $class_name );
?>
">
    <div class="container external-news__container">
        <?php if ( $external_news_title ) { ?>
            <h2 class="external-news__title h3 h2-lg mb-1 mb-lg-2 mb-lg-3 text-center"><?php echo esc_html( $external_news_title ); ?></h2>
        <?php } ?>
        <?php if ( $external_news_text ) { ?>
            <div class="external-news__text subtitle text-center mb-3 mt-1 mt-lg-2 mb-lg-2"><?php echo wp_kses_post( $external_news_text ); ?></div>
        <?php } ?>
        <?php if ( $external_news_list ) { ?>
            <div class="external-news__row row mx-n50<?php echo esc_html( $merrored_class ); ?>">
                <?php
                $c = 1;
                foreach ( $external_news_list as $item ) {
                    ?>
                    <?php if ( $c < 3 ) { ?>
                        <div class="external-news__col<?php echo $c === 2 ? ' external-news__col_second ' : ' external-news__col_first '; ?>col-md-6 px-50">
                    <?php } ?>
                    <div class="external-news__card external-news__card-<?php echo esc_html( $c ); ?>">
                        <?php
                            $tag_open = 'div';
                            $tag_close = 'div';
                            if( ! empty( $item['link'] ) ){
                                $tag_open = 'a href="' .esc_url( $item['link'] ). '"';
                                $tag_close = 'a';
                            }
                        ?>
                        <<?php echo $tag_open; ?>
                           class="external-news__card-link<?php echo $item['add_video'] && ! empty( $item['video'] ) ? ' external-news__card-link_type-video' : ''; ?><?php echo esc_attr( $mask_class ); ?>">
                            <?php if ( $item['add_video'] && ! empty( $item['video'] ) ) { ?>
                                <video class="external-news__card-video" width="100%" height="100%" autoplay
                                       muted playsinline loop
                                       poster="<?php echo esc_url( $item['video_poster']['url'] ); ?>">
                                    <source src="<?php echo esc_url( $item['video']['url'] ); ?>" type="video/mp4">
                                    Your browser doesn't support HTML5 video tag.
                                </video>
                            <?php } else { ?>
                                <?php
                                if ( 1 === $c ) {
                                    $image = aq_resize( $item['image']['url'], 618, 757, true, false, true );
                                    $image_mob = aq_resize( $item['image']['url'], 358, 434, true, false, true );
                                } else {
                                    $image = aq_resize( $item['image']['url'], 615, 376, true, false, true );
                                    $image_mob = aq_resize( $item['image']['url'], 358, 214, true, false, true );
                                }

                                ?>
                                <picture>
                                    <source srcset="<?php echo esc_url( $image_mob[0] ); ?>"
                                            media="(max-width: 390px)">
                                    <img src="<?php echo esc_url( $image[0] ); ?>"
                                         class="external-news__card-image"
                                         width="<?php echo esc_html( $image[1] ); ?>"
                                         height="<?php echo esc_html( $image[2] ); ?>"
                                         alt="<?php echo esc_html( $item['name'] ); ?>">
                                </picture>

                            <?php } ?>
                            <span class="external-news__card-content">
                                <?php if ( $item['category'] ) { ?>
                                    <span class="external-news__card-category"><?php echo esc_html( $item['category'] ); ?></span>
                                <?php } ?>
                                <?php if ( $item['name'] ) { ?>
                                    <span class="external-news__card-name"><?php echo esc_html( $item['name'] ); ?></span>
                                <?php } ?>
                            </span>
                        </<?php echo $tag_close; ?>>
                    </div>
                    <?php if ( $c !== 2 ) { ?>
                        </div>
                    <?php } ?>
                    <?php $c++; ?>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if ( $external_news_button ) { ?>
            <div class="external-news__button-wrapper text-center mt-3 mt-lg-5">
                <a href="<?php echo esc_url( $external_news_button['url'] ); ?>"
                   class="external-news__button btn btn-arrow"<?php echo( $external_news_button['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $external_news_button['title'] ); ?></a>
            </div>
        <?php } ?>
    </div>
</section>
