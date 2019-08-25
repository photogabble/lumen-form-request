<?php

namespace Photogabble\LumenFormRequest\Console;

use Illuminate\Console\Command;

class MakeRequestCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api-request {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new user to the database';

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
        $path = base_path('app/Http/Requests');
        $this->line($path);

        return 0;
    }

}