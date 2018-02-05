<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Services\HailMap;
use Illuminate\Console\Command;

class GetHailMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wc:hailmap-import {start?} {--fetch=true}';

    protected $start;
    protected $fetch;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Hail Map';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $hailMap;

    public function __construct(HailMap $hailMap)
    {
        parent::__construct();
        $this->hailMap = $hailMap;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->start = $this->argument('start') ?: Carbon::now()->subMonth()->format('Y-m-d');
        $this->fetch = $this->option('fetch') == 'true';
        
        if ($this->fetch) {
            $this->hailMap->get(
                $this->start,
                Carbon::now()->format('Y-m-d')
            );
        }

        $this->hailMap->import(
            $this->start,
            Carbon::now()->format('Y-m-d')
        );
    }
}
