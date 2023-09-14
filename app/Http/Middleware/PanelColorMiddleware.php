<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanelColorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Verifique se há um usuário autenticado
        if (auth()->check()) {
            // Obtenha o valor de panel_color do usuário atual e defina como variável global
            $panelColor = UserDetail::where('user_id', auth()->user()->id)->first()->panel_color;

            // Defina a variável global
            config(['app.panel_color' => $panelColor]);
        }

        return $next($request);
    }

}
