<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @include("admin.layouts.partials.form", [
            "object_trans" => !empty($group_phone) ? $group_phone : null,
            "form_fields" => [
                ["type" => "text", "name" => "name"]
            ],
            "translation_file" => "admin_group_phone"
        ])
    </div>
</div>
