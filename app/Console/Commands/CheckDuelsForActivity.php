<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Duel;
use Artisan;

class CheckDuelsForActivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duel:checkForActivity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regular command for check is duels activity need switch';

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
     * @return int
     */
    public function handle()
    {
        $duels = Duel::where('deadline_date', '>', Carbon::now())->where('started_at', '<', Carbon::now())->get();
        $duels = $duels->map(function ($duel) {
            if ($duel->is_active === 0) {
                $duel->is_active = 1;
                $duel->save();
            }
        });
    }
}
