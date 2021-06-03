<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Duel
 *
 * @property int $id
 * @property string $description
 * @property string $started_at
 * @property string $deadline_date
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $duelUsers
 * @property-read int|null $duel_users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel whereDeadlineDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Duel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Duel extends Model
{
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'created_at', 
        'description',
        'started_at',
        'deadline_date',
        'is_active'
    ];

    public function getTimeToEnd(){
        if($this->is_active){
            $now = Carbon::now();
            $start = $this->started_at;
            $time_left =  $now->diffForHumans($start);
            return $time_left;
        }
    }

    public function duelUsers()
    {
        return $this->belongsToMany('App\User', 'duels_users')->withPivot(['is_participant', 'is_winner']);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
    

    // public function participants(){
    //     $all_users = $this->duelUsers;
    //     $participants = $all_users->filter(function($user){
    //         $user->avatar_url = $user->image !== null ? $user->image->path : Image::find(11)->path;
    //         return $user->pivot->is_participant === 1 ? $user : false;
    //     });
    //     return $participants;
    // }

    public function getWinner(){
        $winner = $this->participants->firstWhere('is_winner', 1);
        //dd($this->duelUsers);
        return $winner;
    }

}
