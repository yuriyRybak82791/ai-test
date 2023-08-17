import '../../scss/acf-blocks/block-hero.scss';
import Swiper, {
    Navigation,
    Mousewheel,
    Thumbs,
    EffectFade,
    Lazy,
} from 'swiper';

const initHeroSlider = () => {
    const timelineSlider = new Swiper(
        document.querySelector('.js-hero-timeline-slider'),
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
                    slidesPerView: 5,
                },
            },
        }
    );

    const imagesSlider = new Swiper(
        document.querySelector('.js-hero-timeline-images'),
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

    document
        .querySelectorAll('.hero__timeline-slider__slide')
        .forEach(($slide) => {
            const index = Number($slide.dataset.index);
            const $year = $slide.querySelector('.js-slide-year');
            $year.addEventListener('mouseover', () => {
                imagesSlider.slideTo(index);
            });
        });

    const sectionHero = document.querySelector('section.hero');
    if (sectionHero) {
        sectionHero.addEventListener('mouseleave', () => {
            imagesSlider.slideTo(0);
        });
    }
};

document.defaultView.addEventListener(
    'DOMContentLoaded',
    initHeroSlider,
    false
);

// Initialize dynamic block preview (editor).
if (window.acf) {
    window.acf.addAction('render_block_preview', initHeroSlider);
}
