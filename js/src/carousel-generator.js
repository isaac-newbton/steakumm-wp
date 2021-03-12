document.addEventListener('DOMContentLoaded', () => {
    const owlOpt = {
        items: 1.6,
        navSpeed: 600,
        center: true,
        startPosition: 1,
        nav: true,
        navText: [`<i class="fas fa-caret-left">`,`<i class="fas fa-caret-right">`]
    };

    if (mobile()) {
        $('.other-products').owlCarousel(owlOpt);
    }

    window.addEventListener('resize', (evt) => {
        if (!mobile()) {
            $('.owl-carousel.owl-loaded').owlCarousel('destroy');
        } else {
            $('.owl-carousel:not(.owl-loaded)').owlCarousel(owlOpt);
        }
    });
});