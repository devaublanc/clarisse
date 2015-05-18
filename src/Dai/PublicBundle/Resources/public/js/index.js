var Isotope = require('isotope-layout');
global.$ = require('jquery');

// modules
var ItemClass = require('./modules/ItemClass.js');
var PageClass = require('./modules/PageClass.js');
var FeedClass = require('./modules/FeedClass.js');

$(window).load(function() {
    var page = new PageClass();
    var container = document.querySelector('#isotope'); 
    var iso = new Isotope(container, {        
        itemSelector: '.isotope__item',
        layoutMode: 'masonry',
    });

    $('[data-item]').each(function () {
        new ItemClass($(this));
    });

    new FeedClass($('[data-feed]'))

});