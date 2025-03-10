# Maintenance Mode for Laravel

This package provides a simple way to enable and disable maintenance mode for your Laravel application.

## Version

[![Latest Stable Version](https://poser.pugx.org/azmolla/maintenance-mode-laravel/v/stable)](https://packagist.org/packages/azmolla/maintenance-mode-laravel)

## Installation

You can install the package via composer:

```sh
composer require azmolla/maintenance-mode
```

## Configuration

After installing the package, publish the configuration file and assets:

```sh
php artisan maintenance-mode:publish
```

This will publish the configuration file to `config/maintenance-mode.php`, the views to `resources/views/vendor/maintenance-mode`, and the assets to `public/vendor/maintenance-mode`.

## Usage

### Middleware

Add the maintenance-mode middleware to your web middleware group in `app/Http/Kernel.php`:

```php
protected $middlewareGroups = [
    'web' => [
        // Other middleware
        \Azmolla\MaintenanceMode\Http\Middleware\CheckMaintenanceMode::class,
    ],
];
```

### Routes

The package provides routes for managing maintenance mode settings. These routes are defined in `src/routes/web.php`:

```php
Route::prefix('admin/maintenance')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [\Azmolla\MaintenanceMode\Controllers\MaintenanceModeController::class, 'index'])->name('admin.maintenance.index');
    Route::post('/update', [\Azmolla\MaintenanceMode\Controllers\MaintenanceModeController::class, 'update'])->name('admin.maintenance.update');
});
```

### Views

The package provides views for displaying and managing maintenance mode settings. These views are located in `src/resources/views`.

### Database

The package includes a migration for creating the `maintenance_mode` table. Run the migration:

```sh
php artisan migrate
```

## Commands

The package provides a command for publishing resources:

```sh
php artisan maintenance-mode:publish
```

## Change Log

### v1.0.0

- Initial release

## License

This package is open-sourced software licensed under the MIT license.

## Author

- [Abiruzzaman Molla](https://www.linkedin.com/in/abiruzzamanmolla/)

## Contributing

Feel free to submit issues or pull requests. For major changes, please open an issue first to discuss what you would like to change.

## Support

If you have any questions or need support, please open an issue on the [GitHub repository](https://github.com/AbiruzzamanMolla/azmolla-maintenance-mode-laravel/issues).