import { Navigation, Controller, EffectFade, Autoplay } from "swiper";

export default function ServicesSlider(Swiper) {
	Swiper.use([Navigation, Controller, EffectFade, Autoplay]);

	let sliders = document.querySelectorAll(".services-slider");
	sliders.forEach((slider) => {
		let titleSlides = new Swiper(
			slider.querySelector(".services-swiper-text"),
			{
				slidesPerView: 1,
				spaceBetween: 20,
				autoHeight: true,
				loop: true,
				effect: "fade",
				// autoplay: {
				//     delay: 5000,
				//     disableOnInteraction: false,
				// }
			}
		);

		let imageSliders = new Swiper(
			slider.querySelector(".services-swiper-images"),
			{
				slidesPerView: 1,
				spaceBetween: 20,
				loop: true,
				// autoplay: {
				//     delay: 5000,
				//     disableOnInteraction: false,
				// },
				allowTouchMove: false,
				navigation: {
					nextEl: slider.querySelector(".swiper-button-next"),
					prevEl: slider.querySelector(".swiper-button-prev"),
				},
			}
		);

		titleSlides.controller.control = imageSliders;
		imageSliders.controller.control = titleSlides;

		slider
			.querySelectorAll(".services-swiper-inner-images")
			.forEach((innerSlider) => {
				let innerImageSlider = new Swiper(innerSlider, {
					slidesPerView: 1,
					spaceBetween: 20,
					loop: true,
					speed: 1500,
					autoplay: {
					    delay: 5000,
					    disableOnInteraction: false,
					},
				});
			});
	});
}
