$(document).ready(function() {
    $('#filter-series').on('change', function() {
        window.location.replace("/cards?series=" + this.value);
    });
});