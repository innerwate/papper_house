<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Author;
use App\User;
use App\Group;
/**
 * App\Poem
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $author_id
 * @property string $year_of_created
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Author $author
 * @property-read \App\Group $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $userRating
 * @property-read int|null $user_rating_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Poem whereYearOfCreated($value)
 * @mixin \Eloquent
 */
class Poem extends Model
{
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'content', 
        'author_id',
        'year_of_created'
    ];
     /**
     * Get the post that owns the comment.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function userRating()
    {
        return $this->belongsToMany(User::class, 'users_poems_rating')->withPivot('rating');
    }
    
}
