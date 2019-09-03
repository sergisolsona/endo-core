
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('metismenu');
require('jquery-slimscroll');
require('jasny-bootstrap/js/fileinput');
require('./components/flot/jquery.flot');
require('./components/flot/jquery.flot.tooltip.min');
require('./components/flot/jquery.flot.spline');
require('./components/flot/jquery.flot.pie');
require('./components/pace/pace');
require('./components/admin');
require('fullcalendar');
require('./components/fullcalendar/es');
require('footable');
require('bootstrap-3-typeahead');
require('chosen-js');
window.toastr = require('toastr');
require('spectrum-colorpicker');
window.getSlug = require('speakingurl');
require('jquery-slugify');


require('./components/widget-updater');
require('./components/date-picker');
require('./components/explore-reports');

require('./components/listeners');

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});