var $ = require('jquery');

var CarouselClass = function (carousel) {
    this.carousel = carousel;
    this.pictures = this.carousel.find('[data-carousel-item]')
    this.nextBtn = this.carousel.find('[data-carousel-next]');
    this.prevBtn = this.carousel.find('[data-carousel-prev]');
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

    this.carousel.on('click', function (e) {
        that.close(e.target)
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
    }

};

CarouselClass.prototype.showItem = function (index) {

    var min = 0;
    var max = this.pictures.length;

    this.currentIndex = index;
    this.pictures.hide();
    this.pictures.eq(this.currentIndex).show();

    console.log('min', min);
    console.log('max', max);
    console.log('this.currentIndex', this.currentIndex);
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

    this.carousel.show();
}

module.exports = CarouselClass;
