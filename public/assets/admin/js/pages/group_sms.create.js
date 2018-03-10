var ve = new Vue({
    el: '#vue_user',
    data: function () {
        return {
            users: DATA_USERS
        }
    },
    methods: {
        removeAll: function (event) {
            this.users = {};
        }
    }
});

jQuery(function ($) {
    $('#form-form').validate({
        focusInvalid: true,
        highlight: function (element) {
            $(element).closest('.tab-pane').addClass("tab-error");
            $(element).addClass("input-error");
            var tab_content = $(element).closest('form');
            if ($(".active.tab-error label.error").length == 0) {
                var _id = $(tab_content).find(".tab-error:not(.active)").attr("id");
                $('a[href="#' + _id + '"]').tab('show');
            }

            $(element).parents('.form-line').addClass('error');
        },
        unhighlight: function (element) {
            $(element).closest('.tab-pane').removeClass("tab-error");
            $(element).removeClass("input-error");

            $(element).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        ignore: "",
        rules: {
            name: {required: true},
            content: {required: true},
            'users[]': {required: true},
        }
    });


    var linkDatatable = $('meta[name=linkDatatable]').attr('content');
    var company_user;

    $('#slcompany').select2();

    $('#slcompany').change(function () {
        $('#datatable-body input[type=search]').val('').change();
        var value = $(this).val();
        if (value) {
            $('#load__page').show();
            $('#datatable-body').slideDown();
            if (company_user) {
                company_user.search('').draw();
                setTimeout(function () {
                    $('#load__page').fadeOut();
                }, 2000)
            }
            else {
                company_user = $("#company_user").DataTable({
                    processing: true,
                    serverSide: true,
                    lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 100, 200, "All"]],
                    pageLength: 10,
                    ajax: {
                        url: linkDatatable,
                        data: function (d) {
                            d.company = $('#slcompany').val();
                            d.type = 'datatable_company_user'
                        }
                    },
                    columns: [
                        // {data: 'id', name: 'id'},
                        {
                            data: 'no', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }, orderable: false, searchable: false
                        },
                        {data: 'user.name', name: 'user.name', orderable: false},
                        {data: 'user.phone', name: 'user.phone', orderable: false},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ],
                    language: {
                        url: '/assets/plugins/jquery-datatable/languages/vi.json'
                    },
                    "initComplete": function (settings, json) {
                        $('#load__page').fadeOut();
                    }
                });
            }
        }
        else {
            $('#datatable-body').slideUp();
        }
    });

    var list_user = $('#list_user').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 100, 200, "All"]],
        pageLength: 10,
        ajax: {
            url: linkDatatable,
            data: function (d) {
                d.role = $('#slrole').val();
                d.type = 'datatable_list_user'
            }
        },
        columns: [
            {
                data: 'no', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }, orderable: false, searchable: false
            },
            {data: 'name', name: 'name', orderable: false},
            {data: 'phone', name: 'phone', orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/vi.json'
        },
        drawCallback: function (settings) {
            $('#load__page').fadeOut();
        }
    });

    $('#slrole').change(function () {
        $('#load__page').show();
        list_user.search('').draw();
    });

    // add user to list email
    $('body').on('click', '.btn-add-user-to-list', function () {
        var type = $(this).data('type');
        var tr = $(this).closest('tr');
        if (type === 'company_user') {
            var row = company_user.row(tr);
            if (!(row.data().user_id in ve.users)) {
                Vue.set(ve.users, row.data().user_id, {
                    id: row.data().user_id,
                    name: row.data().user.name,
                    phone: row.data().user.phone,
                    email: null
                });
            }
        }
        else {
            var row = list_user.row(tr);
            if(!checkPhoneNumber(row.data().phone)){
                toastr['error']('Số điện thoại không hợp lệ');
                return false
            }
            else{
                if (!(row.data().id in ve.users)) {
                    Vue.set(ve.users, row.data().id, {
                        id: row.data().id,
                        name: row.data().name,
                        phone: row.data().phone,
                        email: null
                    });
                }
            }
        }
    });

    // Remove out list
    $('body').on('click', '.btn_remove_out_list', function () {
        var _key = $(this).attr('_key');
        if (_key in ve.users) {
            Vue.delete(ve.users, _key);
        }
    });

    // Add all users on company to list
    $('body').on('click', '#btn_add_company_user', function () {
        var value = $('#slcompany').val();
        if (value) {
            $('#load__page').show();
            $.ajax({
                url: linkDatatable,
                data: {company: value, type: 'list_user'},
                type: 'GET'

            }).done(function (res) {
                for (var i = 0; i < res.result.length; i++) {
                    if (!(res.result[i].id in ve.users) && checkPhoneNumber(res.result[i].phone)) {
                        Vue.set(ve.users, res.result[i].id, res.result[i]);
                    }
                }
                $('#load__page').fadeOut();
                toastr['success']('Thêm vào danh sách nhận thành công');
            });
        }
        else {
            toastr['error']('Vui lòng chọn công ty');
        }
    });

    $('body').on('click', '#btn_add_user_by_role', function () {
        var value = $('#slrole').val();
        $('#load__page').show();
        $.ajax({
            url: linkDatatable,
            data: {role: value, type: 'list_user_by_role'},
            type: 'GET'

        }).done(function (res) {
            for (var i = 0; i < res.result.length; i++) {
                if (!(res.result[i].id in ve.users)) {
                    Vue.set(ve.users, res.result[i].id, res.result[i]);
                }
            }
            $('#load__page').fadeOut();
            toastr['success']('Thêm vào danh sách nhận thành công');
        }).fail(function (res) {
            $('#load__page').fadeOut();
            toastr['error']('Lấy danh sách bị lỗi');
        });
    });
});