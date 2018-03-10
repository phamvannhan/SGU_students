jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');
    var linkCourseInfo = $('meta[name=linkCourseInfo]').attr('content');
    var _table = $("#datatable");

    $('#course').select2();

    var _datatable;

    $('#course').change(function () {
        $('#datatable-body input[type=search]').val('').change();
        $('#total_user').val('');
        var value = $(this).val();
        if (value) {
            $('#load__page').show();
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
                            d.course = $('#course').val();
                        }
                    },
                    columns: [
                        {
                            data: 'no', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }, orderable: false, searchable: false
                        },
                        {data: 'avatar', name: 'avatar', orderable: false},
                        {data: 'name', name: 'name', orderable: false},
                        {data: 'phone', name: 'phone', orderable: false},
                        {data: 'email', name: 'email', orderable: false},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ],
                    language: {
                        url: '/assets/plugins/jquery-datatable/languages/vi.json'
                    },

                    "drawCallback": function( settings ) {
                        $('#load__page').fadeOut();
                    }
                });
            }
            // Get course info
            $.ajax({
                url: linkCourseInfo,
                type: 'GET',
                data: {id: value}
            }).done(function (res) {
                $('#total_user').val(res.result.total_user);
            });

        }
        else {
            $('#datatable-body').slideUp();
        }
    });

});