<div class="modal fade" id="modal_list_user" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-bold">Thêm người nhận</h3>
            </div>
            <div class="modal-body">
                <style>
                    #list_user tbody tr td:last-child, tbody tr th:last-child
                    {
                        width: 100px !important;
                        max-width: 100px !important;
                    }
                </style>
                <label for="slrole">Chọn vai trò để hiển thị thành viên</label>
                <div class="row">
                    <div class="col-sm-6 col-md-5">
                        <select id="slrole" class="form-control m-b-10">
                            <option value="">Tất cả vai trò</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-5">
                        <button type="button" class="btn btn-primary" id="btn_add_user_by_role">
                            <i class="material-icons">chevron_right</i> Thêm tất cả vào danh sách nhận
                        </button>
                    </div>
                </div>
                <table id="list_user" class="table table-striped table-hover dataTable" style="width: 100%">
                    <thead>
                    <tr>
                        <th width="40">{!! trans("admin_group_phone.table.id") !!}</th>
                        <th>{!! trans("admin_group_phone.table.name") !!}</th>
                        <th>{!! trans("admin_group_phone.table.phone") !!}</th>
                        <th width="130">{!! trans("admin_group_phone.table.action") !!}</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn waves-effect waves-light" data-dismiss="modal">{{ trans('button.close') }}</button>
            </div>
        </div>
    </div>
</div>