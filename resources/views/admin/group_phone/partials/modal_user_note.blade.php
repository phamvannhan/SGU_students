<div class="modal fade" id="groupUserModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">{{ __('admin_group_phone.update_info') }}</h4>
            </div>
            <div class="modal-body">
                <div id="vue_confirm">
                    <p class="font-bold col-pink" id="user_name">USER_NAME</p>
                    <form class="form-horizontal">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="month">{{ __('admin_group_phone.table.status') }}</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <input name="status" id="status_waiting" type="radio" value="waiting">
                                    <label for="status_waiting">Chưa gọi</label>

                                    <input name="status" id="status_done" type="radio" value="done">
                                    <label for="status_done">Đã gọi</label>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="month">{{ __('admin_group_phone.table.note') }}</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="user_note" class="form-control" rows="2" placeholder="Nhập ghi chú"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="month">{{ __('admin_group_phone.table.called_at') }}</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="called_at"
                                               data-date-format="{{ JS_DATE }}" id="called_at"
                                               placeholder="{{ JS_DATE }}"
                                               value="">
                                        <div id="called_at-container" style="position: relative"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_save" class="btn btn-primary waves-effect">{{ trans('button.save') }}</button>
                <button type="button" class="btn waves-effect waves-light"
                        data-dismiss="modal">{{ trans('button.close') }}</button>
            </div>
        </div>
    </div>
</div>