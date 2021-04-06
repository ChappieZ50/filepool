import axios from "axios";

require('./bootstrap');


window.$ = window.jQuery = require('jquery');
import '@popperjs/core';
import 'bootstrap/dist/js/bootstrap.bundle'
import Clipboard from "clipboard/dist/clipboard";
import Swal from 'sweetalert2/src/sweetalert2.js'
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

        function parse_errors(errors, el = $('#user_profile_errors')) {
            Object.keys(errors).forEach(key => {
                let value = errors[key][0];
                el.html(value + "<br>");
            });
            el.show();
        }

        /* type: "success","error" */
        function show_swal(title, type = 'success', reload = true) {
            if (type === "error") {
                Swal.fire({
                    title: title,
                    icon: "error",
                    cancelButtonText: 'Close',
                }).then(function () {
                    if (reload) {
                        window.location.reload();
                    }
                });

            } else {
                Swal.fire({
                    title,
                    icon: "success",
                    cancelButtonText: 'Close',
                }).then(function () {
                    if (reload) {
                        window.location.reload();
                    }
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
                    data: Object.values(window.file_chart),

                }],
                tooltip: {
                    theme: 'dark'
                },
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: true
                    },
                    foreColor: '#ccc',
                    toolbar: {
                        show: false
                    },
                },
                legend: {
                    show: false
                },
                theme: {
                    mode: 'light',
                    palette: 'palette10',
                    monochrome: {
                        enabled: true,
                        color: window.filepool.theme,
                        shadeTo: 'light',
                        shadeIntensity: 0.65
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                grid: {
                    borderColor: "#363e4a",
                    row: {
                        colors: ['transparent', 'transparent'],
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

        /* User file storage chart */
        if ($('#file_storage_chart').length) {
            const file_storage = [],
                file_storage_units = [];


            Object.values(window.file_storage_chart_data).forEach(function (i) {
                file_storage.push(i.value);
                file_storage_units.push(i.unit);
            });

            let options = {
                series: [{
                    name: "Usage",
                    data: file_storage,
                }],

                chart: {
                    height: 350,
                    type: 'bar',
                    zoom: {
                        enabled: true
                    },
                    foreColor: '#ccc',
                    toolbar: {
                        show: false
                    },
                },
                legend: {
                    show: false
                },
                tooltip: {
                    theme: 'dark',
                    x: {
                        show: false
                    },
                    y: {
                        formatter: function (value, series) {
                            return value + file_storage_units[series.dataPointIndex];
                        }
                    },
                },
                theme: {
                    mode: 'light',
                    palette: 'palette10',
                    monochrome: {
                        enabled: true,
                        color: window.filepool.theme,
                        shadeTo: 'light',
                        shadeIntensity: 0.65
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: 'straight'
                },
                grid: {
                    borderColor: "#363e4a",
                    row: {
                        colors: ['transparent', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                },
                yaxis: {
                    show: false,
                }

            };

            let chart = new ApexCharts(document.querySelector("#file_storage_chart"), options);

            chart.render();
        }

        /* User storage usage chart */
        if ($('#user_storage_usage_chart').length) {
            let options = {
                series: [window.user_storage_usage.empty, window.user_storage_usage.used],
                labels: ['Empty', 'Used'],
                colors: ['#19d895', window.filepool.theme],
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "%"
                    },
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                value: {
                                    formatter: function (value) {
                                        return "%" + parseFloat(value).toLocaleString();
                                    },
                                    color: '#fff',
                                },
                            }
                        }
                    }
                },
                legend: {
                    show: false,
                },
                chart: {
                    type: 'donut',
                    height: 200,
                },
            };

            let chart = new ApexCharts(document.querySelector("#user_storage_usage_chart"), options);

            chart.render();
        }

        /* Fpool files loading */
        if ($('.fpool-images-wrapper').length) {
            imagesLoaded(document.querySelector('.fpool-images-wrapper'), function () {
                $('.fpool-spinner').fadeOut();
                $('.fpool-images-wrapper').fadeIn();
            });
        }


        /* Show File Password */
        $(document).on('click', '#show_file_password', function () {
            let id = $(this).attr('data-id');
            if (id) {
                Swal.fire({
                    title: 'Your password will appear clearly. Do you confirm?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    showLoaderOnConfirm: true,
                }).then(result => {
                    if (result.isConfirmed) {
                        axios.post('my-files/password', {id}).then(response => {
                            Swal.fire({
                                title: 'Your file\'s password',
                                text: response.data.password,
                                showCancelButton: true,
                                showConfirmButton: false,
                            })
                        }).catch(() => {
                            show_swal('Something gone wrong', 'error', false);
                        });
                    }
                })
            }
        });

        /* File Download */
        $(document).on('click', '#download_file', function () {
            let id = $(this).attr('data-id'),
                mime = $(this).attr('data-mime');

            if ($(this).attr('data-secure') && !$(this).attr('data-own')) {
                Swal.fire({
                    title: 'Enter Password',
                    input: 'password',
                    inputAttributes: {
                        name: 'file_password'
                    },
                    preConfirm: function () {
                        if ($('input[name=file_password]').val().length < 0) {
                            Swal.showValidationMessage(`Please enter file's password`);
                        }
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Download File',
                    showLoaderOnConfirm: true,

                }).then((result) => {
                    if (result.isConfirmed) {
                        let password = $('input[name=file_password]').val();
                        download_file(id, mime, password);
                    }
                })
            } else {
                download_file(id, mime);
            }
        });

        function download_file(id, mime, password = '') {
            axios.post(window.routes.file_download, {
                id,
                password,
            }, {
                responseType: 'blob',
            }).then(response => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', id + '.' + mime);
                document.body.appendChild(link);
                link.click();
            }).catch((errors) => {
                if (errors.response.status === 401) {
                    show_swal('Password incorrect', 'error', false);
                } else {
                    show_swal('Something gone wrong', 'error', false);
                }
            });
        }

        if ($('#payment_success').length > 0) {
            show_swal('Your payment successful', 'success', false);
        }

        $(document).on('click', '#buy_product_button', function () {
            $('#paymentModal input#payment_product').val($(this).attr('data-product'));
            $('#paymentModal #paymentModalTitle').html($(this).attr('data-product-title'));
        });

    }
);
