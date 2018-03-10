jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    var _table = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 100, 200, "All"]],
        pageLength: 10,
        ajax: {
            url: linkDatatable,
            data: function (d) {
                d.role = $('#slrole').val();
            }
        },
        columns: [
            {
                data: 'no',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false, searchable: false
            },
            {data: 'name', name: 'name', orderable: false},
            {data: 'roles_name', name: 'roles_name', orderable: false, searchable: false},
            {data: 'email', name: 'email', orderable: false},
            {data: 'created_at', name: 'created_at', orderable: false},
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
        _table.search('').draw();
    });
});