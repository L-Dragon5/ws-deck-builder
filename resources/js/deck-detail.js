/**
 * Document Ready Function
 */
$(document).ready(function() {
    if($('#deck-detail-list').length > 0) {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/decks/list',
            type: 'POST',
            data: {
                'deck-detail': JSON.parse($('#deck-detail-list').text())
            },
            success: function(data, textStatus, xhr) {
                $('#deck-detail-list').html(data).show();
            }
        });
    }
});