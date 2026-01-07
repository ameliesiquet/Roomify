import Swiper, { Navigation, Pagination, FreeMode } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/free-mode';

Swiper.use([Navigation, Pagination, FreeMode]);

function initSwiper() {
    document.querySelectorAll('.mySwiper').forEach(el => {
        if (el.swiper) {
            el.swiper.destroy(true, true);
        }

        new Swiper(el, {
            slidesPerView: 'auto',
            spaceBetween: 10,
            freeMode: true,
            loop: false,
            navigation: {
                nextEl: el.querySelector('.swiper-button-next'),
                prevEl: el.querySelector('.swiper-button-prev'),
            },
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
        });

    });
}

document.addEventListener('DOMContentLoaded', initSwiper);
document.addEventListener('turbo:load', initSwiper);
document.addEventListener('livewire:navigated', initSwiper);
