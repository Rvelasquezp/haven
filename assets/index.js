// import Site styles
import "/assets/css/style.scss";

// import block styles
import "/assets/css/blocks/coming-soon.scss";
import "/assets/css/blocks/header.scss";
import "/assets/css/blocks/footer.scss";
import "/assets/css/blocks/hero.scss";
import "/assets/css/blocks/image-content.scss";
import "/assets/css/blocks/mission-and-vision.scss";
import "/assets/css/blocks/services-slider.scss";
import "/assets/css/blocks/our-faq.scss";
import "/assets/css/blocks/slider_logos.scss";
import "/assets/css/blocks/banner_small.scss";
import "/assets/css/blocks/equipe.scss";
import "/assets/css/blocks/services.scss";
import "/assets/css/blocks/listservices.scss";

// import Swiper styles
import "swiper/css";
import "swiper/css/effect-fade";

// import js libraries
import Swiper from "swiper";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollSmoother } from "gsap/ScrollSmoother";

gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

// import js files
import ComingSoon from "./js/blocks/coming-soon.js";
import Header from "./js/blocks/header.js";
import Hero from "./js/blocks/hero.js";
import ServicesSlider from "./js/blocks/services-slider.js";
import FaqToggles from "./js/blocks/faq-toggle.js";
import sliderLogos from "./js/blocks/slider-logo.js";

// create the scrollSmoother before your scrollTriggers
let scroller = ScrollSmoother.create({
  smooth: 1, // how long (in seconds) it takes to "catch up" to the native scroll position
  effects: true, // looks for data-speed and data-lag attributes on elements
  smoothTouch: 0, // much shorter smoothing time on touch devices (default is NO smoothing on touch devices)
  content: ".wp-site-blocks",
});

if (window.innerWidth < 650) {
  scroller.smooth = 0;
}

// Replacing default social icons
document.querySelectorAll(".wp-social-link-facebook a").forEach((f) => {
  f.innerHTML =
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>';
});

document.querySelectorAll(".wp-social-link-linkedin a").forEach((f) => {
  f.innerHTML =
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></svg>';
});

ComingSoon();
Header(scroller);
Hero(Swiper);
ServicesSlider(Swiper);
FaqToggles();
sliderLogos(Swiper);

gsap.to("html", {
  autoAlpha: 1,
});

// Anchor Scroll
const anchorLinks = document.querySelectorAll("a[href^='#']");
for (let link of anchorLinks) {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    // If it exists, scroll to the anchor
    let anchor = false;

    try {
      anchor = document.querySelector(this.getAttribute("href"));
    } catch {
      return;
    }

    if (anchor) {
      gsap.to(scroller, {
        scrollTop: Math.min(
          ScrollTrigger.maxScroll(window),
          scroller.offset(this.getAttribute("href"), "top top") - 160
        ),
        duration: 1,
      });
    }
  });
}

if (window.location.hash && document.querySelector(window.location.hash)) {
  scroller.scrollTo(window.location.hash, true);
}

var allNodes = document.querySelectorAll(
  ".wp-site-blocks .entry-content > *:not(.pin-spacer):not(.hero) *:not(.faq *), footer > *"
);

allNodes.forEach((element) => {
  element.classList.add("fade-in");
});

document.querySelectorAll(".fade-in").forEach((box, i) => {
  // Excluye cualquier fade-in dentro del banner por si acaso
  if (box.closest(".banner_image_small")) return;

  const anim = gsap.fromTo(
    box,
    { autoAlpha: 0, y: 30 },
    { duration: 1, autoAlpha: 1, y: 0 }
  );
  ScrollTrigger.create({
    trigger: box,
    animation: anim,
    toggleActions: "play none none none",
    once: true,
  });
});
