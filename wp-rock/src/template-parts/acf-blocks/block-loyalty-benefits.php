<?php
/**
 * Block Name: Loyalty benefits
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$loyalty_benefits_hide = get_field_value( $page_fields, 'loyalty_benefits_hide' );

/*
* exit if section is hidden
*/
if ( $loyalty_benefits_hide ) {
    return;
}

$loyalty_benefits_title = get_field_value( $page_fields, 'loyalty_benefits_title' );
$loyalty_benefits_list = get_field_value( $page_fields, 'loyalty_benefits_list' );

?>
<section class="section-loyalty-benefits pt-4 pb-6 pt-lg-8 pb-lg-8 <?php echo esc_html( $class_name ); ?>">
    <div class="container section-loyalty-benefits__container">
        <?php if ( $loyalty_benefits_title ) { ?>
            <h2 class="section-loyalty-benefits__title mx-n2 mx-sm-0 mb-lg-3 mb-xl-0 text-center"><?php echo esc_html( $loyalty_benefits_title ); ?></h2>
        <?php } ?>
        <div class="section-loyalty-benefits__wrapper d-flex justify-content-center justify-content-lg-between">
            <?php $counter = 1; ?>
            <?php foreach ( $loyalty_benefits_list as $item ) { ?>
                <div class="section-loyalty-benefits__benefit<?php echo $counter < 4 ? ' mb-4 mb-lg-0 ' : ' '; ?>color-white">
                    <div class="section-loyalty-benefits__benefit-inner">
                        <picture>
                            <?php
                            $image = aq_resize( $item['image']['url'], 216, 412, true, false, true );
                            $image_mob = aq_resize( $item['image']['url'], 113, 200, true, false, true );
                            ?>
                            <source srcset="<?php echo esc_url( $image_mob[0] ); ?>" media="(max-width: 428px)">
                            <img src="<?php echo esc_url( $image[0] ); ?>"
                                 class="section-loyalty-benefits__benefit-image mw-100"
                                 width="<?php echo esc_attr( $image[1] ); ?>"
                                 height="<?php echo esc_attr( $image[2] ); ?>"
                                 alt="<?php echo esc_attr( $item['name'] ); ?>">
                        </picture>
                        <div class="section-loyalty-benefits__benefit-counter"><?php echo esc_html( str_pad( $counter, 2, '0', STR_PAD_LEFT ) ); // Pad counter with "0" if less than 10 ?></div>
                        <?php if ( ! empty( $item['name'] ) ) { ?>
                            <p class="section-loyalty-benefits__benefit-name"><?php echo esc_html( $item['name'] ); ?></p>
                        <?php } ?>
                    </div>
                </div>
                <?php $counter++; ?>
            <?php } ?>
        </div>
        <div class="section-loyalty-benefits__info">
            <div class="section-loyalty-benefits__info-wrapper js-info-block">
                <div class="section-loyalty-benefits__info-inner pt-2">
                    <?php $counter = 1; ?>
                    <?php foreach ( $loyalty_benefits_list as $item ) { ?>
                        <div class="section-loyalty-benefits__item py-3 py-lg-2 px-2 px-lg-5 mb-1">
                            <div class="section-loyalty-benefits__item-counter px-2 pt-1 py-lg-1"><?php echo esc_html( str_pad( $counter, 2, '0', STR_PAD_LEFT ) ); // Pad counter with "0" if less than 10 ?></div>
                            <?php if ( ! empty( $item['name'] ) ) { ?>
                                <p class="section-loyalty-benefits__item-name px-2 py-1 mb-0"><?php echo esc_html( $item['name'] ); ?></p>
                            <?php } ?>

                            <?php
                            for ( $i = 0; $i <= 2; $i++ ) {
                                $text = $item['benefits'][ $i ]['text'];
                                ?>
                                <div class="section-loyalty-benefits__item-benefit px-2<?php echo $text ? ' py-1' : ''; ?>">
                                    <?php echo $item['benefits'][ $i ] ? esc_html( $text ) : ''; ?>
                                </div>
                            <?php } ?>

                        </div>
                        <?php $counter++; ?>
                    <?php } ?>
                </div>
            </div>
            <label for="section-loyalty-benefits__info-toggle js-info-toggle"
                   class="section-loyalty-benefits__info-btn mt-2 mt-lg-3 btn btn-arrow btn-arrow_vertical"
                   data-role="show-hide-info">
                <span class="not-active-text"><?php esc_html_e( 'לרשימת ההטבות המלאה', 'wp-rock' ); ?></span>
                <span class="active-text"><?php esc_html_e( 'סגירת רשימת ההטבות', 'wp-rock' ); ?></span>
            </label>
        </div>
    </div>
</section>
