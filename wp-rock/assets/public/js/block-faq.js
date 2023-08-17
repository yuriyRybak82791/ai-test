/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/scss/acf-blocks/block-faqs.scss":
/*!*********************************************!*\
  !*** ./src/scss/acf-blocks/block-faqs.scss ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


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
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!*****************************************!*\
  !*** ./src/js/acf-blocks/block-faqs.js ***!
  \*****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_acf_blocks_block_faqs_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../scss/acf-blocks/block-faqs.scss */ "./src/scss/acf-blocks/block-faqs.scss");


const initFaqs = () => {
    const faq = document.querySelector('.js-faq');
    if (faq) {
        console.log(faq);
        faq.addEventListener('click', (event) => {
            const question = event.target.closest('.js-faq-question');
            if (!question) return;
            const answer = question.nextElementSibling;
            // hide previously opened answer and show the clicked answer
            const currentAnswer = faq.querySelector(
                '.js-faq-answer[aria-hidden="false"]'
            );
            if (currentAnswer === answer) {
                // close the already open answer
                answer.setAttribute('aria-hidden', 'true');
                answer.parentNode.classList.remove('faq__item--expanded');
                question.setAttribute('aria-expanded', 'false');
            } else {
                // hide previously open answer and show the clicked answer
                if (currentAnswer) {
                    currentAnswer.setAttribute('aria-hidden', 'true');
                    currentAnswer.parentNode.classList.remove(
                        'faq__item--expanded'
                    );
                    currentAnswer.previousElementSibling.setAttribute(
                        'aria-expanded',
                        'false'
                    );
                }
                answer.setAttribute('aria-hidden', 'false');
                answer.parentNode.classList.add('faq__item--expanded');
                question.setAttribute('aria-expanded', 'true');
            }
        });
    }
};

document.defaultView.addEventListener('DOMContentLoaded', initFaqs, false);

// Initialize dynamic block preview (editor).
if (window.acf) {
    window.acf.addAction('render_block_preview', initFaqs);
}

}();
/******/ })()
;
//# sourceMappingURL=block-faq.js.map