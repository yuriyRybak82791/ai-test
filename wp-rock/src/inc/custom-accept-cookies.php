<?php
/**
 * Custom accept cookie functionality
 *
 * @package WP-rock/custom-accept-cookie
 */

add_action(
    'wp_rock_after_site_page_tag',
    function () {

        global $global_options;
        $cookies_text = get_field_value( $global_options, 'cookies_text' );
        if ( ! empty( $cookies_text ) ) {
            ?>
        <div class="accept-cookie-box js-accept-cookie-box">
            <div class="container accept-cookie-box__container">
                <div class="accept-cookie-box__inner">
                    <div class="accept-cookie-box__text">
                        <?php echo $cookies_text; ?>
                    </div>
                    <div class="accept-cookie-box__buttons">
                        <button class="accept-cookie-box__close-btn js-close-accept-cookie-box-btn"
                                data-role="close-accept-cookie-box">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.99738 2.35687L17.3769 18.7378" stroke="#6D052A" stroke-width="2" stroke-linecap="square"/>
                                    <path d="M2.58594 19.0999L17.6206 2.35699" stroke="#6D052A" stroke-width="2" stroke-linecap="square"/>
                                </svg>
                        </button>
                        <button class="accept-cookie-box__reject-btn js-close-accept-cookie-box-btn"
                                data-role="close-accept-cookie-box">
                                <?php esc_html_e( 'Reject', 'wp-rock' ); ?>
                        </button>
                        <button class="accept-cookie-box__accept-btn"
                                data-role="accept-cookie">
                            <?php esc_html_e( 'Accept', 'wp-rock' ); ?>
                        </button>                        
                    </div>
                    
                </div>
            </div>
        </div>

        <script>

            window.addEventListener("load", (event) => {
                const ACCEPT_COOKIE_BOX = document.querySelector('.js-accept-cookie-box');
                const ACCEPT_COOKIE_CHECK = localStorage.getItem('accept-cookie');
                console.log('ACCEPT_COOKIE_BOX', ACCEPT_COOKIE_BOX);
                console.log('ACCEPT_COOKIE_CHECK', ACCEPT_COOKIE_CHECK);

                if (!ACCEPT_COOKIE_CHECK || +ACCEPT_COOKIE_CHECK !== 1) {
                    (ACCEPT_COOKIE_BOX) && ACCEPT_COOKIE_BOX.classList.add('opened');
                    document.body.classList.add('accept-cookie-box-is-opened');
                }

                document.body.addEventListener('click', function (event) {
                    const ROLE = event.target.dataset.role;
                    if (!ROLE) return;

                    switch (ROLE) {
                        case 'accept-cookie':
                            localStorage.setItem('accept-cookie', 1);
                            (ACCEPT_COOKIE_BOX) && ACCEPT_COOKIE_BOX.classList.remove('opened');
                            document.body.classList.remove('accept-cookie-box-is-opened');
                            break;
                        case 'close-accept-cookie-box':
                            (ACCEPT_COOKIE_BOX) && ACCEPT_COOKIE_BOX.classList.remove('opened');
                            document.body.classList.remove('accept-cookie-box-is-opened');
                            break;
                    }
                });
            });

        </script>
            <?php
        }
    }
);
?>
