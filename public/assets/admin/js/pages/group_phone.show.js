jQuery(function ($) {
    var URL_UPDATE_USER = null;

    new Cleave('#called_at', {
        date: true,
        delimiter: '-',
        datePattern: ['d', 'm', 'Y']
    });

    $('#called_at').datepicker({
        autoclose: true,
        container: '#called_at-container'
    });

    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    var _table = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 100, 200, "All"]],
        pageLength: 10,
        ajax: {
            url: linkDatatable
        },
        columns: [
            {
                data: 'no',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false, searchable: false
            },
            {data: 'user.name', name: 'user.name', orderable: false},
            {data: 'user.phone', name: 'user.phone', orderable: false},
            {data: 'note', name: 'note', orderable: false},
            {data: 'called_at', name: 'called_at', orderable: false, searchable: false},
            {data: 'label_status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/vi.json'
        },
        drawCallback: function (settings) {
            $('#load__page').fadeOut();
        }
    });

    $('body').on('click', '.btn_edit', function (e) {
        URL_UPDATE_USER = $(this).data('href');
        var tr = $(this).closest('tr');
        var data = _table.row(tr).data();
        $('#user_name').html(data.user.name);
        $('#user_note').val(data.note);
        $('#called_at').val(data.called_at);
        $('#status_' + data.status).prop("checked", true);
        $('#groupUserModal').modal('show');
    });

    $('body').on('click', '#btn_save', function () {
        var status = $("input[name=status]:checked").val();
        var note = $('#user_note').val();
        var called_at = $('#called_at').val();
        if (status === 'done' && (!note || !called_at)) {
            toastr['error']('Vui lòng nhập đủ thông tin!');
            return false;
        }
        $('#load__page').show();
        $.ajax({
            type: 'POST',
            url: URL_UPDATE_USER,
            data: {
                status: status,
                note: note,
                called_at: called_at,
                _method: 'PUT'
            }
        }).done(function (res) {
            toastr['success'](res.message);
            $('#groupUserModal').modal('hide');
            _table.draw();
        }).fail(function (res) {
            toastr['error']('Cập nhật bị lỗi!');
            $('#load__page').show();
        });
    });

    $('#modal-delete-record form button[type=submit]').click(function () {
        var url = $('#modal-delete-record form').attr('action');
        $('#load__page').show();
        $.ajax({
            type: 'DELETE',
            url: url
        }).done(function (res) {
            $('#modal-delete-record').modal('hide');
            toastr['success'](res.message);
            _table.draw();
        }).fail(function (res) {
            toastr['error']('Xóa bị lôi!');
            $('#load__page').fadeOut();
        });
        return false;
    });
});