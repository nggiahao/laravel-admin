<?php

namespace Tessa\Admin\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    protected $progressBar;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install
                                {--timeout=300} : How many seconds to allow each process to run.
                                {--debug} : Show process output or not. Useful for debugging.';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return int Command-line output
     */
    public function handle()
    {
        return 1;
    }
}
