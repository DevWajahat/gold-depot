"use strict";
const carouselSlider = new Swiper(".carousel-slider", {
    grabCursor: true,
    watchSlidesProgress: true,
    loop: true,
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 20,
    initialSlide: 0,
    on: {
        progress(e) {
            // e is Swiper instance
            console.log("e", e);
            const t = e.slides.length;
            for (let r = 0; r < e.slides.length; r += 1) {
                const o = e.slides[r], s = e.slides[r].progress, i = Math.abs(s);
                let n = 1;
                i > 1 && (n = 0.3 * (i - 1) + 1);
                const l = o.querySelectorAll(".item-content"), a = s * n * 50 + "%", c = 1 - 0.2 * i, d = t - Math.abs(Math.round(s));
                (o.style.transform = `translateX(${a}) scale(${c})`),
                    (o.style.zIndex = d.toString()),
                    (o.style.opacity = (i > 3 ? 0 : 1).toString()),
                    l.forEach((e) => {
                        e.style.opacity = (1 - i / 3).toString();
                    });
            }
        },
        setTransition(e, t) {
            for (let r = 0; r < e.slides.length; r += 1) {
                const o = e.slides[r], s = o.querySelectorAll(".item-content");
                (o.style.transitionDuration = `${t}ms`),
                    s.forEach((e) => {
                        e.style.transitionDuration = `${t}ms`;
                    });
            }
        }
    }
});
