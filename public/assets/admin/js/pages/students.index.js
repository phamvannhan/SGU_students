jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    var _table = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 100, 200, "All"]],
        pageLength: 10,
        /*ajax: {
            url: linkDatatable,
            data: function (d) {
                d.role = $('#slrole').val();
            }
        },*/
        columns: [
            {data: 'id', name: 'id', orderable: false},
            {data: 'name', name: 'name', orderable: false},
            {data: 'email', name: 'email', orderable: false},
            {data: 'start_doanvien', name: 'start_doanvien', orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/vi.json'
        },
        drawCallback: function (settings) {
            $('#load__page').fadeOut();
        }
    });

    /*$('#slrole').change(function () {
        $('#load__page').show();
        _table.search('').draw();
    });*/
});