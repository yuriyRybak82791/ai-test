<?php
/**
 * Block Name: Blog filters
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$blog_filters_hide = get_field_value( $page_fields, 'blog_filters_hide' );

/*
* exit if section is hidden
*/
if ( $blog_filters_hide ) {
    return;}

$blog_filters_title = get_field_value( $page_fields, 'blog_filters_title' );
$selected_category = ( isset( $_GET['blog-categories'] ) ) ? sanitize_text_field( wp_unslash( $_GET['blog-categories'] ) ) : '';
$categories = get_categories(
    array(
        'hide_empty' => true,
        'taxonomy'   => 'category',
        'parent' => 0,
        'exclude' => array( 1 ),
    )
);

?>
<section class="blog-filters <?php echo esc_html( $class_name ); ?>">
    <div class="container blog-filters__container">
        <?php if ( $blog_filters_title ) { ?>
            <h2 class="blog-filters__title"><?php echo esc_html( $blog_filters_title ); ?></h2>
        <?php } ?>
        <div class="blog-filters__wrapper">
            <form action="<?php echo esc_attr( get_permalink( get_the_ID() ) ); ?>#blog-posts" method="get" class="blog-filters__form js-blog-filters-form">
                <div class="blog-filters__filter">
                    <select name="blog-categories" id="blog-categories" class="blog-filters__select js-blog-categories">
                        <option value="all"><?php esc_html_e( 'כל הקטגוריות', 'wp-rock' ); ?></option>
                        <?php foreach ( $categories as $category ) : ?>
                            <option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $selected_category, $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="select-box select-box-blog-categories">
                        <div class="select-box__selected
                        <?php
                        if ( ! empty( $selected_category ) && 'all' !== $selected_category ) {
                            echo esc_attr( ' active' ); }
                        ?>
                        " id="select-box__selected-blog-categories" data-role="open-select">
                        <?php
                        if ( ! empty( $selected_category ) && 'all' !== $selected_category ) {
                            echo esc_html( get_cat_name( wp_unslash( $selected_category ) ) );
                        } else {
                            esc_html_e( 'כל הקטגוריות', 'wp-rock' );
                        }
                        ?>
                                
                        </div>
                        <div class="select-box__wrapper">
                            <ul class="select-box__variations">
                                <li class="select-box__variation
                                <?php
                                if ( empty( $selected_category ) || 'all' === $selected_category ) {
                                    echo esc_attr( ' active' ); }
                                ?>
                                " data-value="all" data-attribute="blog-categories" data-role="click-select"><?php esc_html_e( 'כל הקטגוריות', 'wp-rock' ); ?></li>
                                <?php
                                foreach ( $categories as $item ) {
                                    $selected = '';
                                    if ( ! empty( $selected_category ) && (int) $selected_category === $item->term_id ) {
                                        $selected = ' active';
                                    }
                                    echo '<li class="select-box__variation' . esc_attr( $selected ) . '" data-value="' . esc_attr( $item->term_id ) . '" data-attribute="blog-categories" data-role="click-select">' . esc_html( $item->name ) . '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="blog-filters__filter">
                    <select name="blog-order" id="blog-order" class="blog-filters__select js-blog-order">
                        <option value="" disabled selected hidden><?php esc_html_e( 'לפי תאריך', 'wp-rock' ); ?></option>
                        <?php
                        $selected_asc = '';
                        $active_asc = '';
                        if ( isset( $_GET['blog-order'] ) && 'ASC' === $_GET['blog-order'] ) {
                            $selected_asc = ' selected';
                            $active_asc = ' active';
                        }
                        $selected_desc = '';
                        $active_desc = '';
                        if ( isset( $_GET['blog-order'] ) && 'DESC' === $_GET['blog-order'] ) {
                            $selected_desc = ' selected';
                            $active_desc = ' active';
                        }
                        ?>
                        <option value="ASC"<?php echo esc_attr( $selected_asc ); ?>><?php esc_html_e( 'מהישן לחדש', 'wp-rock' ); ?></option>
                        <option value="DESC"<?php echo esc_attr( $selected_desc ); ?> ><?php esc_html_e( 'מחדש לישן', 'wp-rock' ); ?></option>
                    </select>
                    <div class="select-box select-box-blog-order">
                        <div class="select-box__selected
                        <?php
                        if ( isset( $_GET['blog-order'] ) ) {
                            echo esc_attr( ' active' ); }
                        ?>
                        " id="select-box__selected-blog-order" data-role="open-select">
                        <?php
                        if ( isset( $_GET['blog-order'] ) && 'ASC' === $_GET['blog-order'] ) {
                            esc_html_e( 'מהישן לחדש', 'wp-rock' );
                        } elseif ( isset( $_GET['blog-order'] ) && 'DESC' === $_GET['blog-order'] ) {
                            esc_html_e( 'מחדש לישן', 'wp-rock' );
                        } else {
                            esc_html_e( 'לפי תאריך', 'wp-rock' );
                        }
                        ?>
                        </div>
                        <div class="select-box__wrapper">
                            <ul class="select-box__variations">
                                <li class="select-box__variation<?php echo esc_attr( $active_asc ); ?>" data-value="ASC" data-attribute="blog-order" data-role="click-select"
                                ><?php esc_html_e( 'מהישן לחדש', 'wp-rock' ); ?></li>
                                <li class="select-box__variation<?php echo esc_attr( $active_desc ); ?>" data-value="DESC" data-attribute="blog-order" data-role="click-select"><?php esc_html_e( 'מחדש לישן', 'wp-rock' ); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</section>
