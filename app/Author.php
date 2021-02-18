<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Poem;
use App\HistoryPerson;
use App\User;
/**
 * App\Author
 *
 * @property int $id
 * @property int $creator_id
 * @property string $creator_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $authors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Poem[] $poem
 * @property-read int|null $poem_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereCreatorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Author whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Author extends Model
{
    protected $fillable = [
        'creator_id',
        'creator_type'
    ];
    public $timestamps = true;

    /**
     * Get the comments for the blog post.
     */
    public function poem()
    {
        return $this->hasMany(Poem::class);
    }
    public function authors(){
        return $this->morphTo();
    }
}
