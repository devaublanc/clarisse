var $ = require('jquery');

var PageClass = function () {
    this.linkProfil = $('[data-link-profil]');
    this.linkPortfolio = $('[data-link-portfolio]');
    this.linkContact = $('[data-link-contact]');
    $('[data-page-profil], [data-page-contact]').hide();
    this.bind();    
};

PageClass.prototype.bind = function () {
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

PageClass.prototype.changeColor = function (color) {
    $('body').removeClass('white brown blue')
    $('body').addClass(color);
};

PageClass.prototype.getPage = function (page) {
    $('[data-page]').hide();
    $('[data-page-' + page + ']').show();
};

module.exports = PageClass;