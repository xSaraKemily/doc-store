export function getFormattedFileSize(size) {
    let unit = 'bytes';
    let formattedSize = size;

    if (size >= 1024) {
        formattedSize = size / 1024;
        unit = 'KB';

        if (formattedSize >= 1024) {
            formattedSize = formattedSize / 1024;
            unit = 'MB';

            if (formattedSize >= 1024) {
                formattedSize = formattedSize / 1024;
                unit = 'GB';
            }
        }
    }

   return formattedSize.toFixed(2) + ' ' + unit;
}

export function truncateString(str, limit) {
    if (!str || !limit) {
        return str;
    }

    return str.length > limit ? str.substring(0, limit) + "..." : str;
}

export function getCsrfToken() {
    return $('meta[name="csrf-token"]').attr('content');
}
