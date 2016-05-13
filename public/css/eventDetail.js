 $('eventPostForm').submit(function(event) {
 event.preventDefault();
 });

function createPost() {
        $.ajax({
        url: '/events/1', // Route that will handle the request; its job is to return us books.
                method: 'POST',
                dataType : 'html', // Kind of data we're expecting to get back
                data: { // Two pieces of data we'll send with the request
                        '_token': $('input[name=_token]').val(),
                        'event_post': $('#event_post').val(),
                        'event_id': $('#event_id').val(),
                },
                // What to do before each ajax
                beforeSend: function() {
                $('#posts').removeClass('error');
                },
                // What to do upon completion of a successful ajax call
                success: function(data) {
                $('#posts').html(data);
                },
                // What to do upon completion of an unsuccessful ajax call
                error: function() {
                $('#posts').html('Sorry, there was an error; your request could not be completed.');
                        $('#posts').addClass('error');
                }
        });
}