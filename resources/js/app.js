import axios from "axios";

require('./bootstrap');


window.$ = window.jQuery = require('jquery');
import '@popperjs/core';
import 'bootstrap/dist/js/bootstrap.bundle'
import Clipboard from "clipboard/dist/clipboard";
import Swal from 'sweetalert2'
import imagesLoaded from 'imagesloaded';

const feather = require('feather-icons');
$(document).ready(function () {
    /* Replacing Icons */
    feather.replace();

    /* Windows Sizes */
    $(window).on('resize', function () {
        if (window.matchMedia('(max-width: 992px)').matches) {
            $('.login-items .fpool-move-btn').appendTo('.navbar')
        } else {
            if ($('.login-items .fpool-move-btn').length === 0) {
                $('.navbar .fpool-move-btn').appendTo('.login-items')
            }
        }

    }).resize();


    /* Copy File Link */
    let clipboard = new Clipboard('#copy');

    function setTooltip(btn, message) {
        $(btn).tooltip('hide')
            .attr('data-original-title', message)
            .tooltip('show');
    }

    function hideTooltip(btn) {
        setTimeout(function () {
            $(btn).tooltip('hide');
        }, 1000);
    }


    clipboard.on('success', function (e) {
        setTooltip(e.trigger, 'File Copied!');
        hideTooltip(e.trigger);
    });

    clipboard.on('error', function (e) {
        setTooltip(e.trigger, 'Failed!');
        hideTooltip(e.trigger);
    });

    /* Delete File */
    $('#delete').on('click', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "This file will delete forever.",
            icon: "error",
            confirmButtonText: "Yes, Delete it",
            cancelButtonText: "Cancel",
            showCancelButton: true,
            confirmButtonColor: '#e34346',
        }).then(result => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "File successfully deleted.",
                    icon: "success",
                })
            }
        });
    });

    function parse_errors(errors, el = $('#user_profile_errors')) {
        Object.keys(errors).forEach(key => {
            let value = errors[key][0];
            el.html(value + "<br>");
        });
        el.show();
    }

    /* type: "success","error" */
    function show_swal(title, type = 'success') {
        if (type === "error") {
            Swal.fire({
                title: title,
                icon: "error",
                cancelButtonText: 'Close',
            }).then(function () {
                window.location.reload();
            });

        } else {
            Swal.fire({
                title,
                icon: "success",
                cancelButtonText: 'Close',
            }).then(function () {
                window.location.reload();
            });
        }
    }


    /* Preview Image */
    function preview_image(el, preview = 'preview_image') {
        if (el.files && el.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + preview).attr('src', e.target.result);
            };

            reader.readAsDataURL(el.files[0]); // convert to base64 string
        }
    }

    $('input#user_avatar').on('change', function () {
        preview_image(this, 'user_avatar_preview');
    });

    /* User Update */
    $('#user_update').on('click', function () {
        const username = $('#user_username').val(),
            email = $('#user_email').val();

        setTimeout(function () {
            axios.put(window.location.href + '/update', {
                username, email,
            }).then(response => {
                if (response.data.status) {
                    show_swal("Your profile successfully updated.")
                }
            }, error => parse_errors(error.response.data.errors));
        }, 500);
    });

    $('#user_update_password').on('click', function () {
        const current_password = $('#user_current_password').val(),
            password = $('#user_new_password').val(),
            password_confirmation = $('#user_new_password_confirmation').val();

        setTimeout(function () {
            axios.put(window.location.href + '/update/password', {
                current_password, password, password_confirmation
            }).then(response => {
                if (response.data.status) {
                    show_swal("Your password successfully updated.");
                }
            }, error => parse_errors(error.response.data.errors));
        }, 500);
    });

    $('#user_update_avatar').on('click', function () {
        let formData = new FormData();
        let avatar = document.querySelector('#user_avatar');
        formData.append("avatar", avatar.files[0]);
        formData.append("_method", "PUT");
        setTimeout(function () {
            axios.post(window.location.href + '/update/avatar', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                if (response.data.status) {
                    show_swal("Your avatar successfully updated.");
                }
            }, error => {
                parse_errors(error.response.data.errors);
                let preview = $('#user_avatar_preview');
                preview.attr('src', preview.attr('data-original'));
            });
        }, 500);
    });

    /* File Delete */

    $(document).on('click', '#file_delete', function () {
        const id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "This file will be deleted",
            icon: "info",
            confirmButtonText: "Yes,Delete",
            cancelButtonText: "Cancel",
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.file_destroy + '/' + id).then(response => {
                    if (response.data.status) {
                        show_swal("Your file successfully deleted.");
                    } else {
                        show_swal('Something gone wrong, please try again.', 'error');
                    }
                }, () => {
                    show_swal('Something gone wrong, please try again.', 'error');
                });
            }
        });

    });

    $('#user_delete_avatar').on('click', function () {
        Swal.fire({
            title: "Are you sure?",
            text: "Your avatar will be deleted",
            icon: "info",
            confirmButtonText: "Yes,Delete",
            cancelButtonText: "Cancel",
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.location.href + '/destroy/avatar').then(response => {
                    if (response.data.status) {
                        show_swal("Your avatar successfully deleted.");
                    }
                }, () => {
                    show_swal('Something gone wrong, please try again.', 'error');
                });
            }
        });

    });

    /* Copy Snap */
    let copy_snap = new Clipboard('#click_to_copy', {
        text: function (e) {
            return $(e).closest('.fpool-copy-container').find('#copy_content').html();
        }
    });

    function clickToCopyAction(el, success = true) {
        let color = success ? '#3cb371' : '#dc143c';
        let tt = success ? 'Text Copied!' : 'ERROR!';
        let text = $(el).text();
        $(el).html('<span style="color:' + color + '">' + tt + '</span>');
        $(el).show();
        setTimeout(function () {
            $(el).html(text);
            $(el).hide();
        }, 1000)
    }

    copy_snap.on('success', function (e) {
        e.clearSelection();
        clickToCopyAction(e.trigger);
    });

    copy_snap.on('error', function (e) {
        e.clearSelection();
        clickToCopyAction(e.trigger, false);
    });
    /* Statistics of files */
    if ($('#file_chart').length) {
        let options = {
            series: [{
                name: "Files",
                data: Object.values(window.file_chart)
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: true
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },
            yaxis: {
                labels: {
                    formatter: val => val.toFixed(0)
                }
            }
        };

        let chart = new ApexCharts(document.querySelector("#file_chart"), options);

        chart.render();
    }

    /* Fpool images loading */
    if ($('.fpool-images-wrapper').length) {
        imagesLoaded(document.querySelector('.fpool-images-wrapper'), function () {
            $('.fpool-spinner').fadeOut();
            $('.fpool-images-wrapper').fadeIn();
        });
    }
});
