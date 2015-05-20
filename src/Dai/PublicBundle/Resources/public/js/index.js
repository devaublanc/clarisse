var Isotope = require('isotope-layout');
global.$ = require('jquery');

// modules
var ItemClass = require('./modules/ItemClass.js');
var PageClass = require('./modules/PageClass.js');
var FeedClass = require('./modules/FeedClass.js');

new FeedClass($('[data-feed]'))

$(window).load(function() {
    var page = new PageClass();
    

    $('[data-item]').each(function () {
        new ItemClass($(this));
    });


});