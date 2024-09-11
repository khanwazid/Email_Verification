

$(document).ready(function() {
    $('#search').on('keyup', function() {
        var query = $(this).val();
        $.ajax({
            url: '/profiles/fetch',
            type: 'GET',
            data: { query: query },
            success: function(data) {
                $('#profiles-table').html(data);
            }
        });
    });
});