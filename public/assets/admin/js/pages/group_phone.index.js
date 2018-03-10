jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 100, 200, "All"]],
        pageLength: 10,
        ajax: {
            url: linkDatatable,
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
            {data: 'users_count', name: 'users_count', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/vi.json'
        }
    });
});