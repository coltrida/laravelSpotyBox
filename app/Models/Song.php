<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Song
 *
 * @property int $id
 * @property string $name
 * @property int $pref
 * @property int $album_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Album $album
 * @method static \Illuminate\Database\Eloquent\Builder|Song newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Song newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Song query()
 * @method static \Illuminate\Database\Eloquent\Builder|Song whereAlbumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Song whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Song whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Song whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Song wherePref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Song whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $cost
 * @method static \Illuminate\Database\Eloquent\Builder|Song whereCost($value)
 */
class Song extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getPlayAttribute()
    {
        return asset("/storage/songs/$this->id.mp3");
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function preferites()
    {
        return $this->belongsToMany(User::class, 'preferites_users', 'song_id', 'user_id');
    }
}
