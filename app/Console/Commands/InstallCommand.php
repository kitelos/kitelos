<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kitelos:install {--force} {--reload}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the KitElos admin panel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
            ['reload', null, InputOption::VALUE_NONE, 'Force the operation to refresh all Database', null],
        ];
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }
        return 'composer';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Publishing the Warehouse assets, database, and config files');
        // Publish only relevant resources on install
        $this->info('✔ Published the Warehouse assets, database, and config files');

        $this->line('');
        $this->line('---------------------------------------------------------');
        $this->line('Migrating the database tables into your application');
        if ( $this->options('reload') )
            $this->call('migrate:refresh', ['--force' => $this->option('force')]);
        else
            $this->call('migrate', ['--force' => $this->option('force')]);
        $this->info('✔ Migrated the database tables into your application');

        $this->line('');
        $this->line('---------------------------------------------------------');
        $this->line('Dumping the autoloaded files and reloading all new files');
        $composer = $this->findComposer();
        $process = new Process($composer.' dump-autoload');
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->run();
        $this->info('✔ Dumped the autoloaded files and reloading all new files');

        $this->line('');
        $this->line('---------------------------------------------------------');
        $this->line('Seeding data into the database');
        $this->call('db:seed');

        $this->info('✔ Seeded data into the database');

        $this->line('');
        $this->line('---------------------------------------------------------');
        $this->line('Adding the storage symlink to your public folder');
        $this->call('storage:link');
        $this->info('✔ The storage symlink to your public folder succeful');
        
        $this->line('');
        $this->line('Adding the default User Super Admin');
        $headers = ['Usuario', 'Contraseña'];
        $user = [['usuario' => 'admin@admin.com', 'contraseña' => 'password']];
        $this->table($headers, $user);
        $this->info('✔ This are Credentials a default User Super Admin');

        $this->line('');
        $this->info('✔ Successfully installed KitElos! Enjoy');
    }
}
