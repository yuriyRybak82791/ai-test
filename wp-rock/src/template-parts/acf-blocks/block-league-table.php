<?php
/**
 * Block Name: League table
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$league_table_hide = get_field_value( $page_fields, 'league_table_hide' );

/*
* exit if section is hidden
*/
if ( $league_table_hide ) {
    return;}

$league_table_table = get_field_value( $page_fields, 'league_table_table' );
// Custom comparison function to sort by the 'points' key in descending order
function sortByPoints( $a, $b ) {
    return intval( $b['points'] ) - intval( $a['points'] );
}
usort( $league_table_table, 'sortByPoints' );

?>
<section class="league-table-section mb-6 mb-md-11 mt-5 mt-sm-11 <?php echo esc_html( $class_name ); ?>">
    <div class="container">
        <div class="league-table-section__container">
            <div class="league-table-section__table-header-wrapper js-scroll-header">
                <table class="league-table-section__table-header">
                    <thead>
                        <tr>
                            <th class="position"><?php esc_html_e( 'מקום', 'wp-rock' ); ?></th>
                            <th class="team"><?php esc_html_e( 'קבוצה', 'wp-rock' ); ?></th>
                            <th class="games"><?php esc_html_e( 'מס׳ משחקים', 'wp-rock' ); ?></th>
                            <th class="victories"><?php esc_html_e( 'נצחונות', 'wp-rock' ); ?></th>
                            <th class="draw"><?php esc_html_e( 'תיקו', 'wp-rock' ); ?></th>
                            <th class="losses"><?php esc_html_e( 'הפסדים', 'wp-rock' ); ?></th>   
                            <th class="for"><?php esc_html_e( 'שערי זכות', 'wp-rock' ); ?></th>
                            <th class="ga"><?php esc_html_e( 'שערי חובה', 'wp-rock' ); ?></th>
                            <th class="diff"><?php esc_html_e( 'הפרש שערים', 'wp-rock' ); ?></th>
                            <th class="points"><?php esc_html_e( 'נקודות', 'wp-rock' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="league-table-section__table-wrapper js-scroll-content">
                <table class="league-table-section__table-body">
                    <tbody>
                    <?php
                        $pos = 1;
                    foreach ( $league_table_table as $row ) {
                        ?>
                        <tr class="<?php echo ( $row['highlight'] ? 'highlight' : '' ); ?>">
                            <td class="position"><?php echo esc_html( $pos ); ?></td>
                            <td class="team">
                                <p class="team-field">
                                    <span class=""><?php echo esc_html( $row['team'] ); ?></span>
                                <?php
                                if ( ! empty( $row['logo'] ) ) {
                                    $logo_width = 0 === $row['logo']['width'] ? 'auto' : $row['logo']['width'];
                                    $logo_height = 0 === $row['logo']['height'] ? 'auto' : $row['logo']['height'];
                                    ?>
                                        <img src="<?php echo esc_url( $row['logo']['url'] ); ?>" class="team-logo" width="<?php echo esc_attr( $logo_width ); ?>" height="<?php echo esc_attr( $logo_height ); ?>" alt="<?php echo esc_attr( $row['logo']['alt'] ); ?>">
                                    <?php } ?>
                                </p>
                            </td>
                            <td class="games"><?php echo esc_html( $row['games'] ); ?></td>
                            <td class="victories"><?php echo esc_html( $row['victories'] ); ?></td>
                            <td class="draw"><?php echo esc_html( $row['draw'] ); ?></td>
                            <td class="losses"><?php echo esc_html( $row['losses'] ); ?></td>
                            <td class="for"><?php echo esc_html( $row['for'] ); ?></td>
                            <td class="ga"><?php echo esc_html( $row['ga'] ); ?></td>
                            <td class="diff"><?php echo esc_html( $row['diff'] ); ?></td>
                            <td class="points"><?php echo esc_html( $row['points'] ); ?></td>
                        </tr>
                        <?php
                        $pos++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
