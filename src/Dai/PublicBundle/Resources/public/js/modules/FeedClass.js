var $ = require('jquery');
var ItemClass = require('./ItemClass.js');
var jQBridget = require('jquery-bridget');
var Isotope = require('isotope-layout');

$.bridget('isotope', Isotope);

var FeedClass = function (feed) {
    this.feed = feed;
    this.dataFeed = {};
    this.btnRefresh = $('[data-btn-refresh-feed]');
    this.page = 2;

    if (this.feed instanceof $ && this.feed.length > 0) {
        this.dataFeed = this.feed.data();
        this.build();
        this.bind();
    }    
};

FeedClass.prototype.build = function () {
    var that = this;

    $(window).on({
        load : function() {
            that.feed.isotope({
                itemSelector: '.isotope__item',
                layoutMode: 'masonry',
                resizesContainer: true
            });
        }
    });
};

FeedClass.prototype.bind = function () {
    var that = this;

    this.btnRefresh.on('click', function () {
        that.refresh();
    });
};

FeedClass.prototype.refresh = function () {
    var that = this;

    $.ajax({
        url: this.dataFeed.url,
        data: {
            page: that.page 
        },
        success: function (datas) {            
            if (!datas || datas === 'ko') {
                that.btnRefresh.hide()
            } else {
                that.page += 1;
                $.each(datas, function (index, work) {
                    var item = new ItemClass($(work));
                    that.feed.isotope('insert', item.getTemplate());
                    item.fixSizeMask();
                });
                that.btnRefresh.show();
            }
        },
        error: function (e) {
            console.log('error', e);
        }
    })
};

module.exports = FeedClass;