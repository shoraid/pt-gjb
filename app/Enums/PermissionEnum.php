<?php

namespace App\Enums;

class PermissionEnum
{
    const USERS = 'users';
    const USERS__LIST = 'users.list';
    const USERS__DETAIL = 'users.detail';
    const USERS__CREATE = 'users.create';
    const USERS__UPDATE = 'users.update';
    const USERS__DELETE = 'users.delete';

    const ROLES = 'roles';
    const ROLES__LIST = 'roles.list';
    const ROLES__DETAIL = 'roles.detail';
    const ROLES__CREATE = 'roles.create';
    const ROLES__UPDATE = 'roles.update';
    const ROLES__DELETE = 'roles.delete';

    const PERMISSIONS = 'permissions';
    const PERMISSIONS__LIST = 'permissions.list';
    const PERMISSIONS__DETAIL = 'permissions.detail';
    const PERMISSIONS__CREATE = 'permissions.create';
    const PERMISSIONS__UPDATE = 'permissions.update';
    const PERMISSIONS__DELETE = 'permissions.delete';

    const NOTES = 'notes';
    const NOTES__LIST = 'notes.list';
    const NOTES__DETAIL = 'notes.detail';
    const NOTES__CREATE = 'notes.create';
    const NOTES__UPDATE = 'notes.update';
    const NOTES__DELETE = 'notes.delete';
}
