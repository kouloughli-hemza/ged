<?php

namespace Kouloughli\Console\Commands;

use Illuminate\Console\Command;

class SeedFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:gedfile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generating Dummy documents to GED Mila';

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
     * @return mixed
     */
    public function handle()
    {
        $this->call(\FileSeeder::class);

    }
}
