import "./bootstrap";
import "bootstrap";
// import "swiper/css";
// import "swiper/css/bundle";
// import Swiper from "swiper";

// import "swiper/css/navigation";
// import "swiper/css/pagination";

document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".mySwiper", {
        loop: true,
        slidesPerView: 3,
        spaceBetween: 10,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        breakpoints: {
            0: {
                slidesPerView: 1,
            },

            768: {
                slidesPerView: 2,
            },
            1020: {
                slidesPerView: 3,
            },
        },
    });

    new Swiper(".mySwipers", {
        loop: true,
        slidesPerView: 1,
        pagination: {
            el: ".swiper-pagination",
        },
    });

    const sessionAlert = document.getElementById("session-alert");
    if (sessionAlert) {
        const message = sessionAlert.dataset.success;
        Swal.fire({
            title: "Berhasil!",
            text: message,
            icon: "success",
            confirmButtonText: "OK",
        });
    }
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");
    window.addEventListener("scroll", () => {
        if (window.scrollY > 100) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    });
    scrollToTopBtn.addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});
