<?php
/**
 * Block Name: FAQs
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$faq_block_hide = get_field_value( $page_fields, 'faq_block_hide' );

/*
* exit if section is hidden
*/
if ( $faq_block_hide ) {
    return;}

$faq_block_title = get_field_value( $page_fields, 'faq_block_title' );
$faq_block_questions = get_field_value( $page_fields, 'faq_block_questions' );

?>
<section class="section-faqs my-8 <?php echo esc_html( $class_name ); ?>">
    <div class="container faq__container">
        <?php if ( $faq_block_title ) { ?>
            <h2 class="faq__title h6 h3-lg mb-4 text-center"><?php echo esc_html( $faq_block_title ); ?></h2>
        <?php } ?>
        <?php if ( $faq_block_questions ) { ?>
            <div class="faq__questions" itemscope="" itemtype="https://schema.org/FAQPage">
            <?php
            foreach ( $faq_block_questions as $item ) {
                ?>
                <div class="faq__item js-slide-item" itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <p class="faq__question m-0" data-role="slide-down-up" itemprop="name" aria-expanded="false"><span><?php echo esc_html( $item->post_title ); ?></span></p>
                    <div class="faq__answer js-slide-block" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                        <div class="faq__answer-inner">
                            <p class="faq__answer-text mb-0 pt-1 pt-lg-2"><?php echo esc_html( $item->post_content ); ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        <?php } ?>
    </div>
</section>
