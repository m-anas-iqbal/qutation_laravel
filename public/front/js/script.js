$ = jQuery.noConflict();

jQuery(function ($) {
    "use strict";

    /* ===================================
            Scroll
    ====================================== */

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 220) {
            // Set position from top to add class
            $("header").addClass("header-appear");
        } else {
            $("header").removeClass("header-appear");
        }
    });

    $(".progress-bar").each(function () {
        $(this).appear(function () {
            $(this).animate({ width: $(this).attr("aria-valuenow") + "%" }, 3000);
        });
    });

    $(".count").each(function () {
        $(this).appear(function () {
            $(this)
                .prop("Counter", 0)
                .animate(
                    {
                        Counter: $(this).text(),
                    },
                    {
                        duration: 3000,
                        easing: "swing",
                        step: function (now) {
                            $(this).text(Math.ceil(now));
                        },
                    }
                );
        });
    });

    //scroll to appear
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 500) $(".scroll-top-arrow").fadeIn("slow");
        else $(".scroll-top-arrow").fadeOut("slow");
    });

    // fixing bottom nav to top on scrolliing
    var $fixednav = $(".bottom-nav");
    $(window).on("scroll", function () {
        var $heightcalc = $(window).height() - $fixednav.height();
        if ($(this).scrollTop() > $heightcalc) {
            $fixednav.addClass("navbar-bottom-top");
        } else {
            $fixednav.removeClass("navbar-bottom-top");
        }
    });

    //Click event to scroll to top
    $(document).on("click", ".scroll-top-arrow", function () {
        $("html, body").animate({ scrollTop: 0 }, 100);
        return false;
    });

    //scroll sections
    if ($("body").hasClass("intrective")) {
        $(".scroll").on("click", function (event) {
            event.preventDefault();
            $("html,body").animate(
                {
                    scrollTop: $(this.hash).offset().top,
                },
                100
            );
        });
    } else {
        $(".scroll").on("click", function (event) {
            event.preventDefault();
            $("html,body").animate(
                {
                    scrollTop: $(this.hash).offset().top - 60,
                },
                100
            );
        });
    }

    /* ===================================
       Side Menu
   ====================================== */
    if ($("#sidemenu_toggle").length) {
        $("#sidemenu_toggle").on("click", function () {
            $(".pushwrap").toggleClass("active");
            $(".side-menu").addClass("side-menu-active"), $("#close_side_menu").fadeIn(700);
        }),
            $("#close_side_menu").on("click", function () {
                $(".side-menu").removeClass("side-menu-active"), $(this).fadeOut(200), $(".pushwrap").removeClass("active");
            }),
            $(".side-nav .navbar-nav .nav-link").on("click", function () {
                $(".side-menu").removeClass("side-menu-active"), $("#close_side_menu").fadeOut(200), $(".pushwrap").removeClass("active");
            }),
            $("#btn_sideNavClose").on("click", function () {
                $(".side-menu").removeClass("side-menu-active"), $("#close_side_menu").fadeOut(200), $(".pushwrap").removeClass("active");
            });
    }

    if ($(".side-right-btn").length) {
        $(".side-right-btn").click(function () {
            $(".navbar.navbar-right").toggleClass("show");
        }),
            $(".navbar.navbar-right .navbar-nav .nav-link").click(function () {
                $(".navbar.navbar-right").toggleClass("show");
            });
    }

    /* =====================================
          Wow
     ======================================== */

    // if ($(window).width() > 767) {
    //     var wow = new WOW({
    //         boxClass: "wow",
    //         animateClass: "animated",
    //         offset: 0,
    //         mobile: false,
    //         live: true,
    //     });
    //     new WOW().init();
    // }
});

/* Custom Core */
$("form").submit(function () {
    $('.spinner-border').removeClass('d-none');
    $(this).find(":submit").prop('disabled', true);
    $("*").css("cursor", "wait");
});