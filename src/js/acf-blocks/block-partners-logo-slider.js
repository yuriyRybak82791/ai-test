import '../../scss/acf-blocks/block-partners-logo-slider.scss';
import Swiper, { Autoplay } from 'swiper';

const initParntersLogoSlider = () => {
    const partnersLogoSliders = document.querySelectorAll(
        '.js-partners-logo-slider'
    );
    if (partnersLogoSliders) {
        partnersLogoSliders.forEach((partnersLogoSlider) => {
            // eslint-disable-next-line no-new
            new Swiper(partnersLogoSlider, {
                slidesPerView: 'auto',
                loop: true,
                modules: [Autoplay],
                autoplay: {
                    delay: 1,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: false,
                    reverseDirection: true,
                },
                breakpoints: {
                    0: {
                        spaceBetween: 8,
                    },
                    1200: {
                        spaceBetween: 40,
                    },
                },
                allowTouchMove: false,
                simulateTouch: false,
                speed: 5000,
            });
        });
    }
};

document.defaultView.addEventListener(
    'DOMContentLoaded',
    initParntersLogoSlider,
    false
);

// Initialize dynamic block preview (editor).
if (window.acf) {
    window.acf.addAction('render_block_preview', initParntersLogoSlider);
}
