<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $gaurded = [
        'id',
        'is_admin',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'bio', 
        'profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {

        return $this->hasMany('App\Models\Post');
    }

    public function numberOfPosts() {

        $count = 0;

        $posts = Post::all();

        foreach ($posts as $post) {

            if ($post->user_id == $this->id) {

                $count++;
            }
        }

        return $count;
    }
}
