document.addEventListener('DOMContentLoaded', function () {
    var elms = document.getElementsByClassName('splide');

    for (var i = 0; i < elms.length; i++) {
        new Splide(elms[i], {
            type   : 'loop',
            perPage: 3,
            gap    : '2rem',
            breakpoints: {
                1024: { perPage: 2 },
                768:  { perPage: 1 },
            },
            autoplay: true,
            interval: 5000,
            speed: 1000,
            pauseOnHover: true,
            pauseOnFocus: true,
            arrows: true,
            pagination: false,
        }).mount();
    }
});