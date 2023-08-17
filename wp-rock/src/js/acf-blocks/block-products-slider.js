import '../../scss/acf-blocks/block-products-slider.scss';
import Swiper, { Navigation, Pagination } from 'swiper';

const initProductsSlider = () => {
    const productsSliders = document.querySelectorAll('.js-products-slider');
    if (productsSliders) {
        const setActiveSlide = (swiper) => {
            const { activeIndex, currentBreakpoint } = swiper;
            swiper.slides.forEach((slide) => {
                slide.classList.remove('active');
            });
            let index = 2;
            if (currentBreakpoint < 992 || currentBreakpoint === 'max') {
                index = 1;
            }
            swiper.slides[activeIndex + index].classList.add('active');
        };

        productsSliders.forEach((productsSlider) => {
            // eslint-disable-next-line no-new
            const slider = new Swiper(productsSlider, {
                slidesPerView: 3,
                loop: true,
                init: false,
                modules: [Navigation, Pagination],
                breakpoints: {
                    576: {
                        slidesPerView: 3,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    992: {
                        slidesPerView: 4,
                    },
                    1200: {
                        slidesPerView: 4,
                    },
                },
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

            slider.on('slideChange', (swiper) => {
                setActiveSlide(swiper);
            });
            slider.init();
        });
    }
};

document.defaultView.addEventListener(
    'DOMContentLoaded',
    initProductsSlider,
    false
);

// Initialize dynamic block preview (editor).
if (window.acf) {
    window.acf.addAction('render_block_preview', initProductsSlider);
}
