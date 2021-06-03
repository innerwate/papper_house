<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Author;
/**
 * App\HistoryPerson
 *
 * @property int $id
 * @property string $name
 * @property string $birthday
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Author[] $creators
 * @property-read int|null $creators_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HistoryPerson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HistoryPerson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HistoryPerson query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HistoryPerson whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HistoryPerson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HistoryPerson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HistoryPerson whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HistoryPerson whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Image $images
 */
class HistoryPerson extends Model
{
    public function creators()
    {
        return $this->morphMany(Author::class, 'creator');
    }

    public function image(){
        return $this->belongsTo(Image::class);
    }
}
