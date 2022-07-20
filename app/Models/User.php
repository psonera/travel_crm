<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = ['name', 'email', 'password', 'status'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}
