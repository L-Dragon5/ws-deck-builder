
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Dependencies
require('./bootstrap');
require('shufflejs');

// Javascript files
require('./cards.js');
require('./decks.js');
require('./deck-detail.js');

// Global ready javascript
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Remove overlay once everything is finished loading
    $('.loading-overlay').fadeOut('slow', function() {
        $(this).remove();
    });
});