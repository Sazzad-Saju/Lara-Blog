<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    
    // protected $casts = [
    //     'password' => 'hashed',
    // ];
    
    //Mutator
    // public function setUsernameAttribute($password)
    // {
    //     $this->attributes['user_name'] = 'Foobar';
    // }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
        // $this->attributes['password'] = 'foobar';
    }
    
    //accessor
    public function getUserNameAttribute($value)
    {
        return ucwords('$value');
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
