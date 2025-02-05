(function($) {

    // USE STRICT
    "use strict";

    var menukaartColorPicker = [
        '#mc_menu_title_bg_color',
        '#mc_menu_title_border_color',
        '#mc_menu_title_font_color',
        '#mc_food_course_bg_color',
        '#mc_food_course_border_color',
        '#mc_food_course_font_color',
        '#mc_food_font_color',
        '#mc_food_price_font_color',
    ];

    $.each(menukaartColorPicker, function(index, value) {
        $(value).wpColorPicker();
    });

    $('.menukaart-closebtn').on('click', function() {
        this.parentElement.style.display = 'none';
    });

})(jQuery);