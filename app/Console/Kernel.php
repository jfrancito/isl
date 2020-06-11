<?php

namespace App\Console;

use App\Console\Commands\NotificacionDoctor;
use App\Console\Commands\NotificacionEnfermera;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        NotificacionDoctor::class,
        NotificacionEnfermera::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notificacion:doctor')->everyMinute(); // CADA MINUTO
        $schedule->command('notificacion:enfermera')->everyMinute(); // CADA MINUTO
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
