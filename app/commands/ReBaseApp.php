<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Foundation\Artisan;

class ReBaseApp extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:rebase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the CMS to starting point.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->call('migrate:reset');
        $this->info('Migrations reset');
        $this->call('migrate', array('--bench' => 'Amitavroy/Mailing'));
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));
        $this->call('migrate', array('--bench' => 'amitavroy/sentryuser'));
        $this->call('migrate', array('--bench' => 'amitavroy/filemanaged'));
        $this->call('asset:publish', array('--bench' => 'amitavroy/sentryuser'));
        $this->call('cache:clear');
        $this->call('dump-autoload');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
// 			array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
// 			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}