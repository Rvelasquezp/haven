import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

export default function FaqToggles() {
	let groups = gsap.utils.toArray(".faq");
	let groupsOpen = gsap.utils.toArray(".faq.openByDefault .faqToggle");
	let menus = gsap.utils.toArray(".faqToggle");
	let menuToggles = groups.map(createAnimation);

	menus.forEach((menu) => {
		menu.addEventListener("click", () => toggleMenu(menu));
	});

	groupsOpen.forEach((menu) => {
		simulateClick(menu);
	});

	function toggleMenu(clickedMenu) {
		menuToggles.forEach((toggleFn) => toggleFn(clickedMenu));
	}

	function createAnimation(element) {
		let menu = element.querySelector(".faqToggle");
		let box = element.querySelector(".faqContent");

		gsap.set(box, { height: "auto", padding: "1.75rem 0 1.25rem 0" });

		let animation = gsap
			.from(box, {
				height: 0,
				padding: 0,
				duration: 0.5,
				ease: "power1.inOut",
				onStart: () => box.parentElement.classList.add("open"),
				onComplete: () => ScrollTrigger.refresh(),
				onReverseComplete: () => {
					box.parentElement.classList.remove("open");
					ScrollTrigger.refresh();
				},
			})
			.reverse();

		return function (clickedMenu) {
			if (clickedMenu === menu) {
				animation.reversed(!animation.reversed());
			}
		};
	}
}

var simulateClick = function (elem) {
	// Create our event (with options)
	var evt = new MouseEvent("click", {
		bubbles: true,
		cancelable: true,
		view: window,
	});
	// If cancelled, don't dispatch our event
	var canceled = !elem.dispatchEvent(evt);
};
