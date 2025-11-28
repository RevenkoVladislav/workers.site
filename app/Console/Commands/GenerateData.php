<?php

namespace App\Console\Commands;

use App\Models\Worker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateData extends Command
{
    protected $signature = "generate:data
                            {--workers=0 : generate N workers}
                            {--reset : Reset table Workers } ";

    protected $description = 'Generate workers data for testing';

    public function handle()
    {
        if ($this->option('reset')) {
            try {
                Worker::truncate();
                $this->info('Reset Workers table done');
            } catch (\Throwable $error) {
                DB::rollBack();
                $this->error("Reset failed: {$error->getMessage()}");
            }
        }

        if ($this->option('workers') > 0) {
            try {
                DB::beginTransaction();
                Worker::factory($this->option('workers'))->create();
                DB::commit();
                $this->info('Workers created: ' . $this->option('workers'));
            } catch (\Throwable $error) {
                DB::rollback();
                $this->error("Error: {$error->getMessage()}");
            }
        } else {
            $this->info('No workers specified');
        }
    }
}
