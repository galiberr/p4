// We don't want the form to actually submit if the user hits the Enter key
$('form').submit(function(event) {
    event.preventDefault();
});

// The following anonymous function will trigger every time the key goes up
// in the search input; i.e. someone changes the search input.
$('#searchTerm').keyup(function() {

    // Set up the ajax call; see http://api.jquery.com/jquery.ajax for more details
    $.ajax({
        url: '/events/search', // Route that will handle the request; its job is to return us books.
        method: 'POST',
        dataType : 'html', // Kind of data we're expecting to get back
        data: { // Two pieces of data we'll send with the request
            '_token': $('input[name=_token]').val(),
            'searchTerm': $('#searchTerm').val()
        },
        // What to do before each ajax
        beforeSend: function() {
            $('#loading').show();
            $('#results').removeClass('error');
        },
        // What to do upon completion of a successful ajax call
        success: function(data) {
            $('#loading').hide();
            $('#results').html(data);
        },
        // What to do upon completion of an unsuccessful ajax call
        error: function() {
            $('#results').html('Sorry, there was an error; your request could not be completed.');
            $('#results').addClass('error');
        }

    });

});