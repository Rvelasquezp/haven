import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function Header(scroller) {
  document
    .querySelectorAll("header .main-menu-toggler")
    .forEach(function (toggler) {
      toggler.addEventListener("click", function () {
        let samnt = document.querySelector(".header-main").offsetHeight;
        document.querySelector(".header-mobile-nav").style.top = samnt + "px";

        document
          .querySelector(".main-menu-toggler")
          .classList.toggle("menu-open");
        document
          .querySelector(".header-mobile-nav")
          .classList.toggle("menu-open");

        if (
          document
            .querySelector(".main-menu-toggler")
            .classList.contains("menu-open")
        ) {
          scroller.paused(true);
          gsap.to(".header-mobile-nav", {
            duration: 0.5,
            opacity: 1,
            height: "calc(100vh - " + samnt + "px)",
            pointerEvents: "auto",
            ease: "power2.inOut",
          });
          document.querySelector("header").classList.add("header-menu-open");
        } else {
          scroller.paused(false);
          gsap.to(".header-mobile-nav", {
            duration: 0.5,
            opacity: 0,
            height: 0,
            pointerEvents: "none",
            ease: "power2.inOut",
          });
          document.querySelector("header").classList.remove("header-menu-open");
        }
      });
    });

  function closeMobileMenu() {
    document.querySelector(".main-menu-toggler").classList.toggle("menu-open");
    document.querySelector(".header-mobile-nav").classList.toggle("menu-open");
    scroller.paused(false);
    gsap.to(".header-mobile-nav", {
      duration: 0.5,
      opacity: 0,
      height: 0,
      pointerEvents: "none",
      ease: "power2.inOut",
    });
    document.querySelector("header").classList.remove("header-menu-open");
  }

  let headerPin = null;

  function setupHeaderPin() {
    const header = document.querySelector("header.wp-block-template-part");

    if (!header) return;

    // DESKTOP → crear pin
    if (window.innerWidth >= 960 && !headerPin) {
      headerPin = ScrollTrigger.create({
        trigger: header,
        pin: true,
        start: "top top",
        endTrigger: "footer.wp-block-template-part",
        pinSpacing: false,
      });
    }

    // MOBILE → matar pin
    if (window.innerWidth < 960 && headerPin) {
      headerPin.kill();
      headerPin = null;
    }
  }

  function setMobileBannerOffset() {
    const header = document.querySelector("header.wp-block-template-part");
    const banner = document.querySelector(".banner_small");

    if (!header || !banner) return;

    if (window.innerWidth < 650) {
      banner.style.marginTop = header.offsetHeight + "px";
    } else {
      banner.style.marginTop = "0px";
    }
  }

  // INIT
  setupHeaderPin();
  setMobileBannerOffset();

  // RESIZE (con refresh correcto)
  window.addEventListener("resize", () => {
    setupHeaderPin();
    setMobileBannerOffset();
    ScrollTrigger.refresh();
  });

  document.querySelectorAll(".header-mobile-nav a").forEach(function (link) {
    link.addEventListener("click", function () {
      if (link.getAttribute("href") != "#") {
        closeMobileMenu();
      }
    });
  });
}
