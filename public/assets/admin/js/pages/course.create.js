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

    $('#city').select2();

    $('#start_date').datepicker({
        autoclose: true,
        container: '#start_date-container'
    });

    new Cleave('#start_date', {
        date: true,
        delimiter: '-',
        datePattern: ['d', 'm', 'Y']
    });

    $('#form-form').validate({
        focusInvalid: false,
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
            'name': {required: true},
            'courses_year': {required: true},
            'quantity': {required: true, number: true, min: 1},
            'city_id': {required: true},
            'start_date': {required: true},

        }
    });

    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    var list_user = $('#list_user').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 100, 200, "All"]],
        pageLength: 10,
        ajax: {
            url: linkDatatable
        },
        columns: [
            {
                data: 'no', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }, orderable: false, searchable: false
            },
            {data: 'name', name: 'name', orderable: false},
            {data: 'email', name: 'email', orderable: false},
            {data: 'phone', name: 'phone', orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/vi.json'
        }
    });

    // add user to list email
    $('body').on('click', '.btn-add-user-to-list', function () {
        var type = $(this).data('type');
        var tr = $(this).closest('tr');
        var row = list_user.row(tr);
        if (!(row.data().id in ve.users)) {
            Vue.set(ve.users, row.data().id, {
                id: row.data().id,
                name: row.data().name,
                email: row.data().email,
                phone: row.data().phone
            });
        }
    });

    // Remove out list
    $('body').on('click', '.btn_remove_out_list', function () {
        var _key = $(this).attr('_key');
        if (_key in ve.users) {
            Vue.delete(ve.users, _key);
        }
    });
});