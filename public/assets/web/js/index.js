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
