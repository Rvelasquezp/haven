import { gsap } from "gsap"; 

export default function ComingSoon() {
	let comingSoon = document.querySelector(".coming-soon");
	if (comingSoon) {
		let svgLogo = comingSoon.querySelector("svg.svg-block");
		let topText = comingSoon.querySelector(".coming-soon__top-text");
		let bottomContent = comingSoon.querySelector(".coming-soon__contact");
		let image = comingSoon.querySelector("figure img");
		let revealTl = gsap.timeline({
			paused: true,
			defaults: { ease: "power3.inOut" },
		});

		// Once image is loaded, reveal the content

		revealTl
			.to(svgLogo, {
				duration: 1,
				opacity: 1,
				scale: 1,
			})
			.to(image, {
				duration: 2,
				x: 0,
			}, "-=2"
            )
			.to(
				topText,
				{
					duration: 1,
					y: 0,
				},
				"-=1"
			)
			.to(
				bottomContent,
				{
					duration: 1,
					y: 0,
				},
				"-=1"
			);

		setTimeout(() => {
			revealTl.play();
		}, 1000);
	}
}
