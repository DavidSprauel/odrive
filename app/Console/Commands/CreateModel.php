<?php

namespace OlympicDrive\Console\Commands;

use Illuminate\Console\Command;

class CreateModel extends Command
{
    protected $signature = 'olympic:model {model}';
    
    protected $description = 'Create Model in the right folder';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        Artisan::call('make:model', [
            'name' => $this->getAppNamespace().'Models\Entities\Eloquent\\'.$this->argument('model')
        ]);
        echo 'Model Successfully Created!';
    }
}
