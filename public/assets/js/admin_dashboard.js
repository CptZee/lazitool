
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

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});