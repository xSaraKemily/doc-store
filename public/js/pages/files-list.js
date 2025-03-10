import {getCsrfToken} from "../helpers.js";

$('.open-delete-modal-button').click(function () {
    $('#idToDeleteInput').val($(this).data('file-id'));
});

$('#deleteModal').on('hidden.bs.modal', function (e) {
    clearIdToDelete();
});

$("#deleteButton").click(function() {
    deleteFile();
});

function deleteFile() {
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
