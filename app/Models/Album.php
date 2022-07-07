<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Album
 *
 * @property int $id
 * @property string $name
 * @property int $artist_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Artist $artist
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Song[] $songs
 * @property-read int|null $songs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album query()
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereArtistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $cost
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereCost($value)
 */
class Album extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function albumsales()
    {
        return $this->belongsToMany(User::class, 'albumsale_users', 'album_id', 'user_id');
    }

    public function scopeAlbumbought($query, $userId)
    {
        return $query->whereHas('albumsales', function ($k) use($userId){
            $k->where('user_id', $userId);
        });
    }
}
