const Uppy = require('@uppy/core');
const XHRUpload = require('@uppy/xhr-upload');
const Dashboard = require('@uppy/dashboard');

const accepted_mimes = [
    ".avi",
];

$(document).ready(function () {
    const uppy_note = $('#fpool_dropzone').attr('data-note'),
        fpool_drop_string = $('#fpool_dropzone').attr('data-drop'),
        fpool_browse_string = $('#fpool_dropzone').attr('data-browse'),
        fpool_max_file_size = $('#fpool_dropzone').attr('data-max-size'),
        fpool_max_file = $('#fpool_dropzone').attr('data-max-file'),
        fpool_mimes = $('#fpool_dropzone').attr('data-mimes');

    new Uppy({
        debug: false,
        autoProceed: true,
        restrictions: {
            maxFileSize: parseInt(fpool_max_file_size),
            maxNumberOfFiles: parseInt(fpool_max_file),
            minNumberOfFiles: 1,
            allowedFileTypes: fpool_mimes.split(','),
        },
        locale: {
            strings: {
                dropPaste: fpool_drop_string,
                browse: fpool_browse_string,
            }
        }
    }).use(Dashboard, {
        target: "#fpool_dropzone",
        inline: true,
        width: 1000,
        note: uppy_note,
        replaceTargetContent: true,
        showProgressDetails: true,
    }).use(XHRUpload, {
        endpoint: "file/store",
        fieldName: 'file',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

