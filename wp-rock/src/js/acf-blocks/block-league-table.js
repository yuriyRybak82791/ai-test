import '../../scss/acf-blocks/block-league-table.scss';

const initLeagueTable = () => {
    /*
     * Synchronize two scrollbars for divs
     */
    let ignoreScrollEvents = false;

    function syncScroll(firstElement, secondElement) {
        firstElement.addEventListener('scroll', function () {
            const ignore = ignoreScrollEvents;
            ignoreScrollEvents = false;
            if (ignore) return;

            ignoreScrollEvents = true;
            secondElement.scrollLeft = firstElement.scrollLeft;
        });

        secondElement.addEventListener('scroll', function () {
            const ignore = ignoreScrollEvents;
            ignoreScrollEvents = false;
            if (ignore) return;

            ignoreScrollEvents = true;
            firstElement.scrollLeft = secondElement.scrollLeft;
        });
    }
    const scrollContent = document.querySelector('.js-scroll-content');
    const scrollHeader = document.querySelector('.js-scroll-header');
    if (scrollContent && scrollHeader) {
        syncScroll(scrollContent, scrollHeader);
    }
};

document.defaultView.addEventListener(
    'DOMContentLoaded',
    initLeagueTable,
    false
);

// Initialize dynamic block preview (editor).
if (window.acf) {
    window.acf.addAction('render_block_preview', initLeagueTable);
}
