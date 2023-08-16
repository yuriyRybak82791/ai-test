<?php
/**
 * Block Name: Shop now
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$shop_now_hide = get_field_value( $page_fields, 'shop_now_hide' );

/*
* exit if section is hidden
*/
if ( $shop_now_hide ) {
    return;
}

$shop_now_title = get_field_value( $page_fields, 'shop_now_title' );
$shop_now_barcode = get_field_value( $page_fields, 'shop_now_barcode' );
$shop_now_running_line_text = get_field_value( $page_fields, 'shop_now_running_line_text' );
$shop_now_images = get_field_value( $page_fields, 'shop_now_images' );
$shop_now_button = get_field_value( $page_fields, 'shop_now_button' );

?>
<section class="shop-now my-lg-15 my-8 <?php echo esc_html( $class_name ); ?>">
    <div class="shop-now__container container-fluid">
        <div class="shop-now__wrapper">
            <?php if ( $shop_now_title ) { ?>
                <h2 class="shop-now__title"><?php echo $shop_now_title; ?></h2>
            <?php } ?>
            <?php if ( $shop_now_running_line_text ) { ?>

                <div class="shop-now__running-line shop-now__running-line-1">
                    <div class="shop-now__running-line-wrapper">
                        <?php for ( $i = 0; $i < 15; $i++ ) { ?>
                            <div class="shop-now__running-line-text"><?php echo esc_html( $shop_now_running_line_text ); ?>
                                <span class="shop-now__running-line-text-dash"> - </span></div>
                        <?php } ?>
                    </div>
                    <div class="shop-now__running-line-wrapper">
                        <?php for ( $i = 0; $i < 15; $i++ ) { ?>
                            <div class="shop-now__running-line-text"><?php echo esc_html( $shop_now_running_line_text ); ?>
                                <span class="shop-now__running-line-text-dash"> - </span></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="shop-now__running-line shop-now__running-line-2">
                    <div class="shop-now__running-line-wrapper shop-now__running-line-wrapper-reverse">
                        <?php for ( $i = 0; $i < 15; $i++ ) { ?>
                            <div class="shop-now__running-line-text"><?php echo esc_html( $shop_now_running_line_text ); ?>
                                <span class="shop-now__running-line-text-dash"> - </span></div>
                        <?php } ?>
                    </div>
                    <div class="shop-now__running-line-wrapper shop-now__running-line-wrapper-reverse">
                        <?php for ( $i = 0; $i < 15; $i++ ) { ?>
                            <div class="shop-now__running-line-text"><?php echo esc_html( $shop_now_running_line_text ); ?>
                                <span class="shop-now__running-line-text-dash"> - </span></div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="shop-now__body">
                <div class="shop-now__body-col shop-now__body-col-1"></div>
                <div class="shop-now__body-col shop-now__body-col-2"></div>
                <div class="shop-now__body-col shop-now__body-col-3 shop-now__images<?php echo esc_html( count( $shop_now_images ) > 1 ? ' js-shop-images' : '' ); ?>">
                    <?php
                    $c = 1;
                    foreach ( $shop_now_images as $item ) {
                        ?>
                        <div class="shop-now__image-wrapper<?php echo esc_html( count( $shop_now_images ) > 1 ? ' js-shop-image' : '' ); ?>"
                            <?php echo( $c >= 2 ? ' style="display:none;"' : '' ); ?>
                        >
                            <?php
                            $image = aq_resize( $item['image']['url'], 564, 804, true, false, true );
                            ?>
                            <img src="<?php echo esc_url( $image[0] ); ?>" class="shop-now__image"
                                 width="<?php echo esc_html( $image[1] ); ?>" height="<?php echo esc_html( $image[2] ); ?>"
                                 alt="<?php echo esc_html( $item['image']['alt'] ); ?>">
                        </div>
                        <?php
                        $c++;
                    }
                    ?>
                    <?php
                    if ( $shop_now_barcode ) {
                        $image = aq_resize( $shop_now_barcode['url'], 219, 105, true, false, true );
                        ?>
                        <img src="<?php echo esc_url( $image[0] ); ?>" class="shop-now__barcode"
                             width="<?php echo esc_html( $image[1] ); ?>" height="<?php echo esc_html( $image[2] ); ?>"
                             alt="<?php echo esc_html( $shop_now_barcode['alt'] ); ?>">
                    <?php } ?>
                </div>
                <div class="shop-now__body-col shop-now__body-col-4"></div>
                <div class="shop-now__body-col shop-now__body-col-5"></div>
            </div>
        </div>
        <?php if ( $shop_now_button ) { ?>
            <div class="shop-now__button-wrapper text-center mt-5">
                <a href="<?php echo esc_url( $shop_now_button['url'] ); ?>"
                   class="shop-now__button btn btn-arrow"<?php echo( $shop_now_button['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $shop_now_button['title'] ); ?></a>
            </div>
        <?php } ?>
    </div>
</section>
