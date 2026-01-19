import "./bootstrap";
import Swiper from "swiper/bundle";
import "swiper/css/bundle";
import Quill from "quill";
import "quill/dist/quill.snow.css";
import "flowbite";

window.Quill = Quill;

// slider weekly
const initWeeklySlider = () => {
    const weeklyElem = document.querySelector(".weeklySwiper");
    if (weeklyElem) {
        new Swiper(".weeklySwiper", {
            slidesPerView: 1,
            spaceBetween: 24,
            grabCursor: true,
            loop: false,
            speed: 400,
            autoplay: { delay: 4000 },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 4 },
            },
        });
    }
};

// slider hero
const initHeroSlider = () => {
    const heroElem = document.querySelector(".heroSwiper");
    if (heroElem) {
        new Swiper(".heroSwiper", {
            loop: true,
            speed: 500,
            spaceBetween: 100,
            grabCursor: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".hero-pagination-bullet",
                type: "fraction",
                renderFraction: function (currentClass, totalClass) {
                    return (
                        '<span class="' +
                        currentClass +
                        ' text-3xl font-black text-[#1a1c2e]"></span>' +
                        '<span class="text-xl font-bold text-gray-300 ml-2">/ ' +
                        '<span class="' +
                        totalClass +
                        '"></span></span>'
                    );
                },
            },
        });
    }
};

// execute
document.addEventListener("DOMContentLoaded", () => {
    initWeeklySlider();
    initHeroSlider();
});
