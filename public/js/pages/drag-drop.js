import {getCsrfToken, getFormattedFileSize, truncateString} from "../helpers.js";

const dropzoneEmptyText = 'Drag & Drop files here or click to select';

const dropZone = $("#dropZone");
const fileInput = $("#fileInput");

$("#clearSelectionButton").click(function(event) {
    event.stopPropagation();
    clearFileInput()
});

$("#uploadButton").click(function(event) {
    event.preventDefault();

    if (fileInput[0].files?.length) {
       uploadFiles();
   }
});

dropZone.click(function() {
   if (isAllowedAttach()) {
       fileInput[0].click();
   }
});

dropZone.on("dragover dragenter", function(event) {
    event.preventDefault();

    $(this).addClass("dragover");
});


dropZone.on("dragleave", function() {
    $(this).removeClass("dragover")
});

dropZone.on("drop", function(event) {
    event.preventDefault();

    if (isAllowedAttach()) {
        $(this).removeClass("dragover");

        fileInput[0].files = event.originalEvent.dataTransfer.files;

        setupDropzoneContainer()
    }
});

fileInput.on('change', function() {
    setupDropzoneContainer()
});

function setupDropzoneContainer() {
    const files = fileInput[0].files;
    const filesLength = files.length;

    let dropzoneText = dropzoneEmptyText;

    if (filesLength > 0) {
        dropZone.addClass("dragover");
        $("#uploadButton, #clearSelectionButton").removeClass("d-none");

        const fileNames = [];

        for (let i = 0; i < (filesLength > 4 ? 3 : filesLength); i++) {
            fileNames.push(`${truncateString(files[i].name, 20)} (${getFormattedFileSize(files[i].size)})`)
        }

        const text = filesLength > 4 ? `+ ${filesLength - 4} file(s)` : '';

        dropzoneText = `<b>Selected files:</b> ${fileNames.join(', ')} ${text}`;
    } else {
        dropZone.removeClass("dragover");
        $("#uploadButton, #clearSelectionButton").addClass("d-none");
    }

    dropZone.find('span').html(dropzoneText);
}

function clearFileInput() {
    fileInput.val('');
}

function uploadFiles() {
    const files = fileInput[0].files;

    let formData = new FormData();

    for (let i = 0; i < fileInput[0].files.length; i++) {
        formData.append('files[]', files[i]);
    }

    $.ajax({
        type: 'POST',
        url: '/files',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': getCsrfToken()
        },
        success: function(response) {
            alert(response.message);

            clearFileInput();
            setupDropzoneContainer();
        },
        error: function(error) {
            alert('Erro ao enviar arquivos.');
        }
    });
}

function isAllowedAttach() {
    return !fileInput[0].files?.length;
}
