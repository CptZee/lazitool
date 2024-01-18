
$(document).ready(function () {
    $('#createTypeBtn').click(function () {
        console.log('Button clicked');
        $.ajax({
            url: 'http://localhost:8000/api/type',
            type: 'POST',
            data: $('#createTypeForm').serialize(),
            success: function (response) {
                console.log('Successful AJAX call');
                $('#responseModalBody').html(JSON.stringify(response, null, 2));
                $('#responseModal').modal('show');
            },
            error: function (error) {
                console.log('Failed AJAX call: ' + JSON.stringify(error, null, 2));
                $('#responseModalBody').html('Error: ' + JSON.stringify(error.responseJSON, null, 2));
                $('#responseModal').modal('show');
            }
        });
    });
});