<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegenerateDB extends Command
{
    protected $signature = 'regenerate:db';

    protected $description = 'Regenerate Database with Seeds and Passport';

    public function handle()
    {
        $this->call('key:generate');
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('passport:install');
        echo 'RESET COMPLETE';
    }
}
