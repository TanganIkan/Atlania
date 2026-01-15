import "./bootstrap";
import Swiper from "swiper/bundle";
import "swiper/css/bundle";
import "./bootstrap";
import Quill from "quill";
import "quill/dist/quill.snow.css";

window.Quill = Quill;

// slider
const initWeeklySlider = () => {
    const element = document.querySelector(".weeklySwiper");
    if (element) {
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

// Jalankan saat dokumen siap
document.addEventListener("DOMContentLoaded", initWeeklySlider);
