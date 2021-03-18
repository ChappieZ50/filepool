const Uppy = require('@uppy/core');
const XHRUpload = require('@uppy/xhr-upload');
const Dashboard = require('@uppy/dashboard');

$(document).ready(function () {
    const uppy_note = $('#fpool_dropzone').attr('data-note'),
        uppy_drop_string = $('#fpool_dropzone').attr('data-drop'),
        uppy_browse_string = $('#fpool_dropzone').attr('data-browse'),
        uppy_maxFileSize = $('#fpool_dropzone').attr('data-max-size'),
        uppy_maxFile = $('#fpool_dropzone').attr('data-max-file'),
        uppy_file_types = $('#fpool_dropzone').attr('data-file-types');

    const uppy = new Uppy({
        debug: false,
        autoProceed: true,
        restrictions: {
            maxFileSize: parseInt(uppy_maxFileSize),
            maxNumberOfFiles: parseInt(uppy_maxFile),
            minNumberOfFiles: 1,
            allowedFileTypes: uppy_file_types.split(','),
        },
        locale: {
            strings: {
                dropPaste: uppy_drop_string,
                browse: uppy_browse_string,
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

