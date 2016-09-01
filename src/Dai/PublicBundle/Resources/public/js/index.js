var Isotope = require('isotope-layout');
global.$ = require('jquery');

// modules
var ItemClass = require('./modules/ItemClass.js');
var FeedClass = require('./modules/FeedClass.js');
var CarouselClass = require('./modules/CarouselClass.js');

new FeedClass($('[data-feed]'))

$(window).load(function() {

    var carousel = new CarouselClass($('[data-carousel]'));

    $('[data-item]').each(function () {
        new ItemClass($(this));
        $(this).on('click', function () {
            carousel.showItem($(this).index());
        })
    });

});
