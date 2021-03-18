require('./bootstrap');
import axios from 'axios';
import 'bootstrap/dist/js/bootstrap.bundle'
import Swal from 'sweetalert2'

const feather = require('feather-icons');
$(document).ready(function () {
    feather.replace();

    /* Ban / Unban */
    $(document).on('click', '#ban', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "This user will be banned",
            icon: "error",
            confirmButtonText: "Yes,Ban",
            cancelButtonText: "Cancel",
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
                            title: "User Banned",
                            icon: "success",
                            cancelButtonText: 'Close',
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message ? response.data.message : "Something wrong",
                            icon: "error",
                            cancelButtonText: 'Close',
                        });
                    }
                });
            }
        });
    });
    $(document).on('click', '#unban', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "This user will be unbanned",
            icon: "info",
            confirmButtonText: "Yes,Unban",
            cancelButtonText: "Cancel",
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
                            title: "User Unbanned",
                            icon: "success",
                            cancelButtonText: 'Close',
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.data.message ? response.data.message : "Something wrong",
                            icon: "error",
                            cancelButtonText: 'Close',
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
                        title: "New User Added",
                        icon: "success",
                        cancelButtonText: 'Close',
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
            title: "Are you sure?",
            text: "This page will be deleted",
            icon: "error",
            confirmButtonText: "Yes,Delete",
            cancelButtonText: "Cancel",
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.page_destroy + '/' + id).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: "Page successfully deleted",
                            icon: "success",
                            cancelButtonText: 'Close',
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Something wrong",
                            icon: "error",
                            cancelButtonText: 'Close',
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: "Something wrong",
                        icon: "error",
                        cancelButtonText: 'Close',
                    });
                });
            }
        });
    });

    $(document).on('click', '#message_delete', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "This message will be deleted",
            icon: "error",
            confirmButtonText: "Yes,Delete",
            cancelButtonText: "Cancel",
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.message_destroy + '/' + id).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: "Message successfully deleted",
                            icon: "success",
                            cancelButtonText: 'Close',
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Something wrong",
                            icon: "error",
                            cancelButtonText: 'Close',
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: "Something wrong",
                        icon: "error",
                        cancelButtonText: 'Close',
                    });
                });
            }
        });
    });

    $(document).on('click', '#file_delete', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "This file will be deleted",
            icon: "error",
            confirmButtonText: "Yes,Delete",
            cancelButtonText: "Cancel",
            showCancelButton: true,
            confirmButtonColor: '#ff6258',
        }).then(function (result) {
            if (result.isConfirmed) {
                axios.delete(window.routes.file_destroy + '/' + id).then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            title: "File successfully deleted",
                            icon: "success",
                            cancelButtonText: 'Close',
                        }).then(function () {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Something wrong",
                            icon: "error",
                            cancelButtonText: 'Close',
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        title: "Something wrong",
                        icon: "error",
                        cancelButtonText: 'Close',
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
                name: 'Uploads',
                data: Object.values(window.file_chart)
            }],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
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
                name: "Users",
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
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
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
            labels: ['Active', 'Banned'],
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

    /* File Extension Chart */
    if ($('#file_extension_chart').length) {
        var options = {
            series: Object.values(window.file_extension_chart),
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: Object.values(window.file_extension_chart_labels),
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#file_extension_chart"), options);

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
});
