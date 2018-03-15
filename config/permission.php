<?php
return [
    "permission" => [
        "model" => "Admin",
        "permissions" => [
            "admin.index" => "Admin index"
        ]
    ],


    "user" => [
        "model" => "User",
        "permissions" => [
            "admin.user.index" => "User index",
            "admin.user.create" => "Create user",
            "admin.user.edit" => "Edit user",
            "admin.user.destroy" => "Delete user",
            "admin.user.set.permission" => "Set permissions"
        ]
    ],

    "role" => [
        "model" => "Role",
        "permissions" => [
            "admin.role.index" => "Role index",
            "admin.role.create" => "Create role",
            "admin.role.edit" => "Edit role",
            "admin.role.destroy" => "Delete role"
        ]
    ],

    "system" => [
        "model" => "System",
        "permissions" => [
            "admin.system.edit" => "Edit system config",
        ]
    ],

    "students" => [
        "model" => "Students",
        "permissions" => [
            "admin.students.index" => "Students index",
            "admin.students.create" => "Create students",
            "admin.students.edit" => "Edit students",
            "admin.students.destroy" => "Delete students"
        ]
    ],
];
