<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Artisan;
use App\Duel;

class CheckDuelsForWinners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duel:check-for-winners';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'loop for calling check-winner';

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
        $active_duels = Duel::where('is_active', 1)->get();
       $expired_duels = $active_duels->transform(function($duel) {
        if($duel->deadline_date < Carbon::now()){
            return $duel;
        }
       });
      foreach($expired_duels as $expired_duel){
          Artisan::call('deul:check-winner', ['--duel_id' => $expired_duel->id]);
      }
    }
}
