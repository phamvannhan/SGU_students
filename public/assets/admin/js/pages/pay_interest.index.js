var ve = new Vue({
    el: '#vue_history',
    data: {
        data: {
            name: null,
            history: []
        }
    }
});

var LINK_CONFIRM_PAYMENT = null;

var ve2 = new Vue({
    el: '#vue_confirm',
    data: {
        data: {
            // name: 'Dzung nguyen',
            // month: 12,
            // monthly_interest: 1233333,
            // real_interest: 4444444,
            // date_pay: '16-04-1990',
        }
    },
});

new Cleave('#confirm_real_interest', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});

new Cleave('#confirm_date_pay', {
    date: true,
    delimiter: '-',
    datePattern: ['d', 'm', 'Y']
});

jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');
    var linkCompanyInfo = $('meta[name=linkCompanyInfo]').attr('content');

    var _table = $("#datatable");

    $('#company').select2();

    $('#date_pay').datepicker({
        autoclose: true,
        startView: 'months',
        minViewMode: "months",
        container: '#date_pay-container',
        ignoreReadonly: true
    });

    $('#confirm_date_pay').datepicker({
        autoclose: true,
        container: '#confirm_date_pay-container',
        ignoreReadonly: true
    });

    $('#date_pay').change(function () {
        $('#company').change();
    });

    var _datatable;

    $('#company').change(function () {
        $('#datatable-body input[type=search]').val('').change();
        var value = $(this).val();
        var date_pay = $('#date_pay').val();
        if (value) {
            $('#datatable-body').slideDown();
            if (_datatable) {
                _datatable.search('').draw();
            }
            else {
                _datatable = _table.DataTable({
                    processing: true,
                    serverSide: true,
                    lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 100, 200, "All"]],
                    pageLength: 25,
                    ajax: {
                        url: linkDatatable,
                        data: function (d) {
                            d.company = $('#company').val();
                            d.date_pay = $('#date_pay').val();
                        }
                    },
                    columns: [
                        // {data: 'id', name: 'id'},
                        {
                            data: 'no', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }, orderable: false, searchable: false
                        },
                        {data: 'user_city', name: 'user_city', orderable: false, searchable: false},
                        {data: 'user.name', name: 'user.name', orderable: false},
                        {data: 'bank_number', name: 'bank_number', orderable: false, searchable: false},
                        {data: 'bank_branch', name: 'bank_branch', orderable: false, searchable: false},

                        {data: 'amount_of_investment', name: 'amount_of_investment', orderable: false},
                        {data: 'date_of_investment', name: 'date_of_investment', orderable: false},
                        {data: 'monthly_interest', name: 'monthly_interest', orderable: false, searchable: false},
                        {data: 'real_interest', name: 'real_interest', orderable: false, searchable: false},
                        {data: 'date_pay', name: 'date_pay', orderable: false, searchable: false},
                        {data: 'status', name: 'status', orderable: false, searchable: false},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ],
                    language: {
                        url: '/assets/plugins/jquery-datatable/languages/vi.json'
                    }
                });
            }
        }
        else {
            $('#datatable-body').slideUp();
        }
    });

    $('body').on('click', '.btn-show-history', function () {
        var href = $(this).data('href');
        $('.page-loader-wrapper').show();
        $.get(href, function (res) {
        }).done(function (res) {
            ve.data = res.result;
            $('#historyModal').modal('show');
            $('.page-loader-wrapper').fadeOut();
        }).fail(function (res) {
            toastr['error'](res.statusText);
            $('.page-loader-wrapper').fadeOut();
        });
        return false;
    });

    $('body').on('click', '.btn-confirm-interest', function () {
        var href = $(this).data('href');
        $('.page-loader-wrapper').show();
        $.get(href, function (res) {
            ve2.data = res.result;
            LINK_CONFIRM_PAYMENT = res.result.link_update;
        }).done(function (res) {
            $('#confirmModal').modal('show');
            $('.page-loader-wrapper').fadeOut();
        }).fail(function (res) {
            toastr['error'](res.statusText);
            $('.page-loader-wrapper').fadeOut();
        });
        return false;
    });

    $('body').on('click', '#btn_confirm_history', function () {
        var real_interest = $('#confirm_real_interest').val();
        var date_pay = $('#confirm_date_pay').val();
        if(!real_interest || !date_pay){
            toastr["error"]('Vui lòng nhập tiền thực lãnh và ngày thanh toán.');
            return false;
        }
        else{
            $('.page-loader-wrapper').show();
            $.ajax({
                url: LINK_CONFIRM_PAYMENT,
                type: 'PUT',
                data: {date_pay:date_pay, real_interest:real_interest}
            }).done(function (res) {
                _datatable.draw();
                toastr['success']('Xác nhận thanh toán thành công');
                $('#confirmModal').modal('hide');
                $('.page-loader-wrapper').fadeOut();
            }).fail(function (res) {
                toastr['error'](res.statusText);
                $('.page-loader-wrapper').fadeOut();
            });
            return false;
        }
        return false;
    });

    $('body').on('click', '#export_to_excel', function () {
        var company = $('#company').val();
        var date_pay = $('#date_pay').val();
        if(!company || !date_pay){
            toastr["error"]('Vui lòng chọn công ty và lãi suất tháng.');
            return false;
        }
        else{
           var linkExport = $('meta[name=linkExport]').attr('content');
            linkExport = linkExport + `?company=${company}&date_pay=${date_pay}`;
            window.open(linkExport);
        }
        return false;
    });
});