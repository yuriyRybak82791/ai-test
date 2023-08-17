import '../../scss/acf-blocks/block-partners-slider.scss';
import Swiper, { Navigation, Pagination } from 'swiper';

const initParntersSlider = () => {
    const partnersSliders = document.querySelectorAll('.js-partners-slider');
    if (partnersSliders) {
        partnersSliders.forEach((partnersSlider) => {
            // eslint-disable-next-line no-new
            new Swiper(partnersSlider, {
                slidesPerView: 1,
                modules: [Navigation, Pagination],
                mousewheel: {
                    enabled: true,
                    sensitivity: 4,
                    forceToAxis: true,
                },
                navigation: {
                    prevEl: '.swiper-button-prev',
                    nextEl: '.swiper-button-next',
                },
                pagination: {
                    el: '.swiper-pagination',
                },
            });
        });
    }
};

document.defaultView.addEventListener(
    'DOMContentLoaded',
    initParntersSlider,
    false
);

// Initialize dynamic block preview (editor).
if (window.acf) {
    window.acf.addAction('render_block_preview', initParntersSlider);
}
