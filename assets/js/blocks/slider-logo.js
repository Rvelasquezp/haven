import { Navigation, Autoplay } from "swiper";

export default function sliderLogos(Swiper) {
  Swiper.use([Navigation, Autoplay]);
  const sections = document.querySelectorAll(".slider_logos .swiper");

  if (sections.length > 0) {
    for (let section of sections) {
      const swiper = new Swiper(section, {
        modules: [Navigation, Autoplay],
        slidesPerView: 5,
        spaceBetween: 90,
        loop: true,
        speed: 1200,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        breakpoints: {
          320: {
            slidesPerView: 2.6,
            spaceBetween: 40,
          },
          640: {
            slidesPerView: 3,
            spaceBetween: 50,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 50,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 46,
          },
          1300: {
            slidesPerView: 5,
            spaceBetween: 90,
          },
        },
      });
    }
  }
}
