<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use App\Helpers\Permission;

class CheckPermission
{
    public function handle($request, Closure $next, $permission, $action)
{
    $userId = auth()->id();
    $Permission = new Permission(); // Create an instance of the Permission class

    $response = $Permission->checkPermission($userId, $permission, $action);

    if ($response->getStatusCode() !== 200) {
        abort(Response::HTTP_NOT_FOUND);
    }

    return $next($request);
}

}
