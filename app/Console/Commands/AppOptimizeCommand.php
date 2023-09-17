<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class AppOptimizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize laravel application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('optimize');

        $this->info('Your application has been optimized.');
    }
}
