<?php

namespace Azmolla\MaintenanceMode\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceMode extends Model
{
    /**
     * @var string
     */
    protected $table = 'maintenance_mode';

    /**
     * @var array
     */
    protected $fillable = [
        'maintenance_mode',
        'maintenance_image',
        'maintenance_title',
        'maintenance_description',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'maintenance_mode' => 'boolean',
    ];

    public static function getSettings()
    {
        return self::first();
    }
}
