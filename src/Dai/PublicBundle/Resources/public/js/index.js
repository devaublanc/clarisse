var Isotope = require('isotope-layout');
global.$ = require('jquery');


var currentColor = 0;

var Item = function (item) {
    this.item = item;
    this.needResize = false;

    this.build();
};

Item.prototype.pickColor = function () {
    var colors = [
        '#FCCC7A',
        '#9ECFA9',
        '#4F77B9',
        '#F29A94',
        '#B6D5E0',
    ];

    if (currentColor === colors.length - 1) {
        currentColor = 0;
    } else {
        currentColor += 1;
    }

    return colors[currentColor];
};

Item.prototype.build = function () {

    var data = this.item.data();

    this.item.prepend(this.getMask(data));
    this.needResize = false;
    this.bind();
};

Item.prototype.getMask = function (data) {

    var mask;
    this.item.find('.isotope__item__mask').remove();    
    
    mask = $('<div>').addClass('isotope__item__mask')
        .attr('data-mask', '')
        .css('background-color', this.pickColor())
        .hide();

    mask.css({
        'height': this.item.find('img').height(),
        'width': this.item.find('img').width(),
        'margin-left': '30px',
        'margin-top': '30px',
    });

    mask.append(
        $('<div>').addClass('isotope__item__mask__content')
        .append(
            $('<h2>').addClass('isotope__item__mask__title animated fadeIn').text(data.title)
        )
        .append(
            $('<div>').addClass('isotope__item__mask__separator')
        )
        .append(
            $('<p>').addClass('isotope__item__mask__paragraph animated fadeInUp').text(data.category)
        )
        .append(
            $('<p>').addClass('isotope__item__mask__paragraph animated fadeInUp').text(data.reference)
        )
    );

    return mask;
};

Item.prototype.bind = function () {
    var that = this;

    this.item.hover(
        function() {
            if (that.needResize) {
                that.build();
            }
            $(this).find('[data-mask]').stop(true, false).fadeIn(400);
        }, function() {
            $(this).find('[data-mask]').stop(true, false).fadeOut(400);
        }
    );

    $(window).on('resize', function () {
        that.needResize = true;
    });
};

var Page = function () {
    this.linkProfil = $('[data-link-profil]');
    this.linkPortfolio = $('[data-link-portfolio]');
    this.linkContact = $('[data-link-contact]');
    $('[data-page-profil], [data-page-contact]').hide();
    this.bind();    
};

Page.prototype.bind = function () {
    var that = this;

    this.linkPortfolio.on('click', function (e) {
        e.preventDefault();
        that.changeColor('white');
        that.getPage('portfolio');
    });

    this.linkProfil.on('click', function (e) {
        e.preventDefault();
        that.changeColor('blue');
        that.getPage('profil');
    });

    this.linkContact.on('click', function (e) {
        e.preventDefault();
        that.changeColor('brown');
        that.getPage('contact');
    });
};

Page.prototype.changeColor = function (color) {
    $('body').removeClass('white brown blue')
    $('body').addClass(color);
};

Page.prototype.getPage = function (page) {
    $('[data-page]').hide();
    $('[data-page-' + page + ']').show();
};

$(window).load(function() {
    var page = new Page();
    var container = document.querySelector('#isotope'); 
    var iso = new Isotope(container, {        
        itemSelector: '.isotope__item',
        layoutMode: 'masonry',
    });


    $('[data-item]').each(function () {
        new Item($(this));
    });

});