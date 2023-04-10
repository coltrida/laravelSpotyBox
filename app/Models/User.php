<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Builder;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Song[] $albumsales
 * @property-read int|null $albumsales_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Song[] $preferites
 * @property-read int|null $preferites_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Song[] $songsales
 * @property-read int|null $songsales_count
 * @method static \Illuminate\Database\Eloquent\Builder|User ute()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isUte() {
        return $this->role === 'user';
    }

    public function isArtist() {
        return $this->role === 'artist';
    }

    public function scopeUte($builder)
    {
        return $builder->where('role', 'user');
    }

    public function preferites()
    {
        return $this->belongsToMany(Song::class, 'preferites_users', 'user_id', 'song_id');
    }

    public function songsales()
    {
        return $this->belongsToMany(Song::class, 'songsale_users', 'user_id', 'song_id');
    }

    public function albumsales()
    {
        return $this->belongsToMany(Album::class, 'albumsale_users', 'user_id', 'album_id');
    }

    public function artistsales()
    {
        return $this->belongsToMany(Artist::class, 'artistsale_users', 'user_id', 'artist_id');
    }

    public function artist()
    {
        return $this->hasOne(Artist::class);
    }

}
