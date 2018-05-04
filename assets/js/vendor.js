var $ = require('jquery');

require('datatables.net-bs4')();
require('datatables.net-responsive-bs4')();

$(document).ready(function () {
    $(".table").DataTable({
        responsive: {
            details: true
        }
    });
});
