import '../../scss/acf-blocks/block-timeline-slider.scss';
import Swiper, {
    Navigation,
    Mousewheel,
    Thumbs,
    EffectFade,
    Lazy,
} from 'swiper';

const initTimelineSlider = () => {
    const timelineSlider = new Swiper(
        document.querySelector('.js-timeline-slider-timeline-slider'),
        {
            slidesPerView: 2.5,
            modules: [Mousewheel],
            mousewheel: {
                enabled: true,
                sensitivity: 4,
                forceToAxis: true,
            },
            breakpoints: {
                576: {
                    slidesPerView: 3.5,
                },
                768: {
                    slidesPerView: 4.5,
                },
                1200: {
                    slidesPerView: 7,
                },
            },
        }
    );

    const imagesSlider = new Swiper(
        document.querySelector('.js-timeline-slider-timeline-images'),
        {
            modules: [Navigation, Thumbs, EffectFade, Lazy],
            preloadImages: false,
            lazy: true,
            effect: 'fade',
            navigation: {
                prevEl: '.button-prev',
                nextEl: '.button-next',
            },
            fadeEffect: {
                crossFade: true,
            },
            thumbs: {
                swiper: timelineSlider,
            },
        }
    );

    timelineSlider.on('slideChange', (swiper) => {
        imagesSlider.slideTo(swiper.activeIndex);
    });
};

document.defaultView.addEventListener(
    'DOMContentLoaded',
    initTimelineSlider,
    false
);

// Initialize dynamic block preview (editor).
if (window.acf) {
    window.acf.addAction('render_block_preview', initTimelineSlider);
}
