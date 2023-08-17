/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/scss/frontend.scss":
/*!********************************!*\
  !*** ./src/scss/frontend.scss ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/smoothscroll-polyfill/dist/smoothscroll.js":
/*!*****************************************************************!*\
  !*** ./node_modules/smoothscroll-polyfill/dist/smoothscroll.js ***!
  \*****************************************************************/
/***/ (function(module) {

/* smoothscroll v0.4.4 - 2019 - Dustan Kasten, Jeremias Menichelli - MIT License */
(function () {
  'use strict';

  // polyfill
  function polyfill() {
    // aliases
    var w = window;
    var d = document;

    // return if scroll behavior is supported and polyfill is not forced
    if (
      'scrollBehavior' in d.documentElement.style &&
      w.__forceSmoothScrollPolyfill__ !== true
    ) {
      return;
    }

    // globals
    var Element = w.HTMLElement || w.Element;
    var SCROLL_TIME = 468;

    // object gathering original scroll methods
    var original = {
      scroll: w.scroll || w.scrollTo,
      scrollBy: w.scrollBy,
      elementScroll: Element.prototype.scroll || scrollElement,
      scrollIntoView: Element.prototype.scrollIntoView
    };

    // define timing method
    var now =
      w.performance && w.performance.now
        ? w.performance.now.bind(w.performance)
        : Date.now;

    /**
     * indicates if a the current browser is made by Microsoft
     * @method isMicrosoftBrowser
     * @param {String} userAgent
     * @returns {Boolean}
     */
    function isMicrosoftBrowser(userAgent) {
      var userAgentPatterns = ['MSIE ', 'Trident/', 'Edge/'];

      return new RegExp(userAgentPatterns.join('|')).test(userAgent);
    }

    /*
     * IE has rounding bug rounding down clientHeight and clientWidth and
     * rounding up scrollHeight and scrollWidth causing false positives
     * on hasScrollableSpace
     */
    var ROUNDING_TOLERANCE = isMicrosoftBrowser(w.navigator.userAgent) ? 1 : 0;

    /**
     * changes scroll position inside an element
     * @method scrollElement
     * @param {Number} x
     * @param {Number} y
     * @returns {undefined}
     */
    function scrollElement(x, y) {
      this.scrollLeft = x;
      this.scrollTop = y;
    }

    /**
     * returns result of applying ease math function to a number
     * @method ease
     * @param {Number} k
     * @returns {Number}
     */
    function ease(k) {
      return 0.5 * (1 - Math.cos(Math.PI * k));
    }

    /**
     * indicates if a smooth behavior should be applied
     * @method shouldBailOut
     * @param {Number|Object} firstArg
     * @returns {Boolean}
     */
    function shouldBailOut(firstArg) {
      if (
        firstArg === null ||
        typeof firstArg !== 'object' ||
        firstArg.behavior === undefined ||
        firstArg.behavior === 'auto' ||
        firstArg.behavior === 'instant'
      ) {
        // first argument is not an object/null
        // or behavior is auto, instant or undefined
        return true;
      }

      if (typeof firstArg === 'object' && firstArg.behavior === 'smooth') {
        // first argument is an object and behavior is smooth
        return false;
      }

      // throw error when behavior is not supported
      throw new TypeError(
        'behavior member of ScrollOptions ' +
          firstArg.behavior +
          ' is not a valid value for enumeration ScrollBehavior.'
      );
    }

    /**
     * indicates if an element has scrollable space in the provided axis
     * @method hasScrollableSpace
     * @param {Node} el
     * @param {String} axis
     * @returns {Boolean}
     */
    function hasScrollableSpace(el, axis) {
      if (axis === 'Y') {
        return el.clientHeight + ROUNDING_TOLERANCE < el.scrollHeight;
      }

      if (axis === 'X') {
        return el.clientWidth + ROUNDING_TOLERANCE < el.scrollWidth;
      }
    }

    /**
     * indicates if an element has a scrollable overflow property in the axis
     * @method canOverflow
     * @param {Node} el
     * @param {String} axis
     * @returns {Boolean}
     */
    function canOverflow(el, axis) {
      var overflowValue = w.getComputedStyle(el, null)['overflow' + axis];

      return overflowValue === 'auto' || overflowValue === 'scroll';
    }

    /**
     * indicates if an element can be scrolled in either axis
     * @method isScrollable
     * @param {Node} el
     * @param {String} axis
     * @returns {Boolean}
     */
    function isScrollable(el) {
      var isScrollableY = hasScrollableSpace(el, 'Y') && canOverflow(el, 'Y');
      var isScrollableX = hasScrollableSpace(el, 'X') && canOverflow(el, 'X');

      return isScrollableY || isScrollableX;
    }

    /**
     * finds scrollable parent of an element
     * @method findScrollableParent
     * @param {Node} el
     * @returns {Node} el
     */
    function findScrollableParent(el) {
      while (el !== d.body && isScrollable(el) === false) {
        el = el.parentNode || el.host;
      }

      return el;
    }

    /**
     * self invoked function that, given a context, steps through scrolling
     * @method step
     * @param {Object} context
     * @returns {undefined}
     */
    function step(context) {
      var time = now();
      var value;
      var currentX;
      var currentY;
      var elapsed = (time - context.startTime) / SCROLL_TIME;

      // avoid elapsed times higher than one
      elapsed = elapsed > 1 ? 1 : elapsed;

      // apply easing to elapsed time
      value = ease(elapsed);

      currentX = context.startX + (context.x - context.startX) * value;
      currentY = context.startY + (context.y - context.startY) * value;

      context.method.call(context.scrollable, currentX, currentY);

      // scroll more if we have not reached our destination
      if (currentX !== context.x || currentY !== context.y) {
        w.requestAnimationFrame(step.bind(w, context));
      }
    }

    /**
     * scrolls window or element with a smooth behavior
     * @method smoothScroll
     * @param {Object|Node} el
     * @param {Number} x
     * @param {Number} y
     * @returns {undefined}
     */
    function smoothScroll(el, x, y) {
      var scrollable;
      var startX;
      var startY;
      var method;
      var startTime = now();

      // define scroll context
      if (el === d.body) {
        scrollable = w;
        startX = w.scrollX || w.pageXOffset;
        startY = w.scrollY || w.pageYOffset;
        method = original.scroll;
      } else {
        scrollable = el;
        startX = el.scrollLeft;
        startY = el.scrollTop;
        method = scrollElement;
      }

      // scroll looping over a frame
      step({
        scrollable: scrollable,
        method: method,
        startTime: startTime,
        startX: startX,
        startY: startY,
        x: x,
        y: y
      });
    }

    // ORIGINAL METHODS OVERRIDES
    // w.scroll and w.scrollTo
    w.scroll = w.scrollTo = function() {
      // avoid action when no arguments are passed
      if (arguments[0] === undefined) {
        return;
      }

      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0]) === true) {
        original.scroll.call(
          w,
          arguments[0].left !== undefined
            ? arguments[0].left
            : typeof arguments[0] !== 'object'
              ? arguments[0]
              : w.scrollX || w.pageXOffset,
          // use top prop, second argument if present or fallback to scrollY
          arguments[0].top !== undefined
            ? arguments[0].top
            : arguments[1] !== undefined
              ? arguments[1]
              : w.scrollY || w.pageYOffset
        );

        return;
      }

      // LET THE SMOOTHNESS BEGIN!
      smoothScroll.call(
        w,
        d.body,
        arguments[0].left !== undefined
          ? ~~arguments[0].left
          : w.scrollX || w.pageXOffset,
        arguments[0].top !== undefined
          ? ~~arguments[0].top
          : w.scrollY || w.pageYOffset
      );
    };

    // w.scrollBy
    w.scrollBy = function() {
      // avoid action when no arguments are passed
      if (arguments[0] === undefined) {
        return;
      }

      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0])) {
        original.scrollBy.call(
          w,
          arguments[0].left !== undefined
            ? arguments[0].left
            : typeof arguments[0] !== 'object' ? arguments[0] : 0,
          arguments[0].top !== undefined
            ? arguments[0].top
            : arguments[1] !== undefined ? arguments[1] : 0
        );

        return;
      }

      // LET THE SMOOTHNESS BEGIN!
      smoothScroll.call(
        w,
        d.body,
        ~~arguments[0].left + (w.scrollX || w.pageXOffset),
        ~~arguments[0].top + (w.scrollY || w.pageYOffset)
      );
    };

    // Element.prototype.scroll and Element.prototype.scrollTo
    Element.prototype.scroll = Element.prototype.scrollTo = function() {
      // avoid action when no arguments are passed
      if (arguments[0] === undefined) {
        return;
      }

      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0]) === true) {
        // if one number is passed, throw error to match Firefox implementation
        if (typeof arguments[0] === 'number' && arguments[1] === undefined) {
          throw new SyntaxError('Value could not be converted');
        }

        original.elementScroll.call(
          this,
          // use left prop, first number argument or fallback to scrollLeft
          arguments[0].left !== undefined
            ? ~~arguments[0].left
            : typeof arguments[0] !== 'object' ? ~~arguments[0] : this.scrollLeft,
          // use top prop, second argument or fallback to scrollTop
          arguments[0].top !== undefined
            ? ~~arguments[0].top
            : arguments[1] !== undefined ? ~~arguments[1] : this.scrollTop
        );

        return;
      }

      var left = arguments[0].left;
      var top = arguments[0].top;

      // LET THE SMOOTHNESS BEGIN!
      smoothScroll.call(
        this,
        this,
        typeof left === 'undefined' ? this.scrollLeft : ~~left,
        typeof top === 'undefined' ? this.scrollTop : ~~top
      );
    };

    // Element.prototype.scrollBy
    Element.prototype.scrollBy = function() {
      // avoid action when no arguments are passed
      if (arguments[0] === undefined) {
        return;
      }

      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0]) === true) {
        original.elementScroll.call(
          this,
          arguments[0].left !== undefined
            ? ~~arguments[0].left + this.scrollLeft
            : ~~arguments[0] + this.scrollLeft,
          arguments[0].top !== undefined
            ? ~~arguments[0].top + this.scrollTop
            : ~~arguments[1] + this.scrollTop
        );

        return;
      }

      this.scroll({
        left: ~~arguments[0].left + this.scrollLeft,
        top: ~~arguments[0].top + this.scrollTop,
        behavior: arguments[0].behavior
      });
    };

    // Element.prototype.scrollIntoView
    Element.prototype.scrollIntoView = function() {
      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0]) === true) {
        original.scrollIntoView.call(
          this,
          arguments[0] === undefined ? true : arguments[0]
        );

        return;
      }

      // LET THE SMOOTHNESS BEGIN!
      var scrollableParent = findScrollableParent(this);
      var parentRects = scrollableParent.getBoundingClientRect();
      var clientRects = this.getBoundingClientRect();

      if (scrollableParent !== d.body) {
        // reveal element inside parent
        smoothScroll.call(
          this,
          scrollableParent,
          scrollableParent.scrollLeft + clientRects.left - parentRects.left,
          scrollableParent.scrollTop + clientRects.top - parentRects.top
        );

        // reveal parent in viewport unless is fixed
        if (w.getComputedStyle(scrollableParent).position !== 'fixed') {
          w.scrollBy({
            left: parentRects.left,
            top: parentRects.top,
            behavior: 'smooth'
          });
        }
      } else {
        // reveal element in viewport
        w.scrollBy({
          left: clientRects.left,
          top: clientRects.top,
          behavior: 'smooth'
        });
      }
    };
  }

  if (true) {
    // commonjs
    module.exports = { polyfill: polyfill };
  } else {}

}());


/***/ }),

/***/ "./src/js/parts/helpers.js":
/*!*********************************!*\
  !*** ./src/js/parts/helpers.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   anchorLinkScroll: function() { return /* binding */ anchorLinkScroll; },
/* harmony export */   appHeight: function() { return /* binding */ appHeight; },
/* harmony export */   closestPolyfill: function() { return /* binding */ closestPolyfill; },
/* harmony export */   copyToClipboard: function() { return /* binding */ copyToClipboard; },
/* harmony export */   debounce: function() { return /* binding */ debounce; },
/* harmony export */   equalHeights: function() { return /* binding */ equalHeights; },
/* harmony export */   eraseCookie: function() { return /* binding */ eraseCookie; },
/* harmony export */   fadeIn: function() { return /* binding */ fadeIn; },
/* harmony export */   fadeOut: function() { return /* binding */ fadeOut; },
/* harmony export */   fadeShopImages: function() { return /* binding */ fadeShopImages; },
/* harmony export */   getCookie: function() { return /* binding */ getCookie; },
/* harmony export */   getTeamMemberInfo: function() { return /* binding */ getTeamMemberInfo; },
/* harmony export */   initializePreviewVideo: function() { return /* binding */ initializePreviewVideo; },
/* harmony export */   initializeUserway: function() { return /* binding */ initializeUserway; },
/* harmony export */   isInViewport: function() { return /* binding */ isInViewport; },
/* harmony export */   scrollActions: function() { return /* binding */ scrollActions; },
/* harmony export */   setCookie: function() { return /* binding */ setCookie; },
/* harmony export */   throttle: function() { return /* binding */ throttle; },
/* harmony export */   trimParagraph: function() { return /* binding */ trimParagraph; },
/* harmony export */   validateField: function() { return /* binding */ validateField; }
/* harmony export */ });
/* harmony import */ var smoothscroll_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! smoothscroll-polyfill */ "./node_modules/smoothscroll-polyfill/dist/smoothscroll.js");
/* harmony import */ var smoothscroll_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(smoothscroll_polyfill__WEBPACK_IMPORTED_MODULE_0__);


// kick off the polyfill!
smoothscroll_polyfill__WEBPACK_IMPORTED_MODULE_0___default().polyfill();

/**
 * Fade Out method
 *
 * @param {string} el
 */
function fadeOut(el) {
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
function fadeIn(el, display = 'block') {
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
function equalHeights(elementsSelector, minOrMax = 'max') {
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
function trimParagraph() {
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
function isInViewport(el, offset = 100) {
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
const debounce = (fn, delay = 1000) => {
    if (!fn) {
        throw Error(
            '"debounce function - "You didn\'t add required parameters'
        );
    }

    let timeout;

    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn.apply(undefined, args), delay);
    };
};

/**
 *
 * @param {Function | null} func  - function that should be executed
 * @param {number} ms             - time delay
 * @return {Function} wrapper     - function to execute
 */
const throttle = (func, ms) => {
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
const copyToClipboard = (parent, element) => {
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
const validateField = (fieldType = null, value = null) => {
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
function closestPolyfill() {
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
function anchorLinkScroll(elementsSelector = null, callback = null) {
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
const scrollActions = () => {
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
const fadeShopImages = (images) => {
    const currentImage = images[currentIndex];
    const nextIndex = (currentIndex + 1) % images.length;
    const nextImage = images[nextIndex];

    fadeOut(currentImage);
    fadeIn(nextImage);

    currentIndex = nextIndex;
};

const appHeight = () => {
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
function setCookie(key, value, expiry) {
    const expires = new Date();
    expires.setTime(expires.getTime() + expiry * 24 * 60 * 60 * 1000);
    document.cookie = `${key}=${value};expires=${expires.toUTCString()}; path=/`;
}

/**
 * getCookie
 *
 * @param {string} key - cookie name
 */
function getCookie(key) {
    const keyValue = document.cookie.match(`(^|;) ?${key}=([^;]*)(;|$)`);
    return keyValue ? keyValue[2] : null;
}

/**
 * eraseCookie
 *
 * @param {string} key - cookie name
 */
function eraseCookie(key) {
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
const initializePreviewVideo = () => {
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
const getTeamMemberInfo = async (POPUP_ID, MEMBER_ID, popupInstance) => {
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
const initializeUserway = () => {
	if(userwayInitialized){return;}
	let s = document.createElement("script");
	s.setAttribute("data-account", "fCt6JCQ7aV");
	s.defer = true;
	s.setAttribute("src", "https://cdn.userway.org/widget.js");
	(document.body || document.head).appendChild(s);
	userwayInitialized = true;
};


/***/ }),

/***/ "./src/js/parts/navi-tabs.js":
/*!***********************************!*\
  !*** ./src/js/parts/navi-tabs.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/**
 * Tabs Navigation functionality
 *
 * @param {string} tabSwitchSelectors  -  css selectors
 * @param {string} tabPanelSelectors   -  css selectors
 * @param {boolean} closeToClick       -  close child tab by click (default false)
 */
const tabsNavigation = (
    tabSwitchSelectors,
    tabPanelSelectors,
    closeToClick = false
) => {
    tabSwitchSelectors &&
        [...document.querySelectorAll(tabSwitchSelectors)].forEach((item) => {
            item.addEventListener('click', (event) => {
                event.preventDefault();

                const TAB_ID =
                    event.target.nodeName === 'A'
                        ? event.target.getAttribute('href')
                        : event.target.dataset.href;

                if (closeToClick && event.target.classList.contains('active')) {
                    // Remove active state from all switch elements
                    [...document.querySelectorAll(tabSwitchSelectors)].forEach(
                        (el) => el.classList.remove('active')
                    );

                    // Remove active state from all tabs panels
                    [...document.querySelectorAll(tabPanelSelectors)].forEach(
                        (el) => el.classList.remove('active')
                    );
                    return;
                }
                // Remove active state from all switch elements
                [...document.querySelectorAll(tabSwitchSelectors)].forEach(
                    (el) => el.classList.remove('active')
                );

                // Remove active state from all tabs panels
                [...document.querySelectorAll(tabPanelSelectors)].forEach(
                    (el) => el.classList.remove('active')
                );

                // Set active state to current
                event.target.classList.add('active');
                document.querySelector(TAB_ID).classList.add('active');

                // force trigger resize event for the document
                if (document.createEvent) {
                    window.dispatchEvent(new Event('resize'));
                } else {
                    document.body.fireEvent('onresize');
                }
            });
        });
};

/* harmony default export */ __webpack_exports__["default"] = (tabsNavigation);


/***/ }),

/***/ "./src/js/parts/popup-window.js":
/*!**************************************!*\
  !*** ./src/js/parts/popup-window.js ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Popup; }
/* harmony export */ });
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helpers */ "./src/js/parts/helpers.js");


class Popup {
    constructor() {
        this.body = window.document.querySelector('body');
        this.html = window.document.querySelector('html');
    }

    /**
     * Force Close All opened popup window
     * and clear the traces of an opened popup window
     */
    forceCloseAllPopup() {
        [...window.document.querySelectorAll('.popup')].forEach((item) => {
            const allErrorsInPopup = item.querySelectorAll(
                '.wpcf7-not-valid-tip'
            );
            const bottomMessage = item.querySelectorAll(
                '.wpcf7-response-output'
            );
            const form = item.querySelectorAll('form'); // reset()

            if (allErrorsInPopup) {
                // eslint-disable-next-line no-shadow
                allErrorsInPopup.forEach((item) => {
                    item.remove();
                });
            }

            if (bottomMessage) {
                // eslint-disable-next-line no-shadow
                bottomMessage.forEach((item) => {
                    item.remove();
                });
            }

            if (form) {
                // eslint-disable-next-line no-shadow
                form.forEach((item) => {
                    item.reset();
                });
            }

            bottomMessage;

            (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.fadeOut)(item);

            const iframeVideo = item.querySelector('.js-iframe');
            if (iframeVideo) {
                iframeVideo.remove();
            }

            const MAIL_SENT_OK_BOX = item.querySelector('.wpcf7-mail-sent-ok');
            if (MAIL_SENT_OK_BOX) {
                MAIL_SENT_OK_BOX.style.display = 'none';
            }
        });

        this.body.classList.remove('popup-opened');
        this.html.classList.remove('popup-opened');
    }

    /**
     * Open selected popup window
     *
     * @param {string} popupSelector - css selector of popup that should be opened
     * @param {number} timeOut - ms
     */
    openOnePopup(popupSelector = null, timeOut = 1000) {
        // this.forceCloseAllPopup();

        setTimeout(() => {
            this.body.classList.add('popup-opened');
            this.html.classList.add('popup-opened');
            (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.fadeIn)(document.querySelector(popupSelector));
        }, timeOut);
    }

    /**
     * Opening popup window
     */
    openPopup() {
        this.body.addEventListener('click', (event) => {
            if (
                ![...event.target.classList].includes('js-open-popup-activator')
            ) {
                return false;
            }
            event.preventDefault();
            const elHref =
                event.target.nodeName === 'A'
                    ? event.target.getAttribute('href')
                    : event.target.dataset.href;

            this.body.classList.add('popup-opened');
            this.html.classList.add('popup-opened');
            (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.fadeIn)(elHref);
            const iframeWrapper = document.querySelector(
                `${elHref} .js-iframe-video`
            );
            if (iframeWrapper && iframeWrapper.dataset.url.length) {
                iframeWrapper.innerHTML = `<iframe src="${iframeWrapper.dataset.url}" class="js-iframe"  
												width="100%" height="100%" frameborder="0"  
												fullscreen" allowfullscreen></iframe>`;
            }
            return true;
        });
    }

    /**
     * Closing popup window
     */
    closePopup() {
        this.body.addEventListener('click', (event) => {
            // Check if user click on close element
            if (![...event.target.classList].includes('js-popup-close')) {
                return false;
            }
            const popupLockPost = document.querySelectorAll('.js-popup-form');

            popupLockPost &&
                popupLockPost.forEach((popup) => {
                    popup.classList.remove('sent');
                });

            event.preventDefault();
            this.forceCloseAllPopup();
            return true;
        });

        // Checking ESC button for closing opened popup window
        window.document.addEventListener('keydown', (event) => {
            if (event.keyCode === 27) {
                this.forceCloseAllPopup();
            }
        });
    }

    init() {
        this.openPopup();
        this.closePopup();
    }
}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!****************************!*\
  !*** ./src/js/frontend.ts ***!
  \****************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_frontend_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/frontend.scss */ "./src/scss/frontend.scss");
/* harmony import */ var _parts_popup_window__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./parts/popup-window */ "./src/js/parts/popup-window.js");
/* harmony import */ var _parts_navi_tabs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./parts/navi-tabs */ "./src/js/parts/navi-tabs.js");
/* harmony import */ var _parts_helpers__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./parts/helpers */ "./src/js/parts/helpers.js");




function ready() {
  var popupInstance = new _parts_popup_window__WEBPACK_IMPORTED_MODULE_1__["default"]();
  popupInstance.init();
  (0,_parts_navi_tabs__WEBPACK_IMPORTED_MODULE_2__["default"])('.js-tab-name', '.js-tab');
  document.body.addEventListener('click', function (event) {
    var EVENT = event;
    var ROLE = EVENT.target.dataset.role;
    var TARGET = event.target;
    if (!ROLE) return;
    switch (ROLE) {
      case 'menu-action':
        {
          event.preventDefault();
          var MAIN_MENU = document.querySelector('.js-main-menu');
          TARGET.classList.toggle('open');
          document.body.classList.toggle('overflow');
          MAIN_MENU && MAIN_MENU.classList.toggle('show');
        }
        break;
      case 'show-sub-menu':
        {
          event.preventDefault();
          var PARENT_ITEM = TARGET.parentElement;
          var SUB_MENU = PARENT_ITEM.querySelector('.sub-menu');
          var PARENT_MENU = TARGET.closest('.js-menu-wrapper');
          var OPENED_MENU = PARENT_MENU.querySelectorAll('.menu-item.active');
          if (SUB_MENU.style.maxHeight) {
            SUB_MENU.style.maxHeight = null;
            SUB_MENU.classList.remove('active');
            PARENT_ITEM.classList.remove('active');
          } else {
            OPENED_MENU && OPENED_MENU.forEach(function (item) {
              var OPENED_SUB_MENU = item.querySelector('.sub-menu');
              OPENED_SUB_MENU.style.maxHeight = null;
              item.classList.remove('active');
              OPENED_SUB_MENU.classList.remove('active');
            });
            SUB_MENU.style.maxHeight = "".concat(SUB_MENU.scrollHeight, "px");
            SUB_MENU.classList.add('active');
            PARENT_ITEM.classList.add('active');
          }
        }
        break;
      case 'open-select':
        {
          event.preventDefault();
          if (!TARGET.parentElement.classList.contains('active')) {
            var variationItemActive = document.querySelectorAll('.select-box.active');
            variationItemActive.forEach(function (item) {
              return item.classList.remove('active');
            });
            TARGET.parentElement.classList.add('active');
          } else {
            TARGET.parentElement.classList.remove('active');
          }
        }
        break;
      case 'click-select':
        {
          event.preventDefault();
          var val = TARGET.dataset.value;
          var name = TARGET.innerText;
          var attributeID = TARGET.dataset.attribute;
          var selectElement = document.querySelector("#".concat(attributeID));
          TARGET.parentElement.querySelectorAll('.select-box__variation.active').forEach(function (item) {
            item.classList.remove('active');
          });
          TARGET.classList.add('active');
          if (selectElement) {
            selectElement.value = val;
            selectElement.dispatchEvent(new window.Event('change', {
              bubbles: true
            }));
          }
          var selectedBox = document.querySelector("#select-box__selected-".concat(attributeID));
          if (selectedBox) {
            selectedBox.innerHTML = name;
          }
          document.querySelectorAll('.select-box.active').forEach(function (item) {
            item.classList.remove('active');
          });
          var form = document.querySelector('.js-blog-filters-form');
          form && form.submit();
        }
        break;
      case 'copy-to-clickboard':
        {
          navigator.clipboard.writeText(window.location.href);
          var COPY_ALERT = TARGET.parentElement.querySelector('.copy-text');
          COPY_ALERT && COPY_ALERT.classList.add('show');
          setTimeout(function () {
            COPY_ALERT && COPY_ALERT.classList.remove('show');
          }, 3000);
        }
        break;
      case 'slide-down-up':
        {
          var element = TARGET.parentElement.querySelector('.js-slide-block');
          var currentOpened = document.querySelector('.js-slide-block[aria-hidden="false"]');
          if (currentOpened === element) {
            element.setAttribute('aria-hidden', 'true');
            element.parentNode.classList.remove('active');
            TARGET.setAttribute('aria-expanded', 'false');
          } else {
            if (currentOpened) {
              currentOpened.setAttribute('aria-hidden', 'true');
              var currentItemParent = currentOpened.closest('.js-slide-item');
              var currentItemSlide = currentOpened.previousElementSibling;
              currentItemParent && currentItemParent.classList.remove('active');
              currentItemSlide && currentItemSlide.setAttribute('aria-expanded', 'false');
            }
            element.setAttribute('aria-hidden', 'false');
            element.parentNode.classList.add('active');
            TARGET.setAttribute('aria-expanded', 'true');
          }
        }
        break;
      case 'show-hide-info':
        {
          TARGET.classList.toggle('active');
          var info = TARGET.parentElement.querySelector('.js-info-block');
          info && info.classList.toggle('active');
        }
        break;
      case 'show-team-member-info':
        {
          var POPUP_ID = TARGET.dataset.href;
          var MEMBER_ID = TARGET.dataset.id;
          (0,_parts_helpers__WEBPACK_IMPORTED_MODULE_3__.getTeamMemberInfo)(POPUP_ID, MEMBER_ID, popupInstance);
        }
        break;
      default:
    }
  });
  (0,_parts_helpers__WEBPACK_IMPORTED_MODULE_3__.appHeight)();
  (0,_parts_helpers__WEBPACK_IMPORTED_MODULE_3__.initializePreviewVideo)();
}
window.document.addEventListener('DOMContentLoaded', ready);
window.addEventListener('load', function () {
  var imageContainer = document.querySelector('.js-shop-images');
  var imagesList = document.querySelectorAll('.js-shop-image');
  if (imagesList.length && imageContainer) {
    setInterval(function () {
      (0,_parts_helpers__WEBPACK_IMPORTED_MODULE_3__.fadeShopImages)(Array.from(imagesList));
    }, 3000);
  }
  (0,_parts_helpers__WEBPACK_IMPORTED_MODULE_3__.scrollActions)();
});
window.addEventListener('resize', _parts_helpers__WEBPACK_IMPORTED_MODULE_3__.appHeight);
document.addEventListener('touchstart', function () {
  (0,_parts_helpers__WEBPACK_IMPORTED_MODULE_3__.scrollActions)();
}, {
  passive: true
});
document.addEventListener('mousemove', function () {
  (0,_parts_helpers__WEBPACK_IMPORTED_MODULE_3__.initializeUserway)();
});
document.addEventListener('click', function () {
  (0,_parts_helpers__WEBPACK_IMPORTED_MODULE_3__.initializeUserway)();
});
}();
/******/ })()
;
//# sourceMappingURL=frontend.js.map