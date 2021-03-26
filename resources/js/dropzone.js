import Swal from "sweetalert2";

const Uppy = require('@uppy/core');
const XHRUpload = require('@uppy/xhr-upload');
const Dashboard = require('@uppy/dashboard');

$(document).ready(function () {

    const uppy_note = $('#fpool_dropzone').attr('data-note'),
        fpool_drop_string = $('#fpool_dropzone').attr('data-drop'),
        fpool_browse_string = $('#fpool_dropzone').attr('data-browse'),
        fpool_max_file_size = $('#fpool_dropzone').attr('data-max-size'),
        fpool_max_file = $('#fpool_dropzone').attr('data-max-file'),
        fpool_mimes = $('#fpool_dropzone').attr('data-mimes');

    const uppy = new Uppy({
        debug: false,
        autoProceed: false,
        meta: {
            password: '',
            expire: '1', // 1 7 15 30 Never
            recaptcha: '',
        },
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
        },
        onBeforeFileAdded: () => {
            let recaptcha = '';
            const svgLock = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>';
            const premium = window.filepool.premium ? "<option value='never' selected>Never</option>" : "";
            const html = "<h4>Please fill the settings for this files</h4>" +
                "<div class='form-group mt-3'>" +
                "<select class='form-control' id='expire_files'>" +
                "<option value='1'>1 Days</option>" +
                "<option value='7'>7 Days</option>" +
                "<option value='15'>15 Days</option>" +
                "<option value='30'>30 Days</option>" + premium +
                "</select>" +
                "</div>" +
                " <div class='input-group mt-3 mb-3'>" +
                "<div class='input-group-prepend'>" +
                "<span class='input-group-text' id='basic-addon1'>" + svgLock + "</span>\n" +
                "</div>" +
                "<input type='password' class='form-control' placeholder='Password for files' id='password_files'>" +
                "</div>" +
                "<div id='swal_recaptcha'></div>";

            Swal.fire({
                title: 'Upload Files',
                html,
                showCancelButton: true,
                confirmButtonText: 'Upload Files',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: function () {
                    if (window.filepool.g_recaptcha_site_key.length > 0 && !window.filepool.auth) {
                        grecaptcha.render('swal_recaptcha', {
                            'sitekey': window.filepool.g_recaptcha_site_key
                        })
                    }
                },
                preConfirm: function () {
                    if (window.filepool.g_recaptcha_site_key.length > 0 && !window.filepool.auth) {
                        if (grecaptcha.getResponse().length === 0) {
                            Swal.showValidationMessage(`Please verify that you're not a robot`)
                        } else {
                            recaptcha = grecaptcha.getResponse();
                        }
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const password = $('#password_files').val(),
                        expire = $('#expire_files').val();

                    uppy.setMeta({
                        password,
                        expire,
                        "g-recaptcha-response": recaptcha,
                    });
                    $('.uppy-c-btn').trigger('click');
                } else {
                    uppy.reset();
                }
            })
        },
    }).use(Dashboard, {
        target: "#fpool_dropzone",
        inline: true,
        width: 1000,
        note: uppy_note,
        replaceTargetContent: true,
        showProgressDetails: true,
        theme: 'dark',
    }).use(XHRUpload, {
        endpoint: "file/store",
        fieldName: 'file',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        getResponseData: (responseText) => {
            var parsedResponse = {};
            try {
                parsedResponse = JSON.parse(responseText);
            } catch (err) {
                Swal.fire({
                    title: "Something gone wrong, please try again.",
                    icon: "error",
                    cancelButtonText: 'Close',
                }).then(function () {
                    window.location.reload();
                });
            }

            return parsedResponse;
        },
        getResponseError(responseText) {
            let response = JSON.parse(responseText);
            Swal.fire({
                title: response.message,
                icon: "error",
                cancelButtonText: 'Close',
            }).then(function () {
                window.location.reload();
            });
            return new Error(response.message)
        },
    });

});

