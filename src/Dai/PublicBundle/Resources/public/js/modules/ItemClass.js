var $ = require('jquery');
var Isotope = require('isotope-layout');
global.currentColor = 0;

var ItemClass = function (item) {
    this.item = item;
    this.needResize = false;

    this.build();
};

ItemClass.prototype.pickColor = function () {
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

ItemClass.prototype.getTemplate = function () {
    return this.item;
};

ItemClass.prototype.build = function () {

    var data = this.item.data();

    this.item.prepend(this.getMask(data));
    this.needResize = false;
    this.bind();
};

ItemClass.prototype.getMask = function (data) {

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



ItemClass.prototype.fixSizeMask = function () {
    this.item.find('[data-mask]').css({
        'height': this.item.find('img').height(),
        'width': this.item.find('img').width(),
        'margin-left': '30px',
        'margin-top': '30px',
    });
};


ItemClass.prototype.bind = function () {
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

module.exports = ItemClass;