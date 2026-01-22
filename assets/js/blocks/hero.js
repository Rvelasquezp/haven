import { gsap } from "gsap";
import { Autoplay, EffectFade } from "swiper";

export default function Hero(Swiper) {
	Swiper.use([Autoplay, EffectFade]);
	let hero = document.querySelector(".hero");
	if (hero) {
		let heroSlider = hero.querySelector(".hero-slider");

		let revealTl = gsap.timeline({
			paused: true,
			defaults: { ease: "power3.inOut" },
		});
		let image = hero.querySelector(".hero-background-slider");
		let topText = hero.querySelector(".hero-top-content .hero-content");
		let logo = hero.querySelector(".hero-top-content .wp-block-image");

		revealTl
			.from(image, {
				duration: 2,
				xPercent: 100,
			})
			.from(
				topText,
				{
					duration: 1,
					yPercent: -110,
				},
				"-=1"
			)
			.from(
				logo,
				{
					duration: 1,
					autoAlpha: 0,
				},
				"-=1"
			);

		setTimeout(() => {
			revealTl.play();
		}, 300);

		if (heroSlider) {
			let slideCount = heroSlider.querySelectorAll(".swiper-slide").length;

			if (slideCount > 1) {
				let heroSwiper = new Swiper(heroSlider, {
					slidesPerView: 1,
					loop: true,
					autoplay: {
						delay: 5000,
					},
					effect: "fade",
					speed: 1000,
				});
			}
		}
	}
}
