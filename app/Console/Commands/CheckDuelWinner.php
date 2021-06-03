<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Duel;
use App\User;
use App\Author;
use App\Participant;
use Artisan;

class CheckDuelWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duel:check-winner 
    {--duel_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check duel winner';

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
       $duel = $this->getDuel();
       $duel->is_active = 0;
       $duel->save();
       $participants = $duel->participants;
       $participants->transform(function($participant){
        if($participant->is_current === 1){
            return $participant;
        }
       });
       //dd($participants);
       $votes = [];
      $participants =  $participants->map(function($participant) use ($votes){
            $participant->votes = $participant->getParticipantVotes();
            return $participant;
       });
       $votes = $participants->pluck('votes', 'id')->toArray();
       $winner_id = array_search(max($votes),$votes);
       $winner = Participant::find($winner_id);
       $winner->is_winner = 1;
       $winner->save();
    }

    /**
     * @return Integer|null
     */
    private function getDuel()
    {
        return $this->option('duel_id') ? Duel::find($this->option('duel_id')) : null;
    }
}
