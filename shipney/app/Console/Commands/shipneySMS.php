<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class shipneySMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RequestSMS:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SMS Send';

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
        //
    }
}
