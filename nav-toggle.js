document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.querySelector('.ok-nav-toggle');
    var nav = document.getElementById('ok-primary-nav');

    if (!toggle || !nav) {
        return;
    }

    toggle.addEventListener('click', function () {
        var isOpen = nav.classList.toggle('is-open');
        toggle.classList.toggle('is-active', isOpen);
        toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
});
