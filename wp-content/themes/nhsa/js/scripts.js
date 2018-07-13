/*TODO: Add in the subpage block height check */


(function ($) { // Begin jQuery
    /* 1. Slick Nav

     */
    /* Add in the mobile Navigation */
//Clone both menus to keep them intact
       var combinedMenu = $('#menu-primary-navigation').clone();
       var secondMenu = $('#menu-utility-nav').clone();

       secondMenu.children('li').appendTo(combinedMenu);

       combinedMenu.slicknav({
           label: '',
           appendTo: '.mobile-nav'
       });


   /*


       $('#menu-primary-navigation').slicknav({
           label: '',
           appendTo: '.mobile-nav'
       });
*/

    /* Adding Slider Crap */
    $(".header-image .slides").slick({
        dots: true,
        fade: true,
        speed: 3000,
        autoplay: true,
        autoplaySpeed: 3000,
    });

    $(".block-featured-article .slides").slick({
        dots: true,
        fade: true,
        speed: 3000,
        autoplay: true,
        autoplaySpeed: 3000,
    });

    $(".block-members .slides").slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        prevArrow:"<img class='a-left control-c prev slick-prev' src='/wp-content/themes/nhsa/images/left-arrow.png'>",
        nextArrow:"<img class='a-right control-c next slick-next' src='/wp-content/themes/nhsa/images/right-arrow.png'>",


        variableWidth: true
    });
    $(".block-twitter .slides").slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        prevArrow:"<img class='a-left control-c prev slick-prev' src='/wp-content/themes/nhsa/images/left-arrow.png'>",
        nextArrow:"<img class='a-right control-c next slick-next' src='/wp-content/themes/nhsa/images/right-arrow.png'>"

    });




    /**** Sticky Nav ****/


        // grab the initial top offset of the navigation
    var stickyNavTop = $('.navigation-container').height();
    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var stickyNav = function () {
        var scrollTop = $(window).scrollTop(); // our current vertical position from the top
        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scrollTop > stickyNavTop) {
            $('.nav-sticky-container').addClass('sticky');
        } else {
            $('.nav-sticky-container').removeClass('sticky');
        }
    };

    stickyNav();
    // and run it again every time you scroll
    $(window).scroll(function () {
        stickyNav();
    });


    /* Menu */

    // dropped ie6 support

    $("#menu-primary-navigation").menu(
        {position: {my: "left bottom", at: "left top"}}
    );
    $( "#menu-primary-navigation-1" ).menu(
         { position: { my: "left bottom", at: "left top" } }
     );

    $("#archive-category").menu(
        {position: {my: "left bottom", at: "left top"}}
    );
    $("#archive-type").menu(
        {position: {my: "left bottom", at: "left top"}}
    );



    //////////////////////////////////////////////////////////////////////
    // leadership & capabilities grid
    //////////////////////////////////////////////////////////////////////

    var detailContainer = '<div class="detail"><div class="detail-content"></div></div>'
    $(document).ready(resizeFunction);
    $(window).resize(resizeFunction);
    function resizeFunction(){

        //grid on resize
        var w = $(window).width();
        if (typeof checkw == 'undefined') checkw = w;
        if (w!=checkw) {

            if(window.innerWidth >= 1024) {
                $(".grid-expand .cell").removeClass("active");
                $(".detail").remove();
                $("#leadership .cell:nth-of-type(4n), .cell:last-of-type").each(function() {
                    $(this).after(detailContainer);
                });
                $("#capabilities .cell:nth-of-type(3n), .cell:last-of-type").each(function() {
                    $(this).after(detailContainer);
                });
            } else if(window.innerWidth < 1024 && window.innerWidth > 740) {
                $(".grid-expand .cell").removeClass("active");
                $(".detail").remove();
                $(".cell:nth-of-type(3n), .cell:last-of-type").each(function() {
                    $(this).after(detailContainer);
                });
            } else if(window.innerWidth < 740) {
                $(".grid-expand .cell").removeClass("active");
                $(".detail").remove();
                $(".cell:nth-of-type(2n), .cell:last-of-type").each(function() {
                    $(this).after(detailContainer);
                });
            } else {
                $(".grid-expand .cell").removeClass("active");
                $(".detail").remove();
                $(".cell").each(function() {
                    $(this).after(detailContainer);
                });
            }

            checkw = w;
        }
    }

    //grid on load
    if(window.innerWidth >= 1024) {
        $(".grid-expand .cell").removeClass("active");
        $(".detail").remove();
        $(".cell:nth-of-type(3n), .cell:last-of-type").each(function() {
            $(this).after(detailContainer);
        });

    } else if(window.innerWidth < 1024 && window.innerWidth > 740) {
        $(".grid-expand .cell").removeClass("active");
        $(".detail").remove();
        $(".cell:nth-of-type(3n), .cell:last-of-type").each(function() {
            $(this).after(detailContainer);
        });
    } else if(window.innerWidth <= 740) {
        $(".grid-expand .cell").removeClass("active");
        $(".detail").remove();
        $(".cell:nth-of-type(2n), .cell:last-of-type").each(function() {
            $(this).after(detailContainer);
        });
    } else {
        $(".grid-expand .cell").removeClass("active");
        $(".detail").remove();
        $(".cell").each(function() {
            $(this).after(detailContainer);
        });
    }

    $(".grid-expand .staff").click(function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(".detail").removeClass("active").slideUp('slow');
            $(".detail").children(".detail-content").animate({opacity: "0"});
        } else {
            $(".grid-expand .cell").removeClass("active");
            $(this).addClass("active");
            $(this).nextAll(".detail").children(".detail-content").css("opacity", "0");
            $(this).nextAll(".detail:first").children(".detail-content").empty().append($(this).children(".detail-info").children().clone());
            if (!$(this).nextAll(".detail:first").hasClass("active")) {
                $(".detail").removeClass("active").slideUp('slow');
                $(".detail").children(".detail-content").animate({opacity: "0"});
                $(this).nextAll(".detail:first").addClass("active");
                $(this).nextAll(".detail:first").slideDown('slow');
            };
            $(this).nextAll(".detail:first").children(".detail-content").animate({opacity: "1"}, 600);
            $('html, body').animate({scrollTop:$(".cell.active").offset().top - 84}, 1000);
        }
        $(".grid-expand .detail .close").click(function() {
            $(".grid-expand .cell").removeClass("active");
            $(".detail").removeClass("active").slideUp('slow');
            $(".detail").children(".detail-content").animate({opacity: "0"});
        });
    });

var n =0;
    // $(".purpleoverlay").addEventListener("mouseenter", )



    $(".sub-purple-page")
        .mouseenter(function() {
            n += 1;
            $(this).addClass("over");
        })
        .mouseleave(function() {
            $(this).removeClass("over");

        });






    $(".members-page .filter-navigation a").click(function() {
if($(this).text() == "ALL"){
        $(".all_members .letter-group").show({ effect: "scale"});

    }else{
        $(".all_members .letter-group").hide({ effect: "scale"});
        $(".all_members .logo-group-"+$(this).text()).show({ effect: "scale"});

}
    return false;});



    $(window).on('load', function() {
        sameHeight('.subPage');
        sameHeight('.sub-purple-page');
        sameHeight('.update-item');
        sameHeight('.call-out');
        sameHeight('.matchContentHeight');
    });
        $( window ).on('resize', function() {
            sameHeight('.subPage');
            sameHeight('.sub-purple-page');
            sameHeight('.update-item');
            sameHeight('.call-out');
            sameHeight('.matchContentHeight');

        });


        function sameHeight(classname){
            /**********
             *
             * @type {string}
             */
            var subPageItemsHeight = 0;


            /**********
             *
             *
             */
            $(classname).each(function () {
                if ($(this).height() > subPageItemsHeight) {
                    subPageItemsHeight = $(this).height();
                }
                // console.log(classname + ":" + $(this).height());
            });
            $(classname).height(subPageItemsHeight);
            var subPageItemsHeight = '';

        }



})(jQuery); // end jQuery



