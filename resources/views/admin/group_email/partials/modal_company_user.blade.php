<div class="modal fade" id="modal_company_user" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-bold">Thêm người nhận</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <select id="slcompany" class="form-control" style="width: 100%;">
                                    <option value="">---</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->code }}/{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary" id="btn_add_company_user">
                            <i class="material-icons">chevron_right</i> Thêm tất cả vào danh sách nhận
                        </button>
                    </div>
                </div>
                <div id="datatable-body" style="display: none;">
                    <table id="company_user" class="table table-striped table-hover dataTable" style="width: 100%">
                        <thead>
                        <tr>
                            <th width="40">{!! trans("admin_group_email.table.id") !!}</th>
                            <th>{!! trans("admin_group_email.table.name") !!}</th>
                            <th>{!! trans("admin_group_email.table.email") !!}</th>
                            <th width="130">{!! trans("admin_group_email.table.action") !!}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn waves-effect waves-light" data-dismiss="modal">{{ trans('button.close') }}</button>
            </div>
        </div>
    </div>
</div>