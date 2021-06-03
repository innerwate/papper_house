<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Poem;
use App\Author;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Author[] $creators
 * @property-read int|null $creators_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Poem[] $poemRating
 * @property-read int|null $poem_rating_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $image_id
 * @property int|null $role_id
 * @property-read \App\Image|null $image
 * @property-read \App\Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Duel[] $userDuels
 * @property-read int|null $user_duels_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleId($value)
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'image_id', 'role_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function poemRating()
    {
        return $this->belongsToMany('App\Poem', 'users_poems_rating')->withPivot('rating');
    }

    public function userDuels()
    {
        return $this->belongsToMany('App\Duel');
    }


    public function creators()
    {
        return $this->morphMany(Author::class, 'creator');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function participants(){
        return $this->belongsToMany(Participant::class);
    }
}
