<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Author;
use App\Poem;
use App\Duel;
use App\Image;

class Participant extends Model
{
    protected $fillable = [
        'duel_id',
        'author_id',
        'poem_id',
        'is_current'
    ];

    public $timestamps = true;

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function duel()
    {
        return $this->belongsTo(Duel::class);
    }

    public function poem()
    {
        return $this->belongsTo(Poem::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function getUserByParticipant(){
        dd(Participant::find(2)->author->creators);
        $user = $this->author->creator;
        return $user;
    }

    public function getParticipantAvatarUrl(){
        //dd($this->author->creators->image);
        //dd(Image::find($this->author->creators->image_id));
        if(!is_null($this->author->creators)){
            return Image::find($this->author->creators->image_id)->path;
        }
        else{
            return Image::find(18)->path;
        }
    }

    public function getParticipantVotes(){
        //dd((int)$this->users->count());
        return !is_null($this->users) ? (int)$this->users->count() : 0;
    }
}
