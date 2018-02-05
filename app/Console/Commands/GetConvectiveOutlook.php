<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Services\WeatherData;
use Illuminate\Console\Command;

class GetConvectiveOutlook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wc:convective-outlook-import';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Convective Outlook';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $hailMap;

    public function __construct(WeatherData $weatherData)
    {
        parent::__construct();
        $this->weatherData = $weatherData;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->weatherData->outlook();
    }
}