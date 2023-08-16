<?php
/**
 * Block Name: Matches list
 *
 * @package WP-rock
 * @since 4.4.0
 */

$page_fields = get_fields();
$class_name = isset( $block['className'] ) ? $class_name : '';
$matches_list_hide = get_field_value( $page_fields, 'matches_list_hide' );

/*
* exit if section is hidden
*/
if ( $matches_list_hide ) {
    return;
}

$matches_list_list = get_field_value( $page_fields, 'matches_list_list' );
$matches_list_scoreboard = get_field_value( $page_fields, 'matches_list_scoreboard' );
$matches_list_button = get_field_value( $page_fields, 'matches_list_button' );
$matches_list_games_btn_text = get_field_value( $page_fields, 'matches_list_games_btn_text' );
$matches_list_scoreboard_btn_text = get_field_value( $page_fields, 'matches_list_scoreboard_btn_text' );

?>
<section class="matches-list mt-9 mb-7 mb-lg-12 <?php echo esc_html( $class_name ); ?>">
    <div class="matches-list__container container">
        <div class="matches-list__wrapper px-2">
            <?php
            $c = 1;
            foreach ( $matches_list_list as $item ) {
                if ( $c > 3 ) {
                    break;
                }
                ?>
                <div class="matches-list__match-item row flex-nowrap align-items-center justify-content-between mb-2 py-2 py-md-1 px-lg-2">
                    <div class="matches-list__match-item__place col-auto col-xl-3 order-2 order-md-1"><span><?php echo esc_html( $item['date'] ); ?></span><span><?php echo esc_html( $item['time'] ); ?></span><span><?php echo esc_html( $item['place'] ); ?></span></div>
                    <div class="matches-list__match-item__teams col-auto col-md col-xl-6 order-1 order-md-2">
                        <div class="matches-list__match-item__team matches-list__match-item__team-1">
                            <?php if ( ! empty( $item['team_1_logo'] ) ) { ?>
                                <img src="<?php echo esc_url( $item['team_1_logo']['url'] ); ?>"
                                     class="matches-list__match-item__logo" width="auto" height="auto"
                                     alt="<?php echo esc_html( $item['team_1_logo']['alt'] ); ?>">
                            <?php } ?>
                            <div class="matches-list__match-item__name"><?php echo esc_html( $item['team_1_name'] ); ?></div>
                            <div class="matches-list__match-item__score-mobile d-md-none"><?php echo esc_html( $item['team_1_goals'] ); ?></div>
                        </div>
                        <div class="matches-list__match-item__score px-3 px-lg-4 d-none d-md-block"><?php echo esc_html( $item['team_1_goals'] . '-' . $item['team_2_goals'] ); ?></div>
                        <div class="matches-list__match-item__team matches-list__match-item__team-2">
                            <?php if ( ! empty( $item['team_2_logo'] ) ) { ?>
                                <img src="<?php echo esc_url( $item['team_2_logo']['url'] ); ?>"
                                     class="matches-list__match-item__logo" width="auto" height="auto"
                                     alt="<?php echo esc_html( $item['team_2_logo']['alt'] ); ?>">
                            <?php } ?>
                            <div class="matches-list__match-item__team-name"><?php echo esc_html( $item['team_2_name'] ); ?></div>
                            <div class="matches-list__match-item__score-mobile d-md-none"><?php echo esc_html( $item['team_2_goals'] ); ?></div>
                        </div>
                    </div>
                    <div class="matches-list__match-item__ligue col-auto col-xl-3 order-3">
                        <?php if ( ! empty( $item['ligue_logo'] ) ) { ?>
                            <img src="<?php echo esc_url( $item['ligue_logo']['url'] ); ?>"
                                 class="matches-list__match-item__ligue-logo"
                                 width="<?php echo esc_attr( $item['ligue_logo']['width'] ); ?>"
                                 height="<?php echo esc_attr( $item['ligue_logo']['height'] ); ?>"
                                 alt="<?php echo esc_attr( $item['ligue_logo']['alt'] ); ?>">
                        <?php } ?>
                    </div>
                </div>
                <?php
                $c++;
            }
            ?>
        </div>
        <div class="matches-list__button-wrapper text-center mt-3 mt-lg-5">
            <a href="#popup-matches-list"
               class="matches-list__button btn btn-arrow js-open-popup-activator"><?php echo esc_html( $matches_list_games_btn_text ); ?></a>
            <?php if($matches_list_scoreboard){ ?>  
            <a href="#popup-scoreboard"
               class="matches-list__button btn btn-border js-open-popup-activator"><?php echo esc_html( $matches_list_scoreboard_btn_text ); ?></a>
            <?php } ?>
            <?php if ( $matches_list_button ) { ?>  
                <a href="<?php echo esc_url( $matches_list_button['url'] ); ?>" class="btn btn-border matches-list__link"<?php echo ( $matches_list_button['target'] ? ' target="_blank"' : '' ); ?>><?php echo esc_html( $matches_list_button['title'] ); ?></a>
            <?php } ?>
        </div>
    </div>
    <?php
    $matches_list_html = '<div class="container px-1"><div class="matches-list__match-item-wrapper px-2">';
    foreach ( $matches_list_list as $item ) {
        $matches_list_html .= '
                <div class="matches-list__match-item row flex-nowrap align-items-center justify-content-between mb-3 py-2">
                    <div class="matches-list__match-item__place col-auto col-xl-3 order-2 order-md-1"><span>' . esc_html( $item['date'] ) . '</span><span>' . esc_html( $item['time'] ) . '</span><span>' . esc_html( $item['place'] ) . '</span></div>
                    <div class="matches-list__match-item__teams col-auto col-md col-xl-6 order-1 order-md-2">
                        <div class="matches-list__match-item__team matches-list__match-item__team-1">';
        if ( ! empty( $item['team_1_logo'] ) ) {
            $matches_list_html .= '<img src="' . esc_url( $item['team_1_logo']['url'] ) . '"
                                class="matches-list__match-item__logo" width="auto" height="auto"
                                alt="' . esc_html( $item['team_1_logo']['alt'] ) . '">';
        }
        $matches_list_html .= '
                            <div class="matches-list__match-item__name">' . esc_html( $item['team_1_name'] ) . '</div>
                        <div class="matches-list__match-item__score-mobile d-md-none">' . esc_html( $item['team_1_goals'] ) . '</div>
                        </div>
                        <div class="matches-list__match-item__score px-3 px-lg-4 d-none d-md-block">' . esc_html( $item['team_2_goals'] . '-' . $item['team_1_goals'] ) . '</div>
                        <div class="matches-list__match-item__team matches-list__match-item__team-2">
            ';
        if ( ! empty( $item['team_2_logo'] ) ) {
            $matches_list_html .= '<img src="' . esc_url( $item['team_2_logo']['url'] ) . '"
                                class="matches-list__match-item__logo" width="auto" height="auto"
                                alt="' . esc_html( $item['team_2_logo']['alt'] ) . '">';
        }
        $matches_list_html .= '
                            <div class="matches-list__match-item__team-name">' . esc_html( $item['team_2_name'] ) . '</div>
                            <div class="matches-list__match-item__score-mobile d-md-none">' . esc_html( $item['team_2_goals'] ) . '</div>
                        </div>
                    </div>
                    <div class="matches-list__match-item__ligue col-auto col-xl-3 order-3">
            ';
        if ( ! empty( $item['ligue_logo'] ) ) {
            $matches_list_html .= '<img src="' . esc_url( $item['ligue_logo']['url'] ) . '"
                            class="matches-list__match-item__ligue-logo" width="' . esc_url( $item['ligue_logo']['width'] ) . '" height="' . esc_url( $item['ligue_logo']['height'] ) . '"
                            alt="' . esc_html( $item['ligue_logo']['alt'] ) . '">';
        }
        $matches_list_html .= '
                    </div>
                </div>
            ';
    }
    $matches_list_html .= '</div></div>';
    echo do_shortcode( '[popup_box box_id="popup-matches-list"]' . $matches_list_html . '[/popup_box]' );

    if($matches_list_scoreboard){
        $matches_scoreboard_html = '<div class="container px-1"><div class="matches-list__match-item-wrapper px-2">';
        foreach ( $matches_list_scoreboard as $item ) {
            $matches_scoreboard_html .= '
                    <div class="matches-list__match-item row flex-nowrap align-items-center justify-content-between mb-3 py-2">
                        <div class="matches-list__match-item__place col-auto col-xl-3 order-2 order-md-1"><span>' . esc_html( $item['date'] ) . '</span><span>' . esc_html( $item['time'] ) . '</span><span>' . esc_html( $item['place'] ) . '</span></div>
                        <div class="matches-list__match-item__teams col-auto col-md col-xl-6 order-1 order-md-2">
                            <div class="matches-list__match-item__team matches-list__match-item__team-1">';
            if ( ! empty( $item['team_1_logo'] ) ) {
                $matches_scoreboard_html .= '<img src="' . esc_url( $item['team_1_logo']['url'] ) . '"
                                    class="matches-list__match-item__logo" width="auto" height="auto"
                                    alt="' . esc_html( $item['team_1_logo']['alt'] ) . '">';
            }
            $matches_scoreboard_html .= '
                                <div class="matches-list__match-item__name">' . esc_html( $item['team_1_name'] ) . '</div>
                            <div class="matches-list__match-item__score-mobile d-md-none">' . esc_html( $item['team_1_goals'] ) . '</div>
                            </div>
                            <div class="matches-list__match-item__score px-3 px-lg-4 d-none d-md-block">' . esc_html( $item['team_2_goals'] . '-' . $item['team_1_goals'] ) . '</div>
                            <div class="matches-list__match-item__team matches-list__match-item__team-2">
                ';
            if ( ! empty( $item['team_2_logo'] ) ) {
                $matches_scoreboard_html .= '<img src="' . esc_url( $item['team_2_logo']['url'] ) . '"
                                    class="matches-list__match-item__logo" width="auto" height="auto"
                                    alt="' . esc_html( $item['team_2_logo']['alt'] ) . '">';
            }
            $matches_scoreboard_html .= '
                                <div class="matches-list__match-item__team-name">' . esc_html( $item['team_2_name'] ) . '</div>
                                <div class="matches-list__match-item__score-mobile d-md-none">' . esc_html( $item['team_2_goals'] ) . '</div>
                            </div>
                        </div>
                        <div class="matches-list__match-item__ligue col-auto col-xl-3 order-3">
                ';
            if ( ! empty( $item['ligue_logo'] ) ) {
                $matches_scoreboard_html .= '<img src="' . esc_url( $item['ligue_logo']['url'] ) . '"
                                class="matches-list__match-item__ligue-logo" width="' . esc_url( $item['ligue_logo']['width'] ) . '" height="' . esc_url( $item['ligue_logo']['height'] ) . '"
                                alt="' . esc_html( $item['ligue_logo']['alt'] ) . '">';
            }
            $matches_scoreboard_html .= '
                        </div>
                    </div>
                ';
        }
        $matches_scoreboard_html .= '</div></div>';
        echo do_shortcode( '[popup_box box_id="popup-scoreboard"]' . $matches_scoreboard_html . '[/popup_box]' );
    }
    

    ?>
</section>
