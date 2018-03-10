<div class="row">
    <div class="col-md-12">
        @include("admin.layouts.partials.form", [
            "object_trans" => !empty($group_email) ? $group_email : null,
            "form_fields" => [
                ["type" => "text", "name" => "subject"],
                ["type" => "ckeditor", "name" => "content"]
            ],
            "translation_file" => "admin_group_email"
        ])
    </div>
</div>
