<?php

namespace App;

use App\Vacancy;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeAdmin($query)
    {
        return $query->where('is_admin', 1);
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function acceptedVacancies()
    {
        return $this->hasMany(Vacancy::class)->where('is_active', 1);
    }

    public function isTrusted()
    {
        return (bool)$this->acceptedVacancies->count();
    }

    public function isNotTrusted()
    {
        return (bool) !$this->isTrusted();
    }
}
