import "./bootstrap";
import Swiper from "swiper/bundle";
import "swiper/css/bundle";

// Inisialisasi slider Weekly Highlights
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
