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

  if (window.innerWidth < 650) {
    document.querySelector(".entry-content").style.paddingTop =
      document.querySelector("header").offsetHeight + "px";
  }

  //   if (
  //     document.querySelector("header.wp-block-template-part") &&
  //     window.innerWidth >= 650
  //   ) {
  //     const line = document.createElement("span");
  //     line.classList.add("header-line");
  //     document
  //       .querySelector("header.wp-block-template-part .header-main")
  //       .prepend(line);

  //     var headerTl = gsap.timeline({
  //       paused: true,
  //       defaults: { ease: "power3.inOut" },
  //     });

  //     headerTl
  //       .from(".header-main .header-line", {
  //         width: 0,
  //       })
  //       .from(
  //         ".header-main-cols a",
  //         {
  //           y: 30,
  //           autoAlpha: 0,
  //           stagger: 0.1,
  //         },
  //         "<"
  //       );

  //     setTimeout(() => {
  //       headerTl.play();
  //     }, 200);

  //     ScrollTrigger.create({
  //       trigger: "header.wp-block-template-part",
  //       pin: true, // pin the trigger element while active
  //       start: "top 2em+=top", // when the top of the trigger hits the top of the viewport
  //       endTrigger: "footer.wp-block-template-part",
  //       pinSpacing: false,
  //     });

  //     let scrolledThreshold = 1;

  //     ScrollTrigger.create({
  //       trigger: ".wp-site-blocks",
  //       onUpdate: () => {
  //         let samnt = scroller.scrollTop();

  //         if (samnt >= scrolledThreshold) {
  //           document
  //             .querySelector("header.wp-block-template-part")
  //             .classList.add("h-scrolled");
  //           document
  //             .querySelector(".header-mobile-nav")
  //             .classList.add("h-scrolled");
  //           document.querySelector(".header-main").classList.add("h-scrolled");

  //           gsap.to(".header-main", {
  //             // duration: 0.3,
  //             padding: "2em 7.3em",
  //             ease: "power3.out",
  //           });
  //         } else {
  //           document
  //             .querySelector("header.wp-block-template-part")
  //             .classList.remove("h-scrolled");
  //           document
  //             .querySelector(".header-mobile-nav")
  //             .classList.remove("h-scrolled");
  //           document.querySelector(".header-main").classList.remove("h-scrolled");

  //           gsap.to(".header-main", {
  //             // duration: 0.3,
  //             padding: "3.4em 7.3em",
  //             ease: "power3.out",
  //           });
  //         }
  //       },
  //     });
  //   }

  document.querySelectorAll(".header-mobile-nav a").forEach(function (link) {
    link.addEventListener("click", function () {
      if (link.getAttribute("href") != "#") {
        closeMobileMenu();
      }
    });
  });
}
