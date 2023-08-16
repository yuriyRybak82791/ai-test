<?php
/**
 * Block Name: CTA block
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$cta_section_hide = get_field_value( $page_fields, 'cta_section_hide' );

/*
* exit if section is hidden
*/
if ( $cta_section_hide ) {
    return;}

$cta_section_title = get_field_value( $page_fields, 'cta_section_title' );
$cta_section_text = get_field_value( $page_fields, 'cta_section_text' );
$cta_section_cta = get_field_value( $page_fields, 'cta_section_cta' );

?>
<section class="cta-section mt-12 mb-10">
    <div class="cta-section__container container row mx-auto flex-column flex-lg-row">
        <div class="cta-section__aside">
            <?php if ( $cta_section_title ) { ?>
                <h2 class="cta-section__title" data-text="<?php echo esc_html( $cta_section_title ); ?>"><span class="cta-section__title_bg"></span><?php echo esc_html( $cta_section_title ); ?></h2>
            <?php } ?>
        </div>
        <div class="cta-section__content">
            <div class="cta-section__content-wrapper">
                <?php if ( $cta_section_text ) { ?>
                    <p class="cta-section__text mb-3"><?php echo esc_html( $cta_section_text ); ?></p>
                <?php } ?>
                <?php if ( $cta_section_cta ) { ?>  
                    <div class="cta-section__button-wrapper">
                        <a href="<?php echo esc_url( $cta_section_cta['url'] ); ?>" class="btn btn-arrow cta-section__button"<?php echo ( $cta_section_cta['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $cta_section_cta['title'] ); ?></a>
                    </div>
                <?php } ?>
            </div>
            <div class="cta-section__line d-none d-lg-block"></div>
        </div>
    </div>
</section>
