jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    var _table = $("#datatable");

    var datatable = _table.DataTable({
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
            {data: 'user.name', name: 'user.name', orderable: false},
            {data: 'title', name: 'title', orderable: false},
            {data: 'room.name', name: 'room.name', orderable: false},
            {data: 'created_at', name: 'created_at', orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/vi.json'
        }
    });

    // Add event listener for opening and closing details
    $('#datatable tbody').on('click', '.btn-detail', function () {
        var template = $("#details-template").html();

        var tr = $(this).closest('tr');
        var row = datatable.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            template = template.replace("CONTACT_CONTENT", row.data().content);
            // Open this row
            row.child( template ).show();
            tr.addClass('shown');
        }
    });
});