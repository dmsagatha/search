<?php

namespace App\Models;

// use App\Traits\Search;
use App\Traits\Searchable;
use App\Support\Sortable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use Notifiable;
  use TwoFactorAuthenticatable;
  // use Search;
  use Searchable;
  use Sortable;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'gender',
    'phone',
    'role_id'
  ];

  // use Search;
  /* protected $searchable = [
      'name',
      'email',
      'phone',
  ]; */

  // use Searchable;
  // public $searchable = ['name', 'email', 'phone'];
  public static function searchable()
  {
    return ['name', 'email', 'phone'];
  }

  /**
   * Un Usuario pertenece a 1 Rol
   */
  public function role(): BelongsTo
  {
    return $this->belongsTo(Role::class);
  }

  /**
   * Un Usuario tiene 1 o muchos Posts
   */
  public function posts(): HasMany
  {
    return $this->hasMany(Post::class);
  }






  
  /* protected $withCount = [
    'role',
    'posts'
  ]; */

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = [
    'profile_photo_url',
  ];
}