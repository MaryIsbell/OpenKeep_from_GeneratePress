// Smoothly animates the home page accordions (<details class="ok-accordion-item">)
// open and closed. Without this script they still work, they just snap open.
document.addEventListener('DOMContentLoaded', function () {
    var DURATION = 350; // milliseconds
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    document.querySelectorAll('.ok-accordion-item').forEach(function (details) {
        var summary = details.querySelector('summary');
        var animation = null;
        var isClosing = false;

        if (!summary) {
            return;
        }

        summary.addEventListener('click', function (event) {
            if (reduceMotion.matches) {
                return; // Let the browser open/close it instantly.
            }

            event.preventDefault();

            // Opening if it's closed, or if it's partway through closing.
            var opening = !details.open || isClosing;
            var startHeight = details.offsetHeight;

            if (animation) {
                animation.cancel();
            }

            // Measure the open and closed heights, then leave it open so the
            // text stays visible while the height animates.
            details.open = true;
            var openHeight = details.offsetHeight;
            details.open = false;
            var closedHeight = details.offsetHeight;
            details.open = true;

            isClosing = !opening;
            details.style.overflow = 'hidden';

            animation = details.animate(
                { height: [startHeight + 'px', (opening ? openHeight : closedHeight) + 'px'] },
                { duration: DURATION, easing: 'ease' }
            );

            animation.onfinish = function () {
                animation = null;
                isClosing = false;
                details.open = opening;
                details.style.overflow = '';
            };
        });
    });
});
