jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    var _table = $("#datatable");

    _table.DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200,-1], [10, 25, 100, 200, "All"]],
        pageLength: 10,
        ajax: {
            url: linkDatatable,
        },
        columns: [
            // {data: 'id', name: 'id'},
            {data: 'no', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }, orderable: false, searchable: false},
            {data: 'category.name', name: 'category.name', orderable: false, searchable: false},
            {data: 'title', name: 'title', orderable: false},
            {data: 'active', name: 'active', orderable: false},
            {data: 'created_at', name: 'created_at', orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/vi.json'
        }
    });
});