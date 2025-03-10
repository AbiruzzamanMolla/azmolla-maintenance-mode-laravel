<?php

namespace Azmolla\MaintenanceMode\Controllers;

use Azmolla\MaintenanceMode\Models\MaintenanceMode;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MaintenanceModeController extends Controller
{
    public function index()
    {
        $settings = MaintenanceMode::getSettings();
        return view('maintenance-mode::admin.maintenance-form', compact('settings'));
    }

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'maintenance_mode'        => 'boolean',
            'maintenance_title'       => 'required|string|max:255',
            'maintenance_description' => 'required|string',
            'maintenance_image'       => 'nullable|image|max:2048',
        ]);

        $settings = MaintenanceMode::getSettings();

        if ($request->hasFile('maintenance_image')) {
            // Delete old image if exists
            if ($settings->maintenance_image && file_exists(public_path($settings->maintenance_image))) {
                unlink(public_path($settings->maintenance_image));
            }

            // Store new image
            $image     = $request->file('maintenance_image');
            $imageName = 'maintenance_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/maintenance'), $imageName);

            $validated['maintenance_image'] = 'uploads/maintenance/' . $imageName;
        }

        $settings->update($validated);

        return redirect()->route('admin.maintenance.index')
            ->with('success', 'Maintenance settings updated successfully.');
    }
}
