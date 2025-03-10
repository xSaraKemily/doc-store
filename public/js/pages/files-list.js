import {getCsrfToken} from "../helpers.js";

$('.open-delete-modal-button').click(function () {
    console.log($(this).data('file-id'))
    $('#idToDeleteInput').val($(this).data('file-id'));
    console.log( $('#idToDeleteInput').val());
});

$('#deleteModal').on('hidden.bs.modal', function (e) {
    console.log('esconde modal')
    clearIdToDelete();
});

$("#deleteButton").click(function() {
    deleteFile();
});

function deleteFile() {
    console.log('deleteFile ', $('#idToDeleteInput').val());

    $.ajax({
        type: 'DELETE',
        url: '/files/' + $('#idToDeleteInput').val(),
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': getCsrfToken()
        },
        success: () => {
            clearIdToDelete();

            alert('File successfully deleted.');

            location.reload();
        },
        error: () => alert('Failed to delete file.')
    });
}

function clearIdToDelete() {
    $('#idToDeleteInput').val('');
}
