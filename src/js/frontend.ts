/**
 * SASS
 */
import '../scss/frontend.scss';
/**
 * JavaScript
 */
// import Sliders from './components/swiper-init';
import Popup from './parts/popup-window';
import tabsNavigation from './parts/navi-tabs';
// Take some useful functions
import {
    fadeShopImages,
    isInViewport,
    scrollActions,
    initializePreviewVideo,
    appHeight,
    getTeamMemberInfo,
    initializeUserway,
} from './parts/helpers';

function ready() {
    const popupInstance = new Popup();
    popupInstance.init();

    /* Tab Navigation */
    tabsNavigation('.js-tab-name', '.js-tab');

    /**
     * Add global handler for click event
     * The main idea - to improve site performance
     * We added only 1 event handler to "click" event
     * and then use date-role attribute on each( needed ) elements
     * to define on which element event was executed..
     */
    document.body.addEventListener('click', (event) => {
        const EVENT: any = event;
        const ROLE: string = EVENT.target.dataset.role;
        const TARGET: any = event.target;

        if (!ROLE) return;

        switch (ROLE) {
            // show/hide menu
            case 'menu-action':
                {
                    event.preventDefault();
                    const MAIN_MENU = document.querySelector('.js-main-menu');
                    TARGET.classList.toggle('open');
                    document.body.classList.toggle('overflow');
                    MAIN_MENU && MAIN_MENU.classList.toggle('show');
                }
                break;
            // show/hide sub-menu
            case 'show-sub-menu':
                {
                    event.preventDefault();
                    const PARENT_ITEM = TARGET.parentElement;
                    const SUB_MENU = PARENT_ITEM.querySelector('.sub-menu');

                    const PARENT_MENU = TARGET.closest('.js-menu-wrapper');
                    const OPENED_MENU = PARENT_MENU.querySelectorAll('.menu-item.active');
                    if (SUB_MENU.style.maxHeight) {
                        SUB_MENU.style.maxHeight = null;
                        SUB_MENU.classList.remove('active');
                        PARENT_ITEM.classList.remove('active');
                    } else {
                        OPENED_MENU &&
                            OPENED_MENU.forEach((item) => {
                                const OPENED_SUB_MENU = item.querySelector('.sub-menu');
                                OPENED_SUB_MENU.style.maxHeight = null;
                                item.classList.remove('active');
                                OPENED_SUB_MENU.classList.remove('active');
                            });
                        SUB_MENU.style.maxHeight = `${SUB_MENU.scrollHeight}px`;
                        SUB_MENU.classList.add('active');
                        PARENT_ITEM.classList.add('active');
                    }
                }
                break;

            // Open select box.
            case 'open-select':
                {
                    event.preventDefault();
                    if (!TARGET.parentElement.classList.contains('active')) {
                        const variationItemActive = document.querySelectorAll('.select-box.active');
                        variationItemActive.forEach((item) => item.classList.remove('active'));
                        TARGET.parentElement.classList.add('active');
                    } else {
                        TARGET.parentElement.classList.remove('active');
                    }
                }
                break;

            // set select box value on click.
            case 'click-select':
                {
                    event.preventDefault();
                    const val = TARGET.dataset.value;
                    const name = TARGET.innerText;
                    const attributeID = TARGET.dataset.attribute;
                    const selectElement: HTMLInputElement | null = document.querySelector(`#${attributeID}`);
                    TARGET.parentElement.querySelectorAll('.select-box__variation.active').forEach((item) => {
                        item.classList.remove('active');
                    });
                    TARGET.classList.add('active');
                    if (selectElement) {
                        selectElement.value = val;
                        selectElement.dispatchEvent(new window.Event('change', { bubbles: true }));
                    }
                    const selectedBox = document.querySelector(`#select-box__selected-${attributeID}`);
                    if (selectedBox) {
                        selectedBox.innerHTML = name;
                    }
                    document.querySelectorAll('.select-box.active').forEach((item) => {
                        item.classList.remove('active');
                    });
                    const form: HTMLFormElement | null = document.querySelector('.js-blog-filters-form');
                    form && form.submit();
                }
                break;

            // Copy page link to clickboard.
            case 'copy-to-clickboard':
                {
                    navigator.clipboard.writeText(window.location.href);
                    const COPY_ALERT = TARGET.parentElement.querySelector('.copy-text');
                    COPY_ALERT && COPY_ALERT.classList.add('show');
                    setTimeout(() => {
                        COPY_ALERT && COPY_ALERT.classList.remove('show');
                    }, 3000);
                }
                break;

            // slide up/down.
            case 'slide-down-up':
                {
                    const element = TARGET.parentElement.querySelector('.js-slide-block');
                    // hide previously opened answer and show the clicked answer.
                    const currentOpened: HTMLElement | null = document.querySelector(
                        '.js-slide-block[aria-hidden="false"]'
                    );
                    if (currentOpened === element) {
                        // close the already open answer
                        element.setAttribute('aria-hidden', 'true');
                        element.parentNode.classList.remove('active');
                        TARGET.setAttribute('aria-expanded', 'false');
                    } else {
                        // hide previously open answer and show the clicked answer
                        if (currentOpened) {
                            currentOpened.setAttribute('aria-hidden', 'true');
                            const currentItemParent: Element | null = currentOpened.closest('.js-slide-item');
                            const currentItemSlide: Element | null = currentOpened.previousElementSibling;
                            currentItemParent && currentItemParent.classList.remove('active');
                            currentItemSlide && currentItemSlide.setAttribute('aria-expanded', 'false');
                        }
                        element.setAttribute('aria-hidden', 'false');
                        element.parentNode.classList.add('active');
                        TARGET.setAttribute('aria-expanded', 'true');
                    }
                }
                break;

            // show/hide info.
            case 'show-hide-info':
                {
                    TARGET.classList.toggle('active');
                    const info: HTMLElement | null = TARGET.parentElement.querySelector('.js-info-block');
                    info && info.classList.toggle('active');
                }
                break;

            // show team member popup
            case 'show-team-member-info':
                {
                    const POPUP_ID = TARGET.dataset.href;
                    const MEMBER_ID = TARGET.dataset.id;
                    getTeamMemberInfo(POPUP_ID, MEMBER_ID, popupInstance);
                }
                break;

            default:
        }
    });

    appHeight();
    initializePreviewVideo();
}

window.document.addEventListener('DOMContentLoaded', ready);

// Use it when you need to know that everything is loaded (html, styles, images)
window.addEventListener('load', () => {
    /**
     * Initialize fide effect for shop now section
     */
    const imageContainer: HTMLElement | null = document.querySelector('.js-shop-images');
    const imagesList: NodeListOf<HTMLElement> = document.querySelectorAll('.js-shop-image');
    // Call the fadeShopImages function every 3 seconds

    if (imagesList.length && imageContainer) {
        setInterval(() => {
            fadeShopImages(Array.from(imagesList));
        }, 3000);
    }

    /**
     * Initialize functions on scroll
     */
    scrollActions();
});

window.addEventListener('resize', appHeight);

/*
 *Load scripts on scroll
 */
 document.addEventListener('touchstart', () => {
    scrollActions();
 }, {passive: true});

//Load scripts on mousemove, click
document.addEventListener('mousemove', () =>{
    initializeUserway();
});
document.addEventListener('click', () =>{
    initializeUserway();
});
