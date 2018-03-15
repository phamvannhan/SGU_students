<div class="row">
    <div class="col-md-4">
        <p>{!! trans("admin_user.form.role") !!}</p>
        <div class="form-group form-float">
            <div class="form-line">
                <select class="form-control show-tick" name="role[]" id="role" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {!! !empty($user_role) && in_array($role->id , $user_role) ? "selected" : null !!} >{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <p>{!! trans("admin_user.form.city") !!}</p>
        <div class="form-group form-float">
            <div class="form-line">
                <select class="form-control" name="city_id" id="city">
                    <option value="">---</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {!! !empty($user) && $user->city_id == $city->id ? "selected" : null !!} >{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="name"
                       value="{!! !empty($user) ? $user->name : old("name") !!}">
                <label class="form-label">{!! trans("admin_user.form.name") !!}</label>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="email"
                       value="{!! !empty($user) ? $user->email : old("email") !!}" {!! !empty($user) ? 'readonly'  : null !!}>
                <label class="form-label">{!! trans("admin_user.form.email") !!}</label>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="password"
                       value="{!! old("password")  !!}">
                <label class="form-label">{!! trans("admin_user.form.password") !!}</label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <p>{!! trans("admin_user.form.students_code") !!}</p>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="students_code"
                       value="{!! !empty($user) ? $user->students_code : old("students_code") !!}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        
        <p>{!! trans("admin_user.form.birthday") !!}</p>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control datepicker" name="birthday"
                       data-date-format="{!! JS_DATE !!}" id="birthday"  placeholder="dd-mm-yyyy"
                       value="{!! !empty($user) ? $user->birthday_format : old("birthday") !!}">
                <div id="birthday-container" style="position: relative"> </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <p>{!! trans("admin_user.form.current_address") !!}</p>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="current_address"
                       value="{!! !empty($user) ? $user->current_address : old("current_address") !!}">
            </div>
        </div>
    </div>

</div>


<div class="row">

    <div class="col-md-4">
        <p>{!! trans("admin_user.form.avatar") !!}</p>
        <div class="form-group">
            @include('admin.photo.form', [
                'object_image' => [
                    'append' => 'user_avatar',
                    'image' => !empty($user->avatar) ?  assetStorage($user->avatar) : null,
                    'image_value' => !empty($user->avatar) ?  $user->avatar : null,
                    'name' => 'user_avatar',
                    'delete' => 'delete_avatar'
                ]
            ])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="phone"
                       value="{!! !empty($user) ? $user->phone : old("phone") !!}">
                <label class="form-label">{!! trans("admin_user.form.phone") !!}</label>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="facebook"
                       value="{!! !empty($user) ? $user->facebook : old("facebook") !!}">
                <label class="form-label">{!! trans("admin_user.form.facebook") !!}</label>
            </div>
        </div>
    </div>

</div>

<h4>{!! trans("admin_user.active_check") !!}</h4>

<hr>

<div class="row">

    <div class="col-md-4">
        <div class="form-group">
            <p> </p>
            <input type="checkbox" id="is_doanvien" name="active"
                   value="1" {!! !empty($user) && $user->is_doanvien ? "checked" : null !!}>
            <label for="is_doanvien">{!! trans("admin_user.form.is_doanvien") !!}</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <p> </p>
            <input type="checkbox" id="is_chidoan" name="active"
                   value="1" {!! !empty($user) && $user->is_chidoan ? "checked" : null !!}>
            <label for="is_chidoan">{!! trans("admin_user.form.is_chidoan") !!}</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <p> </p>
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($user) && $user->active ? "checked" : null !!}>
            <label for="active">{!! trans("admin_user.form.active") !!}</label>
        </div>
    </div>
</div>