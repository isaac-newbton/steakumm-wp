function playVid(evt) {
    evt.target.querySelectorAll('#homepage-videos .owl-item video').forEach( (el) => {
        el.pause();
        el.currentTime = 0;
    });
    evt.target.querySelectorAll('#homepage-videos .owl-item.active video').forEach( (el) => {
        if (mobile()) {
            if (el.classList.contains('mobile-only')) {
               el.play();
            }
        } else {
            if (el.classList.contains('desktop-only')) {
               el.play();
            }
        }
    });
}

function initVids(evt) {
    const carousel = this;
    document.querySelectorAll('#homepage-videos video').forEach( (el, ind, arr) => {
       el.addEventListener('ended', (evt) => {
           evt.target.pause();
           evt.target.currentTime = 0;
           if (carousel._current < carousel._items.length - 1) {
               carousel.next();
           } else {
               carousel.to(0);
           }
       });
    });
    if (mobile()) {
        evt.target.querySelector('.owl-item:first-child video.mobile-only').play();
    } else {
        evt.target.querySelector('.owl-item:first-child video.desktop-only').play();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    $('#homepage-videos').owlCarousel({
        items: 1,
        autoHeight: true,
        navSpeed: 600,
        onInitialized: initVids,
        onTranslated: playVid,
        rewind: true
    });

    const owlOpt = {
        items: 1.6,
        navSpeed: 600,
        center: true,
        startPosition: 1,
        nav: true,
        navText: [`<i class="fas fa-caret-left">`,`<i class="fas fa-caret-right">`]
    };

    $('.products .owl-carousel').owlCarousel(owlOpt);
    $('.merch-list .owl-carousel').owlCarousel(owlOpt);
});