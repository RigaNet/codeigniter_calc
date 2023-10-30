    $('#calc_form').submit(function(e) {
        e.preventDefault();
        var FormData = $(this).serialize();
     
        $.ajax({
           url: '',
           type: 'POST',
           data: {
                action: 'CalcFormHandler',
                FormData: FormData
            },
            dataType: 'json',
            error: function() {
               alert('Something is wrong');
            },
            success: function(data) {
                $('#result').html(data['result']);
            }
        });
    });