<?php
/**
 * Block Name: Sponsors list
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$sponsors_list_hide = get_field_value( $page_fields, 'sponsors_list_hide' );

/*
* exit if section is hidden
*/
if ( $sponsors_list_hide ) {
    return;}

$sponsors_list_sponsors = get_field_value( $page_fields, 'sponsors_list_sponsors' );

?>
<section class="sponsors-list <?php echo esc_html( $class_name ); ?>">
    <div class="container">
        <div class="sponsors-list__wrapper">
        <?php
        foreach ( $sponsors_list_sponsors as $item ) {
            ?>
            <div class="sponsors-list__card">
                <div class="sponsors-list__card-wrapper">
                    <div class="sponsors-list__card-logo-wrapper">
                    <?php if ( ! empty( $item['logo'] ) ) { ?>
                            <?php
                                $logo_width = 0 === $item['logo']['width'] ? 'auto' : $item['logo']['width'];
                                $logo_height = 0 === $item['logo']['height'] ? 'auto' : $item['logo']['height'];
                            ?>
                            <img src="<?php echo esc_url( $item['logo']['url'] ); ?>" class="sponsors-list__card-logo" width="<?php echo esc_attr( $logo_width ); ?>" height="<?php echo esc_attr( $logo_height ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
                        <?php } ?>
                    </div>
                    <div class="sponsors-list__card-content">
                        <?php if ( ! empty( $item['name'] ) ) { ?>
                            <h3 class="sponsors-list__card-name"><?php echo esc_html( $item['name'] ); ?></h3>
                        <?php } ?>
                        <?php if ( ! empty( $item['name'] ) ) { ?>
                            <p class="sponsors-list__card-text"><?php echo esc_html( $item['text'] ); ?></p>
                        <?php } ?>
                    </div>
                    
                </div>
                <?php if ( $item['link'] ) { ?>  
                    <div class="sponsors-list__card-link-wrapper">
                        <a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="sponsors-list__card-link"<?php echo ( $item['link']['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $item['link']['title'] ); ?></a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        </div>
    </div>
</section>
