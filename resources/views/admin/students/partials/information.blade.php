
<div class="row">
    <div class="col-md-4">
        <label class="form-label">{!! trans("admin_user.form.students_code") !!}</label>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" id="students_code" name="students_code"
                       value="{!! !empty($students) ? $students->id : old("id") !!}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="email"
                       value="{!! !empty($students) ? $students->email : old("email") !!}" {!! !empty($students) ? 'readonly'  : null !!}>
                <label class="form-label">{!! trans("admin_students.form.email") !!}</label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label">{!! trans("admin_students.form.phone") !!}</label>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="phone"
                       value="{!! !empty($students) ? $students->phone : old("phone") !!}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label class="form-label">{!! trans("admin_students.form.name") !!}</label>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="name"
                       value="{!! !empty($students) ? $students->name : old("name") !!}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <p>{!! trans("admin_students.form.birthday") !!}</p>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control datepicker" name="birthday"
                       data-date-format="{!! JS_DATE !!}" id="birthday"  placeholder="dd-mm-yyyy"
                       value="{!! !empty($students) ? $students->birthday_format : old("birthday") !!}">
                <div id="birthday-container" style="position: relative"> </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <p>{!! trans("admin_user.form.current_address") !!}</p>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="address"
                       value="{!! !empty($students) ? $students->address : old("address") !!}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label class="form-label">{!! trans("admin_students.form.DiemHT") !!}</label>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="DiemHT"
                       value="{!! !empty($students) ? $students->DiemHT : old("DiemHT") !!}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <label class="form-label">{!! trans("admin_students.form.DiemRL") !!}</label>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="DiemRL"
                       value="{!! !empty($students) ? $students->DiemRL : old("DiemRL") !!}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label">{!! trans("admin_students.form.classes") !!}</label>
        <div class="form-group form-float">
            <select id="classes" name="classes">
                <option value="">---</option>
                @foreach($classes as $classes)
                    <option value="{{$classes->id}}">{{ $classes->class_name }}</option>
                @endforeach
            </select>
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
                   value="1" {!! !empty($students) && $students->is_doanvien ? "checked" : null !!}>
            <label for="is_doanvien">{!! trans("admin_user.form.is_doanvien") !!}</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <p> </p>
            <input type="checkbox" id="is_chidoan" name="active"
                   value="1" {!! !empty($students) && $students->is_chidoan ? "checked" : null !!}>
            <label for="is_chidoan">{!! trans("admin_user.form.is_chidoan") !!}</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <p> </p>
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($students) && $students->active ? "checked" : null !!}>
            <label for="active">{!! trans("admin_user.form.active") !!}</label>
        </div>
    </div>
</div>