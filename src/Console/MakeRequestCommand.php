<?php

namespace Photogabble\LumenFormRequest\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRequestCommand extends Command {

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

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
    protected $description = 'Creates a new API Request in the app/Http/Requests path.';

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! file_exists(base_path('app/Http')) && ! mkdir(base_path('app/Http'))) {
            $this->error('unable to create destination path');
        }

        if (! file_exists(base_path('app/Http/Requests')) && ! mkdir(base_path('app/Http/Requests'))) {
            $this->error('unable to create destination path');
        }

        $namespace = $this->laravel->getNamespace() . 'Http\\Requests';
        $path = base_path('app/Http/Requests');
        $name = ucfirst($this->argument('name')).'Request';
        $filePathname = $path . DIRECTORY_SEPARATOR . $name . '.php';

        if (file_exists($filePathname)) {
            $this->error($name . ' already exists!');
            return 1;
        }

        $stub = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'request.stub');
        $stub = str_replace('DummyNamespace', $namespace, $stub);
        $stub = str_replace('DummyRequest',  $name, $stub);

        file_put_contents($filePathname, $stub);

        return 0;
    }

}