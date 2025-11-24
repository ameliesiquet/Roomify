import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

function initSwiper() {
    document.querySelectorAll('.mySwiper').forEach(el => {
        if (el.swiper) {
            el.swiper.destroy(true, true);
        }

        new Swiper(el, {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
            navigation: {
                nextEl: el.querySelector('.swiper-button-next'),
                prevEl: el.querySelector('.swiper-button-prev'),
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
    });
}

document.addEventListener('DOMContentLoaded', initSwiper);
document.addEventListener('turbo:load', initSwiper);
document.addEventListener('livewire:navigated', initSwiper);
