/*global Ember, Todos */
module.exports = (function($, _, s, honeyPot) {
    'use strict';

    var App = exports.honeyPot.App;
    App.Router.map(function() {
        this.resource('query', {path: '/'})
    });

})(jQuery, _, s, honeyPot)