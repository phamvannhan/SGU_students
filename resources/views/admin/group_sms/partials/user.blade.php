<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
            <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" {{ !empty($group_email) && $group_email->status === 'sent' ? 'disabled' : null }}
                    data-target="#modal_company_user">
                <i class="material-icons">location_city</i> Doanh nghiệp
            </button>

            <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" {{ !empty($group_email) && $group_email->status === 'sent' ? 'disabled' : null }}
                    data-target="#modal_list_user">
                <i class="material-icons">account_box</i> Cá nhân
            </button>
        </div>
    </div>

    <div class="col-md-12">
        <h5>Danh sách người nhận</h5>
        <div id="vue_user">
            <div style="max-height: 400px; overflow-y: auto">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Phone</th>
                            <th width="130">Hành động</th>
                        </tr>
                        </thead>
                        <tbody v-if="Object.keys(users).length">
                        <tr v-for="(value, key, index) in users">
                            <td>@{{ index + 1 }}</td>
                            <td>@{{ value.name }}</td>
                            <td>@{{ value.phone }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn_remove_out_list" :_key="key" {{ !empty($group_email) && $group_email->status === 'sent' ? 'disabled' : null }}>
                                    {{ trans('button.delete') }}
                                </button>
                            </td>
                        </tr>
                        </tbody>
                        <tbody v-else>
                        <tr>
                            <td colspan="4">Không tìm thấy dữ liệu</td>
                        </tr>
                        </tbody>
                    </table>

                    <div v-if="Object.keys(users).length">
                        <input type="hidden" name="users[]" v-for="(value, key, index) in users" :value="value.id">
                    </div>
                    <div v-else>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="hidden" name="users[]" value="{{ !empty($group_email) && $group_email->status === 'sent' ? 'disabled' : null }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right m-t-10">
                <button type="button" class="btn btn-warning" v-on:click="removeAll" {{ !empty($group_email) && $group_email->status === 'sent' ? 'disabled' : null }}>
                    Xóa hết
                </button>
            </div>

        </div>
    </div>
</div>
