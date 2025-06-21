$('.banner-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    prevArrow: ".prev-btn",
    nextArrow: ".next-btn",
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});
$('.financial-slider').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 650,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});
$('.review-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    autoplay: true,
    slidesToScroll: 1,
    prevArrow: ".prev-btn-rev",
    nextArrow: ".next-btn-rev",
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 650,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});
$('.stander-slider').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    prevArrow: ".prev-btn-stand",
    nextArrow: ".next-btn-stand",
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 650,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});
// const links = document.querySelectorAll(".list-item a");

// links.forEach(link => {
//     if (link.href.includes(window.location.href)) {
//         console.log(window.location.href);
//         console.log(link.href);


//         link.classList.add('active');
//     }
// });

   const currentURL = window.location.href;
//    console.log(currentURL)
   const navLinks = document.querySelectorAll('.list-item a'); // Assuming your links are in a <nav>
    // console.log(navLinks)
   navLinks.forEach(link => {
     if (link.href === currentURL) {
       link.classList.add('active');
     }
   });

$(".menu-open").click(function () {
    $(".navbar-menu").addClass("active")
})
$(".menu-close").click(function () {
    $(".navbar-menu").removeClass("active")
})
$(".search-open").click(function () {
    $(".search-global-area").addClass("active")
})
$(".search-close").click(function () {
    $(".search-global-area").removeClass("active")
})



const listItem = document.querySelectorAll(".review-detail-list li")
const listContent = document.querySelectorAll(".des-content")



listItem.forEach(item => {
    item.addEventListener("click", () => {
        listContent.forEach(content => {
            content.classList.remove("active");
        });
        listItem.forEach(itemActive => {
            itemActive.classList.remove("active");
        });

        listContent.forEach(content => {
            if (item.dataset.tab === content.dataset.content) {
                content.classList.add("active");
                item.classList.add("active");
            }
        });
    });
});


(function($) {

  // Reverse
  // =============================================
  $.fn.reverse = [].reverse;

  // jQuery Extended Family Selectors
  // =============================================
  $.fn.cousins = function(filter) {
    return $(this).parent().siblings().children(filter);
  };

  $.fn.piblings = function(filter) {
    return $(this).parent().siblings(filter);
  };

  $.fn.niblings = function(filter) {
    return $(this).siblings().children(filter);
  };

  // Update
  // =============================================
  $.fn.update = function() {
    return $(this);
  };

  // Dropdown
  // =============================================
  $.fn.dropdown = function(options) {

    // Store object
    var $this = $(this);

    // Settings
    var settings = $.extend({
      className : 'toggled',
    }, options);

    // Simplify variable names
    var className = settings.className;

    // List selectors
    var $ul = $this.find('ul'),
        $li = $this.find('li'),
        $a  = $this.find('a');

    // Menu selectors
    var $drawers = $a.next($ul),      // All unordered lists after anchors are drawers
        $buttons = $drawers.prev($a), // All anchors previous to drawers are buttons
        $links   = $a.not($buttons);  // All anchors that are not buttons are links

    // Toggle menu on-click
    $buttons.on('click', function() {
      var $button = $(this),
          $drawer = $button.next($drawers),
          $piblingDrawers = $button.piblings($drawers);

      // Toggle button and drawer
      $button.toggleClass(className);
      $drawer.toggleClass(className).css('height', '');

      // Reset children
      $drawer.find($buttons).removeClass(className);
      $drawer.find($drawers).removeClass(className).css('height', '');

      // Reset cousins
      $piblingDrawers.find($buttons).removeClass(className);
      $piblingDrawers.find($drawers).removeClass(className).css('height', '');

      // Animate height auto
      $drawers.update().reverse().each(function() {
        var $drawer = $(this);
        if($drawer.hasClass(className)) {
          var $clone = $drawer.clone().css('display', 'none').appendTo($drawer.parent()),
              height = $clone.css('height', 'auto').height() + 'px';
          $clone.remove();
          $drawer.css('height', '').css('height', height);
        }
        else {
          $drawer.css('height', '');
        }
      });
    });

    // Close menu
    function closeMenu() {
      $buttons.removeClass(className);
      $drawers.removeClass(className).css('height', '');
    }

    // Close menu after link is clicked
    $links.click(function() {
      closeMenu();
    });

    // Close menu when off-click and focus-in
    $(document).on('click focusin', function(event) {
      if(!$(event.target).closest($buttons.parent()).length) {
        closeMenu();
      }
    });
  };
})(jQuery);

$('#menu').dropdown();