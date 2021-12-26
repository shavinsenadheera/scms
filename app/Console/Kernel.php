<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel{
    protected $commands = [
    ];
    protected function schedule(Schedule $schedule){
        $schedule->command('command:thresholdmaterials')->dailyAt('6:00');
        $schedule->command('command:dueorder')->dailyAt('6:00');
    }
    protected function commands(){
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
