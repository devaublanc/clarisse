var $ = require('jquery');

var FeedClass = function (feed) {
    this.feed = feed;
    this.dataFeed = {};
    this.btnRefresh = $('[data-btn-refresh-feed]');

    if (this.feed instanceof jQuery && this.feed.length > 0) {
        this.dataFeed = this.feed.data();
        this.bind();
    }
    console.log(this);

};

FeedClass.prototype.bind = function () {
    var that = this;

    this.btnRefresh.on('click', function () {
        that.refresh();
    });
};

FeedClass.prototype.refresh = function () {
    console.log('refresh');
    $.ajax({
        url: this.dataFeed.url,
        success: function (datas) {
            console.log('success', datas);
        },
        error: function (e) {
            console.log('error', e);
        }
    })
};

module.exports = FeedClass;