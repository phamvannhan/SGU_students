<?php
return [
    "news_image" => [
        "path" => "news/image",
        "base_64" => true,
        "crop" => true,
        "max_width" => 1024,
        "sizes" => [
            "large" => [600, 450],
            "medium" => [400, 300],
            "small" => [200, 150]
        ]
    ],
    "news_category_icon" => [
        "path" => "news_category",
        "base_64" => true,
        "max_width" => 1024,
    ],

    "seminar_image" => [
        "path" => "seminar/image",
        "base_64" => true,
        "crop" => true,
        "max_width" => 1024,
        "sizes" => [
            "large" => [600, 390],
            "medium" => [490, 320],
            "small" => [200, 130]
        ]
    ],

    'user_cmnd' => [
        "path" => "user/cmnd",
        "base_64" => true,
        "max_width" => 1024,
    ],

    'user_avatar_admin' => [
        "path" => "user/avatar",
        "base_64" => true,
        "max_width" => 1024,
        "crop" => true,
        "size" => [300, 300]
    ],

    'user_avatar' => [
        "path" => "user/avatar",
        "base_64" => false,
        "max_width" => 1024,
        "crop" => true,
        "size" => [300, 300]
    ],

    'company_logo' => [
        "path" => "company/logo",
        "base_64" => true,
        "max_width" => 300
    ],

    'company_license_license_front' => [
        "path" => "company/license",
        "base_64" => true,
        "max_width" => 1024
    ],

    'company_license_license_backside' => [
        "path" => "company/license",
        "base_64" => true,
        "max_width" => 1024
    ],

    'report' => [
        "path" => "report"
    ],

    'project_image' => [
        "path" => "project",
        "base_64" => true,
        "max_width" => 1024,
        "crop" => true,
        "sizes" => [
            "large" => [600, 450],
            "medium" => [400, 300],
            "small" => [200, 150]
        ]
    ],

    'project_ground_plan' => [
        "path" => "project",
        "base_64" => true,
        "max_width" => 1024,
        "crop" => true,
        "size" => [800, 800]
    ],

    'project_progress' => [
        "path" => "project",
        "base_64" => true,
        "max_width" => 1024,
        "crop" => true,
        "size" => [800, 800]
    ],

    'project_gallery_image' => [
        "path" => "project_gallery",
        "base_64" => true,
        "max_width" => 1024,
        "crop" => true,
        "size" => [800, 800]
    ],
    //image of course
    'course_image' => [
        "path" => "course",
        "base_64" => true,
        "max_width" => 1024,
        "crop" => true,
        "size" => [800, 800]
    ]
];