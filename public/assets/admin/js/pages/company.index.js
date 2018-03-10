var result = {
    data : {}
};
var vm = new Vue({
    el: '#vue',
    data: result,
});

jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    var _table = $("#datatable");

    _table.DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200,-1], [10, 25, 100, 200, "All"]],
        pageLength: 25,
        ajax: {
            url: linkDatatable,
        },
        columns: [
            // {data: 'id', name: 'id'},
            {data: 'no', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }, orderable: false, searchable: false},

            {data: 'alias_name', name: 'alias_name', orderable: false},

            {data: 'code', name: 'code', orderable: false},

            {data: 'charter_capital', name: 'charter_capital', orderable: false},

            {data: 'users_count', name: 'users_count', orderable: false, searchable: false},

            {data: 'price_of_share', name: 'price_of_share', orderable: false},

            {data: 'total_share', name: 'total_share', orderable: false},

            {data: 'total_number_of_share', name: 'total_number_of_share', orderable: false, searchable: false},

            {data: 'share_remaining', name: 'share_remaining', orderable: false, searchable: false},

            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/vi.json'
        }
    });
    
    $('body').on('click', '.btn-show-item', function () {
       var href = $(this).data('href');
       $('.page-loader-wrapper').show();
       $.get(href, function (res) {
       }).done(function (res) {
           vm.data = res.result;
           $('#show_modal').modal('show');
           $('.page-loader-wrapper').fadeOut();
       }).fail(function (res) {
            toastr['error'](res.statusText);
           $('.page-loader-wrapper').fadeOut();
        });
    });
});