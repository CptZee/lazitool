
$(document).ready(function () {
    $('#createTypeBtn').click(function () {
        $('#loadingModal').modal('show');
        $.ajax({
            url: 'http://localhost:8000/api/type',
            type: 'POST',
            data: $('#createTypeForm').serialize(),
            success: function (response) {
                $('#responseModalBody').html(response.message);
                $('#loadingModal').modal('hide');
                $('#responseModal').modal('show');
            },
            error: function (error) {
                $('#responseModalBody').html('Error: ' + error.responseJSON.message);
                $('#loadingModal').modal('hide');
                $('#responseModal').modal('show');
            }
        });
    });
});