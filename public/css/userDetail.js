 $('kjRatingForm').submit(function(event) {
 event.preventDefault();
 });

function createRating() {
        $.ajax({
        url: '/users/1', // Route that will handle the request; its job is to return us books.
                method: 'POST',
                dataType : 'html', // Kind of data we're expecting to get back
                data: { // Two pieces of data we'll send with the request
                        '_token': $('input[name=_token]').val(),
                        'kj_rating': $("input[type=radio][name=kj_rating]:checked").val(),
                        'kj_comment': $('#kj_comment').val(),
                        'kj_id': $('#kj_id').val(),
                },
                // What to do before each ajax
                beforeSend: function() {
                $('#ratings').removeClass('error');
                },
                // What to do upon completion of a successful ajax call
                success: function(data) {
                $('#ratings').html(data);
                },
                // What to do upon completion of an unsuccessful ajax call
                error: function() {
                $('#ratings').html('Sorry, there was an error; your request could not be completed.');
                        $('#posts').addClass('error');
                }
        });
}