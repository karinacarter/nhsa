jQuery(document).ready(function($) {

    $("ul.menu li.menu-item-has-children").hover(function(){
console.log("test");
        $(this).addClass("hover");
        $('ul:first',this).css('visibility', 'visible');

    }, function(){
        console.log("off");

        $(this).removeClass("hover");
        $('ul:first',this).css('visibility', 'hidden');

    });

    $("ul.dropdown li ul li:has(ul)").find("a:first").append(" &raquo; ");

});