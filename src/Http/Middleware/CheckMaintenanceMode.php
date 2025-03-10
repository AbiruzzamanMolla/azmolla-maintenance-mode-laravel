<?php

namespace Azmolla\MaintenanceMode\Http\Middleware;

use Azmolla\MaintenanceMode\Models\MaintenanceMode;
use Closure;
use Illuminate\Http\Request;

class CheckMaintenanceMode
{
    /**
     * @param  Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $settings = MaintenanceMode::getSettings();

        if ($settings && $settings->maintenance_mode) {
            // Allow admin routes to be accessed
            if ($request->is('admin/maintenance*')) {
                return $next($request);
            }

            // Return maintenance view
            return response()->view('maintenance-mode::maintenance', [
                'settings' => $settings,
            ]);
        }

        return $next($request);
    }
}
