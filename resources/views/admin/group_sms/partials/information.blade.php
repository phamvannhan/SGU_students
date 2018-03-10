<div class="row">
    <div class="col-md-8 col-sm-offset-2">
        @include("admin.layouts.partials.form", [
            "object_trans" => !empty($group_sms) ? $group_sms : null,
            "form_fields" => [
                ["type" => "text", "name" => "name"],
                ["type" => "textarea", "name" => "content"]
            ],
            "translation_file" => "admin_group_sms"
        ])
    </div>
</div>
