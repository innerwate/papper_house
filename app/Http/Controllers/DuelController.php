<?php

namespace App\Http\Controllers;

use App\Duel;
use App\User;
use App\Image;
use App\Poem;
use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class DuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $duels = Duel::all();

        $duels = $duels->map(function ($duel) use ($request) {
            // dd($duel);
            $currentParticipants = $duel->participants->filter(function ($participant) {
                
                    $participant->avatar_url = $participant->getParticipantAvatarUrl();
                    $participant->poem;
                    return $participant->is_current === 1 ? $participant : false;
            });
            $duel->participant1 = $currentParticipants->first()->id;
            $duel->participant2 = $currentParticipants->last()->id;
            $duel->participant1Poem = $currentParticipants->first()->poem_id;
            $duel->participant2Poem = $currentParticipants->last()->poem_id;
            $duel->userVote =  $this->getUserVote($request->user_id, $duel->id);
            
            $duel->winner = $this->getDuelWinner($duel);
            $duel->currentParticipants = $currentParticipants;
            return $duel;
        });
        return response()->json($duels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'participant1' => 'required',
            'participant2' => 'required',
            'participant1Poem' => 'required',
            'participant2Poem' => 'required',
            'startedAt' => 'required',
            'deadline' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        } else {
            $duel = new Duel;
            $duel->started_at = $request->startedAt;
            $duel->deadline_date = $request->deadline;
            $duel->description = $request->description ? $request->description : '';
            $duel->is_active = 0;
            $duel->save();
            $users = collect([User::find($request->participant1), User::find($request->participant2)]);
            $participant1Poem = $request->participant1Poem;
            $participant2Poem = $request->participant2Poem;
            $users->first()->poem = Poem::find($participant1Poem);
            $users->last()->poem = Poem::find($participant2Poem);
            $this->regParticipants($users, $duel, false);
            // $this->regParticipant($request->participant1, $duel, $request->participant1Poem);
            // $this->regParticipant($request->participant2, $duel, $request->participant2Poem);
            return response()->json($duel->with('participants'));
            //$poem->categories()->associate(Category::find($request->category));
        }
    }

    private function regParticipants($users, $duel, $is_update)
    {
        if ($is_update) {
            $participants = $this->disableDuelParticipants($duel);
            $users->map(function ($user) use ($participants, $duel) {
                if ($participants->contains('author_id', $user->creators)) {
                    $participant = $participants->firstWhere('author_id', $user->creators->first());
                } else {
                    $participant = new Participant;
                }
                $participant->is_current = 1;
                $participant->duel()->associate($duel);
                $participant->poem()->associate($user->poem);
                $participant->author()->associate($user->creators->first());
                $participant->save();
            });
        } else {
            $users->map(function ($user) use ($duel) {
                $participant = new Participant;
                $participant->is_current = 1;
                $participant->duel()->associate($duel);
                $participant->poem()->associate($user->poem);
                $participant->author()->associate($user->creators->first());
                $participant->save();
            });
        }
    }

    private function disableDuelParticipants($duel)
    {
        $participants = $duel->participants;
        $participants->map(function ($participant) {
            $participant->is_current = 0;
            $participant->save();
        });
        return $participants;
    }

    private function updateParticipant($user_id, $duel, $poem_id)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Duel  $duel
     * @return \Illuminate\Http\Response
     */
    public function show(Duel $duel)
    {
        $currentParticipants = $duel->participants->filter(function ($participant) {
            if ($participant->is_current === 1) {
                return $participant;
            }
        });
        $duel->participant1 = $currentParticipants->first()->author->creators->id;
        $duel->participant2 = $currentParticipants->last()->author->creators->id;
        $duel->participant1Poem = $currentParticipants->first()->poem_id;
        $duel->participant2Poem = $currentParticipants->last()->poem_id;
        $duel->winner = $this->getDuelWinner($duel);
        $currentParticipants->map(function ($participant) {
            $participant->avatar_url = $participant->getParticipantAvatarUrl();
            $participant->poem;
            return $participant;
        });
        $duel->deadline_date = Carbon::parse($duel->deadline_date)->toDateTimeLocalString();
        $duel->started_at = Carbon::parse($duel->started_at)->toDateTimeLocalString();
        return response()->json($duel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Duel  $duel
     * @return \Illuminate\Http\Response
     */
    public function edit(Duel $duel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Duel  $duel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'duel_id'   =>  'required',
            'participant1' => 'required',
            'participant2' => 'required',
            'participant1Poem' => 'required',
            'participant2Poem' => 'required',
            'startedAt' => 'required',
            'deadline' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        } else {
            $duel = Duel::find($request->duel_id);
            $duel->started_at = $request->startedAt;
            $duel->deadline_date = $request->deadline;
            $duel->description = $request->description ? $request->description : '';
            $duel->save();
            $users = collect([User::find($request->participant1), User::find($request->participant2)]);
            $participant1Poem = $request->participant1Poem;
            $participant2Poem = $request->participant2Poem;
            $users->first()->poem = Poem::find($participant1Poem);
            $users->last()->poem = Poem::find($participant2Poem);
            $this->regParticipants($users, $duel, true);
            return response()->json($duel->with('participants'));
            //$poem->categories()->associate(Category::find($request->category));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Duel  $duel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $duel = Duel::find($request->duel_id);
        $duel->delete();
        return response()->json('success');
    }

    public function getDuelWinner(Duel $duel)
    {
        return $duel->getWinner();
    }

    public function getUserVote($user_id, $duel_id)
    {
        $user = User::find($user_id);
        $duel = Duel::find($duel_id);
        $voted = $user->participants->firstWhere('duel_id', $duel->id);
        return $voted;
    }

    public function setUserVote(Request $request)
    {
        $vote = User::find($request->user_id)->participants()->attach($request->participant_id);
        return response()->json($vote);
    }
}
