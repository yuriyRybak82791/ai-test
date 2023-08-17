import '../../scss/acf-blocks/block-history-and-achievements.scss';
import Swiper, {
    Navigation,
    Mousewheel,
    Thumbs,
    EffectFade,
    Lazy,
} from 'swiper';

const initHistoryAndAchievementsSliders = () => {
    const jsTabs = document.querySelectorAll('.js-tab');
    if (jsTabs) {
        jsTabs.forEach(($tab) => {
            const timelineSlider = new Swiper(
                $tab.querySelector('.js-ha-timeline-slider'),
                {
                    slidesPerView: 2.5,
                    modules: [Navigation, Mousewheel],
                    freeMode: true,
                    watchSlidesVisibility: true,
                    watchSlidesProgress: true,
                    navigation: {
                        prevEl: '.button-prev',
                        nextEl: '.button-next',
                    },
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
                $tab.querySelector('.js-ha-images-slider'),
                {
                    modules: [Thumbs, EffectFade, Lazy],
                    freeMode: true,
                    watchSlidesProgress: true,
                    preloadImages: false,
                    lazy: true,
                    // effect: 'fade',
                    // fadeEffect: {
                    //     crossFade: true,
                    // },
                    thumbs: {
                        swiper: timelineSlider,
                    },
                    on: {
                        slideChange() {
                            const swiper = this;
                            const indexCurrentSlide = swiper.activeIndex;
                            const tabIndex =
                                swiper.slides[indexCurrentSlide].dataset.tab;
                            const activeContent = document.querySelector(
                                `#tab-${tabIndex} .js-content.active`
                            );
                            const setActiveContent = document.querySelector(
                                `.js-content-${tabIndex}${indexCurrentSlide}`
                            );
                            activeContent &&
                                activeContent.classList.remove('active');
                            setActiveContent &&
                                setActiveContent.classList.add('active');
                        },
                    },
                }
            );

            // timelineSlider.controller.control = imagesSlider;
            // imagesSlider.controller.control = timelineSlider;
        });
    }
};

document.defaultView.addEventListener(
    'DOMContentLoaded',
    initHistoryAndAchievementsSliders,
    false
);

// Initialize dynamic block preview (editor).
if (window.acf) {
    window.acf.addAction(
        'render_block_preview',
        initHistoryAndAchievementsSliders
    );
}
