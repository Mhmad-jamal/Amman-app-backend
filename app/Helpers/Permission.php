<?php

namespace App\Helpers;
use App\Models\UserRole;

class Permission
{
    public function checkPermission($user_id, $page, $action)
{
    $userRole = UserRole::where('user_id', $user_id)->first();

    if ($userRole) {
        $permissions = json_decode($userRole->Permission, true);

        // Loop through the permissions array
        foreach ($permissions as $permission) {
            if ($permission['pageId'] === $page && isset($permission['action'][$action]) && $permission['action'][$action] === 1) {
                return response()->json(['status' => 'OK'], 200);
            }
        }
    }

    // If the permission is not found or doesn't match the condition, return a different response
    return response()->json(['status' => 'Forbidden'], 403);
}


}