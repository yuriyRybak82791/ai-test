import '../../scss/acf-blocks/block-image-gallery.scss';

import Swiper, { Autoplay, Pagination } from 'swiper';

const initImageGallerySlider = () => {
    const partnersLogoSliders = document.querySelectorAll('.js-image-gallery');
    if (partnersLogoSliders) {
        partnersLogoSliders.forEach((partnersLogoSlider) => {
            // eslint-disable-next-line no-new
            new Swiper(partnersLogoSlider, {
                slidesPerView: 1,
                loop: true,
                modules: [Autoplay, Pagination],
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 500,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    }
};

document.defaultView.addEventListener(
    'DOMContentLoaded',
    initImageGallerySlider,
    false
);

// Initialize dynamic block preview (editor).
if (window.acf) {
    window.acf.addAction('render_block_preview', initImageGallerySlider);
}
