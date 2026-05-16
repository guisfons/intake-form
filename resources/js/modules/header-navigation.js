// Header, nav functions

$(".btn-hamburger").on("click", function () {
  var visible = $(".container-menu").is(":visible");
  if (!visible) {
    $(".container-menu").toggleClass("show-menu");
    $(".overlay-menu").toggleClass("show");
  } else {
    $(".container-menu").toggleClass("show-menu");
    $(".overlay-menu").toggleClass("show");
  }
  $("body").toggleClass("over-hidden");
  $("body").toggleClass("show-main-nav");
  $(".btn-triger-footer").toggleClass("d-none");
});

$(window).on("resize", function () {
  var win = $(this);
  if (win.width() >= 1025) {
    $(".container-menu").removeClass("show-menu");
  }
});

$(window).on("load resize", function () {
  if (this.matchMedia("(min-width: 1025px)").matches) {
    $("ul#menu-primary li.menu-item-has-children").hover(
      function () {
        const $this = $(this);
        $this.addClass("show");
        $this.find(".has-child").attr("aria-expanded", "true");
        $this.find(".sub-menu").addClass("show");
        $this.find("li.menu-item-has-children ul.sub-menu").removeClass("show");
      },
      function () {
        const $this = $(this);
        $this.removeClass("show");
        $this.find(".has-child").attr("aria-expanded", "false");
        $this.find(".sub-menu").removeClass("show");
      }
    );
  } else {
    $(".has-child").off("mouseenter mouseleave");
  }
});

//mobile action
$(".has-child").click(function (e) {
  $(this).toggleClass("rotate");
  e.preventDefault();
  var width = $(window).width();
  var btn = $(this);
  if (width <= 1024) {
    if (!btn.next().is(":visible")) {
      btn.next().slideDown(300);
    } else {
      btn.next().slideUp(300);
    }
  }
});

// close promotion bar
$(".trigger-promotion").click(function (e) {
  $("header .promotion-top-bar").slideUp();
  e.preventDefault();
});

if (document.querySelector("header")) {
  var offset = $(".site-header").offset();
  checkOffset();
  $(window).scroll(function () {
    checkOffset();
  });
  function checkOffset() {
    var topData = offset.top;
    var bodyScrollTop =
      document.documentElement.scrollTop || document.body.scrollTop;

    if (bodyScrollTop > topData) {
      $(".site-header").addClass("fixed-header");
    } else {
      $(".site-header").removeClass("fixed-header");
    }
  }
}

if (document.querySelector("header.type-transparent")) {
  if (window.ResizeObserver) {
    const header = document.querySelector("header");
    const observer = new ResizeObserver((entries) => {
      for (const entry of entries) {
        const headerHeight = entry.contentRect.height;
        const siteHeaderHeight =
          document.querySelector(".site-header").offsetHeight;
        const total = headerHeight - siteHeaderHeight;
        const sectionHero = document.querySelector(".section-hero");
        const sectHeroLanding = document.querySelector(
          ".section-content-form .section-wrapper"
        );

        // get first section data to check if is a Hero Type or a Contact Form Landing type
        const section = document.querySelectorAll("section");
        const first = section[0];
        if (document.querySelector(".site-header.fixed-header")) {
          if (first.classList.contains("section-hero")) {
            sectionHero.style.cssText =
              "margin-top:" +
              total +
              "px; padding-top:" +
              siteHeaderHeight * 2 +
              "px";
          } else if (first.classList.contains("section-content-form")) {
            sectHeroLanding.style.cssText =
              "margin-top:" +
              total +
              "px; padding-top:" +
              siteHeaderHeight * 2 +
              "px";
          }
        } else {
          if (first.classList.contains("section-hero")) {
            sectionHero.style.cssText =
              "margin-top:" +
              total +
              "px; padding-top:" +
              siteHeaderHeight +
              "px";
          } else if (first.classList.contains("section-content-form")) {
            sectHeroLanding.style.cssText =
              "margin-top:" +
              total +
              "px; padding-top:" +
              siteHeaderHeight +
              "px";
          }
        }
      }
    });
    observer.observe(header);
  }
} else if (document.querySelector("header:not(type-transparent)")) {
  if (window.ResizeObserver) {
    const header = document.querySelector("header");
    const observer = new ResizeObserver((entries) => {
      for (const entry of entries) {
        const headerHeight = entry.contentRect.height;
        const mainBody = document.querySelector(".main");
        mainBody.style.cssText = "padding-top:" + headerHeight + "px";
        if (document.querySelector(".site-header.fixed-header")) {
          mainBody.style.cssText = "padding-top:" + headerHeight * 2 + "px";
        } else {
          mainBody.style.cssText = "padding-top:" + headerHeight + "px";
        }
      }
    });
    observer.observe(header);
  }
}
