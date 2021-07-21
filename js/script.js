$(document).ready(function() {
  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };

  // Collapse now if page is not at top
  navbarCollapse();

  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);


   // Activate scrollspy to add active class to navbar items on scroll
   $("body").scrollspy({ target: "#mainNav" });

  
  // Closes responsive menu when a scroll trigger link is clicked
  $(".js-scroll-trigger").click(function() {
    $(".navbar-collapse").collapse("hide");
  });


  // Smooth Scrolling
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').on("click", function(event) {
    if (this.hash !== "") {
      event.preventDefault();

      const hash = this.hash;

      $("html, body").animate(
        {
          scrollTop: $(hash).offset().top
        },
        800,
        function() {
          window.location.hash = hash;
        }
      );
    }
  });


  // Add Animation fromLeft & fromRight with scroll
  $(window).scroll(function() {
    let position = $(this).scrollTop();

    if (position >= 800) {
      $(".img-project").addClass("fromRight");
      $(".featured-text").addClass("fromLeft");
    } else {
      $(".img-project").removeClass("fromRight");
      $(".featured-text").removeClass("fromLeft");
    }
  });
});
