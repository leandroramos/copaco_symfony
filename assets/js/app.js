var $ = require('jquery');
require('bootstrap/dist/js/bootstrap.min.js');
require('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');

/* global */
jQuery(document).ready(function() {
    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
});
