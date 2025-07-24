<?php

return [
    'menu' => [
        'dashboard' => 'Dashboard',
        'users' => 'Users',
        'permissions' => 'Permissions',
        'roles' => 'Roles',
        'notes' => 'Notes',
    ],

    'dashboard' => [
        'buttons' => [],
        'titles' => [
            'index' => 'Home',
        ]
    ],

    'notes' => [
        'title' => 'Title',
        'content' => 'Content',
        'author' => 'Author',
        'archived' => 'Archived',
        'placeholders' => [
            'title' => 'Enter note title',
            'content' => 'Write your note here...',
        ],
        'titles' => [
            'index' => 'Notes',
            'create' => 'Create Note',
            'edit' => 'Edit Note',
            'show' => 'Note Details'
        ]
    ],

    'permissions' => [
        'id' => 'Id',
        'name' => 'Permission Name',
        'display_order' => 'Display Order',
        'description' => 'Description',
        'parent' => 'Parent',
        'children' => 'Children',
        'placeholders' => [
            'id' => 'users.list',
            'name' => 'User List',
            'display_order' => '10',
            'description' => 'Show all users',
        ],
        'titles' => [
            'index' => 'Permissions',
            'create' => 'Create Permission',
            'edit' => 'Edit Permission',
            'show' => 'Permission Details'
        ]
    ],

    'roles' => [
        'name' => 'Role Name',
        'description' => 'Description',
        'permissions' => 'Permissions',
        'placeholders' => [
            'name' => 'Administrator',
            'description' => 'An administrator is a person who can see all data.',
        ],
        'titles' => [
            'index' => 'Roles',
            'create' => 'Create Role',
            'edit' => 'Edit Role',
            'show' => 'Role Details'
        ]
    ],

    'users' => [
        'name' => 'Full Name',
        'email' => 'Email',
        'phone_number' => 'Phone Number',
        'image' => 'Image',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'roles' => 'Roles',
        'placeholders' => [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone_number' => '0812345',
            'password' => 'Type Your Password',
            'password_confirmation' => 'Retype Your Password',
        ],
        'titles' => [
            'index' => 'Users',
            'create' => 'Create User',
            'edit' => 'Edit User',
            'show' => 'User Details'
        ]
    ],

    'profile' => [
        'name' => 'Full Name',
        'email' => 'Email',
        'phone_number' => 'Phone Number',
        'image' => 'Image',
        'placeholders' => [
            'name' => 'John Doe',
            'phone_number' => '0812345',
        ],
        'titles' => [
            'edit' => 'Edit Profile',
            'show' => 'Profile'
        ]
    ],

    'buttons' => [
        'actions' => 'Actions',
        'add' => 'Add',
        'back' => 'Back',
        'delete' => 'Delete',
        'detail' => 'Detail',
        'edit' => 'Edit',
        'submit' => 'Submit',
    ],

    'general' => [
        'number' => '#',
        'action' => 'Action',
        'choose' => 'Choose',
        'yes' => 'Yes',
        'no' => 'No',
    ],

    'messages' => [
        'data_saved' => 'Data saved successfully',
        'data_deleted' => 'Data deleted successfully',
        'sure_to_delete' => 'Are you sure?',
        'unexpected_error' => 'Error',
        'successfully_registered' => 'Registration successful',
        'success' => 'Success',
    ],
];
