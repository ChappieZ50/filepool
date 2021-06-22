require('./bootstrap');
import axios from 'axios';
import 'bootstrap/dist/js/bootstrap.bundle';
import Swal from 'sweetalert2'

const feather = require('feather-icons');
$(document).ready(function () {
    feather.replace();

    /* Ban / Unban */
    $(document).on('click', '#ban', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: window.filepool.trans.title,
            text: window.filepool.trans.user_ban,
            icon: "error",
            confirmButtonText: window.filepool.trans.confirm_ban,
            cancelButtonText: window.filepool.trans.cancel,
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.post(window.routes.user_status, {
                    status: false,
                    user: id,
                }).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: response.data.message,
                            icon: "success",
                            cancelButtonText: window.filepool.trans.close,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message,
                            icon: "error",
                            cancelButtonText: window.filepool.trans.close,
                        });
                    }
                });
            }
        });
    });
    $(document).on('click', '#unban', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: window.filepool.trans.title,
            text: window.filepool.trans.user_banned,
            icon: "info",
            confirmButtonText: window.filepool.trans.confirm_unban,
            cancelButtonText: window.filepool.trans.cancel,
            showCancelButton: true,
            confirmButtonColor: '#19d895',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.post(window.routes.user_status, {
                    status: true,
                    user: id,
                }).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: response.data.message,
                            icon: "success",
                            cancelButtonText: window.filepool.trans.close,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message,
                            icon: "error",
                            cancelButtonText: window.filepool.trans.close,
                        });
                    }
                });
            }
        });
    });

    /* Add New User Modal */
    $('#new_user_modal #add_new_user').on('click', function () {
        let this_button = $(this),
            button_text = this_button.text(),
            alert = $('#new_user_modal #non_error');

        alert.hide();
        this_button.prop('disabled', true);
        this_button.html('<i class="mdi mdi-loading mdi-spin"></i>');

        $('#new_user_modal input').removeClass('is-invalid');
        $('#new_user_modal .invalid-feedback').remove();

        setTimeout(function () {
            let username = $('#new_user_modal input#username').val(),
                email = $('#new_user_modal input#email').val(),
                password = $('#new_user_modal input#password').val(),
                password_confirmation = $('#new_user_modal input#confirm_password').val(),
                is_admin = !!$('#new_user_modal input#is_admin').is(':checked');

            axios.post(window.routes.user_store, {
                username,
                email,
                password,
                password_confirmation,
                is_admin
            }).then(response => {
                if (response.data.status) {
                    $('#newUserModal').modal('toggle');
                    Swal.fire({
                        title: window.filepool.trans.new_user_success,
                        icon: "success",
                        cancelButtonText: window.filepool.trans.close,
                    }).then(function () {
                        window.location.reload();
                    });
                }
            }, error => {
                if (error.response.data.errors) {
                    let {errors} = error.response.data;

                    Object.keys(errors).forEach(key => {
                        let value = errors[key][0],
                            element = $('#new_user_modal input#' + key);

                        element.after(
                            '<span class="invalid-feedback d-block mt-1 ml-2" role="alert">\n' +
                            '    <strong>' + value + '</strong>\n' +
                            '</span>'
                        );
                        element.addClass('is-invalid');

                    });
                } else if (!error.response.data.status) {
                    alert.html(error.response.data.message);
                    alert.show();
                }

            }).finally(function () {
                this_button.html(button_text);
                this_button.prop('disabled', false);
                console.clear();
            });
        }, 500);
    });

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

    $('input#logo').on('change', function () {
        preview_image(this, 'logo_preview');
    });
    $('input#favicon').on('change', function () {
        preview_image(this, 'favicon_preview');
    });


    /* Delete Page */
    $(document).on('click', '#page_delete', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: window.filepool.trans.title,
            text: window.filepool.trans.page_delete,
            icon: "error",
            confirmButtonText: window.filepool.trans.confirm_delete,
            cancelButtonText: window.filepool.trans.cancel,
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.page_destroy + '/' + id).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: response.data.message,
                            icon: "success",
                            cancelButtonText: window.filepool.trans.close,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message,
                            icon: "error",
                            cancelButtonText: window.filepool.trans.close,
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: window.filepool.trans.error,
                        icon: "error",
                        cancelButtonText: window.filepool.trans.close,
                    });
                });
            }
        });
    });

    /* Delete Product */
    $(document).on('click', '#product_delete', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: window.filepool.trans.title,
            text: window.filepool.trans.product_delete,
            icon: "error",
            confirmButtonText: window.filepool.trans.confirm_delete,
            cancelButtonText: window.filepool.trans.cancel,
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.product_destroy + '/' + id).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: response.data.message,
                            icon: "success",
                            cancelButtonText: window.filepool.trans.close,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message,
                            icon: "error",
                            cancelButtonText: window.filepool.trans.close,
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: window.filepool.trans.error,
                        icon: "error",
                        cancelButtonText: window.filepool.trans.close,
                    });
                });
            }
        });
    });

    $(document).on('click', '#message_delete', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: window.filepool.trans.title,
            text: window.filepool.trans.message_delete,
            icon: "error",
            confirmButtonText: window.filepool.trans.confirm_delete,
            cancelButtonText: window.filepool.trans.cancel,
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.message_destroy + '/' + id).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: response.data.message,
                            icon: "success",
                            cancelButtonText: window.filepool.trans.close,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message,
                            icon: "error",
                            cancelButtonText: window.filepool.trans.close,
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: window.filepool.trans.error,
                        icon: "error",
                        cancelButtonText: window.filepool.trans.close,
                    });
                });
            }
        });
    });

    $(document).on('click', '#file_delete', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: window.filepool.trans.title,
            text: window.filepool.trans.file_delete,
            icon: "error",
            confirmButtonText: window.filepool.trans.confirm_delete,
            cancelButtonText: window.filepool.trans.cancel,
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.file_destroy + '/' + id).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: response.data.message,
                            icon: "success",
                            cancelButtonText: window.filepool.trans.close,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message,
                            icon: "error",
                            cancelButtonText: window.filepool.trans.close,
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: window.filepool.trans.error,
                        icon: "error",
                        cancelButtonText: window.filepool.trans.close,
                    });
                });
            }
        });
    });

    /* Statics of uploads */
    if ($('#file_chart').length) {
        var options = {
            chart: {
                type: 'bar',
                zoom: {
                    enabled: true
                }
            },
            series: [{
                name: window.filepool.trans.uploads,
                data: Object.values(window.file_chart)
            }],
            xaxis: {
                categories: window.filepool.trans.months.split(',')
            },
            yaxis: {
                labels: {
                    formatter: val => val.toFixed(0)
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#file_chart"), options);

        chart.render();
    }

    /* Statics of users */
    if ($('#user_chart').length) {
        var options = {
            series: [{
                name: window.filepool.trans.users,
                data: Object.values(window.user_chart)
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: true
                }
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
                categories:window.filepool.trans.months.split(',')
            },
            yaxis: {
                labels: {
                    formatter: val => val.toFixed(0)
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#user_chart"), options);

        chart.render();
    }
    /* Active & Banned Users Charts */
    if ($('#user_status_chart').length) {
        var options = {
            series: Object.values(window.user_status_chart),
            chart: {
                width: 380,
                type: 'pie',
            },
            colors: ['#19d895', '#ff6258'],
            labels: [window.filepool.trans.active, window.filepool.trans.banned],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#user_status_chart"), options);

        chart.render();
    }

    /* User Login Types Chart */
    if ($('#user_login_chart').length) {
        var options = {
            series: Object.values(window.user_login_chart),
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: Object.keys(window.user_login_chart),
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#user_login_chart"), options);

        chart.render();
    }

    /* Delete User Avatar */

    $('#delete_user_avatar').on('click', function () {
        const id = $(this).attr('data-id');
        Swal.fire({
            title: window.filepool.trans.title,
            text: window.filepool.trans.avatar_delete,
            icon: "error",
            confirmButtonText: window.filepool.trans.confirm_delete,
            cancelButtonText: window.filepool.trans.cancel,
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.delete_avatar + '/' + id).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: response.data.message,
                            icon: "success",
                            cancelButtonText: window.filepool.trans.close,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message,
                            icon: "error",
                            cancelButtonText: window.filepool.trans.close,
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: window.filepool.trans.error,
                        icon: "error",
                        cancelButtonText: window.filepool.trans.close,
                    });
                });
            }
        });
    });

    $(document).on('click', '#language_delete', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: window.filepool.trans.title,
            text: window.filepool.trans.language_delete,
            icon: "error",
            confirmButtonText: window.filepool.trans.confirm_delete,
            cancelButtonText: window.filepool.trans.cancel,
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.language_destroy + '/' + id).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: response.data.message,
                            icon: "success",
                            cancelButtonText: window.filepool.trans.close,
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message,
                            icon: "error",
                            cancelButtonText: window.filepool.trans.close,
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: window.filepool.trans.error,
                        icon: "error",
                        cancelButtonText: window.filepool.trans.close,
                    });
                });
            }
        });
    });
});
