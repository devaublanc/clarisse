var $ = require('jquery');
//lol
var CarouselClass = function (carousel) {
    this.carousel = carousel;
    this.pictures = this.carousel.find('[data-carousel-item]')
    this.nextBtn = this.carousel.find('[data-carousel-next]');
    this.prevBtn = this.carousel.find('[data-carousel-prev]');
    this.closeBtn = this.carousel.find('[data-carousel-close]');
    this.carousel.hide();
    this.bind();
    this.currentIndex = 0;
};

CarouselClass.prototype.bind = function () {
    var that = this;

    this.prevBtn.on('click', function () {
        that.prev();
    });

    this.nextBtn.on('click', function () {
        that.next();
    });

    this.closeBtn.on('click', function (e) {
        that.carousel.hide();
    })
};

CarouselClass.prototype.prev = function () {
    this.showItem(this.currentIndex - 1);
};

CarouselClass.prototype.next = function () {
    this.showItem(this.currentIndex + 1);
};

CarouselClass.prototype.close = function (target) {
    if (target === this.carousel[0]) {
        this.carousel.hide();
        this.carousel.css({opacity: 0});
    }

};

CarouselClass.prototype.showItem = function (index) {

    var min = 0;
    var max = this.pictures.length;

    this.currentIndex = index;
    this.pictures.hide();
    this.pictures.eq(this.currentIndex).show();


    if (this.currentIndex + 1 >= max) {
        this.nextBtn.hide();
    } else {
        this.nextBtn.show();
    }

    if (this.currentIndex <= min) {
        this.prevBtn.hide();
    } else {
        this.prevBtn.show();
    }

    this.carousel.css({opacity: 1});
    this.carousel.show();
}

module.exports = CarouselClass;
