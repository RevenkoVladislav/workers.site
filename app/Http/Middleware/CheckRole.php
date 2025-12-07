<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $user = auth()->user();

        //пользователь не авторизован - вернуть на логин
        if(!$user) {
            return redirect()->route('login');
        }

        //получаем разрешенные роли передавать в middleware через :
        $allowedRoles = explode(',', $roles);

        //получить роль текущего пользователя
        $userRole = $user->role->name ?? null;

        //Если роль не входит в разрешенные то 403
        if (!$userRole || !in_array($userRole, $allowedRoles)) {
            abort(403);
        }

        return $next($request);
    }
}
