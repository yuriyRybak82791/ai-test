import smoothscroll from 'smoothscroll-polyfill';

// kick off the polyfill!
smoothscroll.polyfill();

/**
 * Fade Out method
 *
 * @param {string} el
 */
export function fadeOut(el) {
    if (!el) {
        throw Error('"fadeOut function - "You didn\'t add required parameters');
    }

    const domElement =
        el instanceof HTMLElement ? el : document.querySelector(el);

    if (!domElement) {
        throw Error("domElement doesn't exist");
    }

    domElement.style.opacity = 1;

    (function fade() {
        if ((domElement.style.opacity -= 0.1) <= 0) {
            domElement.style.display = 'none';
        } else {
            requestAnimationFrame(fade);
        }
    })();
}

/**
 * Fade In method
 *
 * @param {string} el      - element that need to fade in
 *
 * @param {string} display - display variant
 */
export function fadeIn(el, display = 'block') {
    if (!el) {
        throw Error('"fadeIn function - "You didn\'t add required parameters');
    }

    const domElement =
        el instanceof HTMLElement ? el : document.querySelector(el);

    if (!domElement) {
        throw Error("domElement doesn't exist");
    }

    domElement.style.opacity = 0;
    domElement.style.display = display || 'block';

    (function fade() {
        let val = parseFloat(domElement.style.opacity);
        if (!((val += 0.1) > 1)) {
            domElement.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
}

/**
 *  Set equal height to selected elements calculated as bigger height
 *
 * @param {Array | string} elementsSelector  - selector for searching elements
 * @param {string} minOrMax          - Define what dimension should be calculated (minHeight or maxHeight)
 * @return {Array | string} elementsSelector
 */
export function equalHeights(elementsSelector, minOrMax = 'max') {
    if (!elementsSelector) {
        throw Error(
            '"equalHeights function - "You didn\'t add required parameters'
        );
    }

    const heights = [];
    const elementsSelectorArr = Array.isArray(elementsSelector)
        ? elementsSelector
        : [...document.querySelectorAll(elementsSelector)];

    elementsSelectorArr.forEach((item) => {
        // eslint-disable-next-line no-param-reassign
        item.style.height = 'auto';
    });

    elementsSelectorArr.forEach((item) => {
        heights.push(item.offsetHeight);
    });

    const commonHeight =
        minOrMax === 'max'
            ? Math.max.apply(0, heights)
            : Math.min.apply(0, heights);

    elementsSelectorArr.forEach((item) => {
        // eslint-disable-next-line no-param-reassign
        item.style.height = `${commonHeight}px`;
    });

    return elementsSelector;
}

/**
 * Trim all paragraph from unneeded space symbol
 */
export function trimParagraph() {
    [...document.querySelectorAll('p')].forEach((item) => {
        // eslint-disable-next-line no-param-reassign
        item.innerHTML = item.innerHTML.trim();
    });
}

/**
 * Check if element in viewport
 *
 * @param {HTMLElement | null} el
 * @param {number} offset - Adjustable offset value when element becomes visible
 * @return {boolean} Result of checking
 */
export function isInViewport(el, offset = 100) {
    if (!el) {
        throw Error(
            '"isInViewport function - "You didn\'t add required parameters'
        );
    }

    const scroll = window.scrollY || window.pageYOffset;
    const boundsTop = el.getBoundingClientRect().top + offset + scroll;

    const viewport = {
        top: scroll,
        bottom: scroll + window.innerHeight,
    };

    const bounds = {
        top: boundsTop,
        bottom: boundsTop + el.clientHeight,
    };

    return (
        (bounds.bottom >= viewport.top && bounds.bottom <= viewport.bottom) ||
        (bounds.top <= viewport.bottom && bounds.top >= viewport.top)
    );
}

/**
 * Debounce function
 *
 * @param {Function | null} fn  - function that should be executed
 * @param {number} delay        - time delay
 * @return {Function}           - function to execute
 */
export const debounce = (fn, delay = 1000) => {
    if (!fn) {
        throw Error(
            '"debounce function - "You didn\'t add required parameters'
        );
    }

    let timeout;

    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn.apply(this, args), delay);
    };
};

/**
 *
 * @param {Function | null} func  - function that should be executed
 * @param {number} ms             - time delay
 * @return {Function} wrapper     - function to execute
 */
export const throttle = (func, ms) => {
    let isThrottled = false;
    let savedArgs;
    let savedThis;

    function wrapper() {
        if (isThrottled) {
            // (2)
            // eslint-disable-next-line prefer-rest-params
            savedArgs = arguments;
            // eslint-disable-next-line @typescript-eslint/no-this-alias
            savedThis = this;
            return;
        }

        // eslint-disable-next-line prefer-rest-params
        func && func.apply(this, arguments); // (1)

        isThrottled = true;

        setTimeout(() => {
            isThrottled = false; // (3)
            if (savedArgs) {
                wrapper.apply(savedThis, savedArgs);
                // eslint-disable-next-line no-multi-assign
                savedArgs = savedThis = null;
            }
        }, ms);
    }

    return wrapper;
};

/**
 * Copy to clipboard
 *
 * @param {HTMLElement | null} parent
 * @param {HTMLElement | null} element -  element that  contain value to copy
 */
export const copyToClipboard = (parent, element) => {
    if (!parent || !element) {
        throw Error(
            '"copyToClipboard function - "You didn\'t add required parameters'
        );
    }

    const el = document.createElement('textarea');
    el.value = element.value;
    document.body.appendChild(el);
    el.select();

    try {
        const successful = document.execCommand('copy');

        if (successful) {
            parent.classList.add('copied');

            setTimeout(() => {
                parent.classList.remove('copied');
            }, 3000);
        }
    } catch (err) {
        // eslint-disable-next-line no-console
        console.log('Oops, unable to copy');
    }

    document.body.removeChild(el);
};

/**
 * Test value with regex
 *
 * @param {string} fieldType  - The allowed type of the fields
 * @param {string} value
 * @return {boolean} Result of checking
 */
export const validateField = (fieldType = null, value = null) => {
    if (!fieldType || !value) {
        throw Error(
            '"validateField function - "You didn\'t add required parameters'
        );
    }

    const phoneREGEX = /^[0-9+]{6,13}$/;
    const nameREGEX = /^[a-zA-Z]{2,30}$/;
    const postalREGEX = /^[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}$/i;
    const emailREGEX = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    const dummyREGEX = /^[a-zA-Z0-9]{2,30}$/;

    let checkResult = false;

    switch (fieldType) {
        case 'name':
        case 'first_name':
        case 'last_name':
            checkResult = nameREGEX.test(value);
            break;
        case 'phone':
            checkResult = phoneREGEX.test(value);
            break;
        case 'postal':
            checkResult = postalREGEX.test(value);
            break;
        case 'email':
            checkResult = emailREGEX.test(value);
            break;
        case 'price':
            checkResult = dummyREGEX.test(value);
            break;
        case 'aim':
            checkResult = dummyREGEX.test(value);
            break;
        case 'date':
            checkResult = dummyREGEX.test(value);
            break;
        case 'subject':
        case 'company':
            checkResult = dummyREGEX.test(value);
            break;
        default:
            break;
    }

    return checkResult;
};

/**
 * Polyfill for closest method
 */
export function closestPolyfill() {
    if (window.Element && !Element.prototype.closest) {
        Element.prototype.closest = (s) => {
            const matches = (
                this.document || this.ownerDocument
            ).querySelectorAll(s);
            let i;
            // eslint-disable-next-line @typescript-eslint/no-this-alias
            let el = this;
            do {
                i = matches.length;
                // eslint-disable-next-line no-empty
                while (--i >= 0 && matches.item(i) !== el) {}
            } while (i < 0 && (el = el.parentElement));
            return el;
        };
    }
}

/**
 * Smooth scroll to element on page
 *
 * @param {string|null} elementsSelector string -- css selector (anchor links)
 * @param {Function|null} callback function     -- callback for some additional actions
 */
export function anchorLinkScroll(elementsSelector = null, callback = null) {
    if (!elementsSelector) {
        throw Error(
            '"anchorLinkScroll function - "You didn\'t add correct selector for anchor links'
        );
    }

    const elements = document.querySelectorAll(elementsSelector);

    elements &&
        [...elements].forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();

                const elHref =
                    event.target.nodeName === 'A'
                        ? event.target.getAttribute('href')
                        : event.target.dataset.href;

                const ANCHOR_ELEMENT = document.querySelector(elHref);

                ANCHOR_ELEMENT &&
                    window.scroll({
                        behavior: 'smooth',
                        left: 0,
                        top: ANCHOR_ELEMENT.offsetTop,
                    });

                if (callback) callback();
            });
        });
}

/**
 * do actions with elements on scroll
 */
export const scrollActions = () => {
    /**
     * sticky header
     */
    const HEADER = document.querySelector('.js-site-header');
    const action = window.scrollY > 0 ? 'add' : 'remove';
    document.body.classList[action]('scroll');
    HEADER && HEADER.classList[action]('sticky');
};

/**
 *  Image fade effect for shop now block
 *
 * @param {Array} images  - array of fade elements
 */
let currentIndex = 0;
export const fadeShopImages = (images) => {
    const currentImage = images[currentIndex];
    const nextIndex = (currentIndex + 1) % images.length;
    const nextImage = images[nextIndex];

    fadeOut(currentImage);
    fadeIn(nextImage);

    currentIndex = nextIndex;
};

export const appHeight = () => {
    const doc = document.documentElement;
    doc.style.setProperty('--app-height', `${window.innerHeight}px`);
};

/**
 * setCookie
 *
 * @param {string} key - cookie name
 * @param {string} value - cookie value
 * @param {number} expiry - days
 */
export function setCookie(key, value, expiry) {
    const expires = new Date();
    expires.setTime(expires.getTime() + expiry * 24 * 60 * 60 * 1000);
    document.cookie = `${key}=${value};expires=${expires.toUTCString()}; path=/`;
}

/**
 * getCookie
 *
 * @param {string} key - cookie name
 */
export function getCookie(key) {
    const keyValue = document.cookie.match(`(^|;) ?${key}=([^;]*)(;|$)`);
    return keyValue ? keyValue[2] : null;
}

/**
 * eraseCookie
 *
 * @param {string} key - cookie name
 */
export function eraseCookie(key) {
    const keyValue = getCookie(key);
    setCookie(key, keyValue, '-1');
}

/**
 * Function to check if the video has been viewed today or exists
 *
 * @return {boolean} Result of checking
 */
const hasVideoBeenViewedToday = () => {
    const videoContainer = document.querySelector(
        '.js-video-preview-container'
    );
    if (!videoContainer) return true;
    const videoViewed = getCookie('videoViewed');
    return !!videoViewed;
};

/**
 * Function to show/hide the video container
 *
 * @param {boolean} show  - value show or hide preview video
 */
const toggleVideoContainer = (show) => {
    const videoPlayer = document.querySelector('.js-video-preview');
    const videoContainer = document.querySelector(
        '.js-video-preview-container'
    );
    if (show) {
        videoContainer.style.display = 'block';
    } else {
        videoPlayer && videoPlayer.pause();
        videoContainer && fadeOut(videoContainer);
    }
};

/**
 * Function to set the viewed date cookies
 */
const setVideoViewedToday = () => {
    setCookie('videoViewed', true, 1);
};

/**
 * Function to skip the video
 */
const skipVideo = () => {
    toggleVideoContainer(false);
    setVideoViewedToday();
};

/**
 * Function to play or pause the video
 */
const togglePlayPause = () => {
    const videoPlayer = document.querySelector('.js-video-preview');
    const playPauseButton = document.querySelector('.js-play-stop-preview');

    if (videoPlayer.paused) {
        videoPlayer.play();
        playPauseButton.classList.remove('active');
    } else {
        videoPlayer.pause();
        playPauseButton.classList.add('active');
    }
};

/**
 * Function to mute or unmute the video
 */
const toggleMuteUnmute = () => {
    const videoPlayer = document.querySelector('.js-video-preview');
    const muteUnmuteButton = document.querySelector('.js-mute-unmute-preview');

    if (videoPlayer.muted) {
        videoPlayer.muted = false;
        muteUnmuteButton.classList.add('active');
    } else {
        videoPlayer.muted = true;
        muteUnmuteButton.classList.remove('active');
    }
};

/**
 *  Show preview video for HP
 */
export const initializePreviewVideo = () => {
    // Check if the video has been viewed today and if it exists.
    if (!hasVideoBeenViewedToday()) {
        toggleVideoContainer(true);

        // Add event listener to hide the video container once playback ends.
        const videoPlayer = document.querySelector('.js-video-preview');
        videoPlayer &&
            videoPlayer.addEventListener('ended', () => {
                toggleVideoContainer(false);
                setVideoViewedToday();
            });

        // Add event listener to the mute/unmute button.
        const muteUnmuteButton = document.querySelector(
            '.js-mute-unmute-preview'
        );
        muteUnmuteButton &&
            muteUnmuteButton.addEventListener('click', toggleMuteUnmute);

        // Add event listener to the play/pause button.
        const playPauseButton = document.querySelector('.js-play-stop-preview');
        playPauseButton &&
            playPauseButton.addEventListener('click', togglePlayPause);

        // Add event listener to the skip button.
        const skipButton = document.querySelector('.js-skip-preview');
        skipButton && skipButton.addEventListener('click', skipVideo);
    }
};

/**
 * return team member info in popup
 *
 * @param {string} POPUP_ID - popup id
 * @param {number} MEMBER_ID - team member id
 * @param {Object} popupInstance - popup object
 */
export const getTeamMemberInfo = async (POPUP_ID, MEMBER_ID, popupInstance) => {
    if (!MEMBER_ID || !POPUP_ID || !popupInstance) return;

    const POPUP_ELEMENT = document.querySelector(POPUP_ID);
    const LOADER = document.querySelector('.js-team-loader');

    LOADER && LOADER.classList.add('show');

    const POPUP_INNER = POPUP_ELEMENT.querySelector('.js-popup-inner');
    const formData = new FormData();

    formData.append('action', 'get_team_member_info');
    formData.append('memberID', MEMBER_ID);
    formData.append('nonce', var_from_php.nonce);

    try {
        const response = await fetch(var_from_php.ajax_url, {
            method: 'POST',
            body: formData,
        });

        const responseData = await response.json();

        if (responseData.success) {
            POPUP_INNER.innerHTML = responseData.data;
            popupInstance.openOnePopup(POPUP_ID, 0);
            LOADER && LOADER.classList.remove('show');
        }
    } catch (error) {
        // Handle any errors that might occur during the fetch
        console.error('An error occurred:', error);
    }
};

/** 
 * add Accessibility
 */
let userwayInitialized = false;
export const initializeUserway = () => {
	if(userwayInitialized){return;}
	let s = document.createElement("script");
	s.setAttribute("data-account", "fCt6JCQ7aV");
	s.defer = true;
	s.setAttribute("src", "https://cdn.userway.org/widget.js");
	(document.body || document.head).appendChild(s);
	userwayInitialized = true;
};
