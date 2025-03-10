<?php

namespace Azmolla\MaintenanceMode\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'maintenance-mode:publish {--force : Overwrite existing files}';

    /**
     * @var string
     */
    protected $description = 'Publish all maintenance mode resources';

    /**
     * @return int
     */
    public function handle()
    {
        $this->info('Publishing Maintenance Mode Resources...');

        $params = [
            '--provider' => "Azmolla\MaintenanceMode\MaintenanceModeServiceProvider",
        ];

        if ($this->option('force')) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', array_merge($params, ['--tag' => 'maintenance-mode-config']));
        $this->call('vendor:publish', array_merge($params, ['--tag' => 'maintenance-mode-views']));
        $this->call('vendor:publish', array_merge($params, ['--tag' => 'maintenance-mode-assets']));

        $this->info('Maintenance Mode resources published successfully!');

        return 0;
    }
}
