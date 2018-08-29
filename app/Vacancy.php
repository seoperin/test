<?php

namespace App;

use App\User;
use App\Mail\AcceptVacancy;
use App\Mail\RejectVacancy;
use App\Mail\ModerateVacancyUser;
use App\Mail\ModerateVacancyAdmin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'text',
        'email',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeRejected($query)
    {
        return $query->where('is_active', 0);
    }

    public function scopeModeration($query)
    {
        return $query->whereNull('is_active');
    }

    public function scopeOrdered($query)
    {
        return $query->latest();
    }

    public function accept()
    {
        $this->is_active = 1;
        $this->save();
        Mail::to($this->user->email)->send(new AcceptVacancy($this));
    }

    public function reject()
    {
        $this->is_active = 0;
        $this->save();
        Mail::to($this->user->email)->send(new RejectVacancy($this));
    }

    public function sendToModeration()
    {
        $admins = User::admin()->pluck('email');
        Mail::to($admins)->send(new ModerateVacancyAdmin($this));
        Mail::to($this->user->email)->send(new ModerateVacancyUser($this));
    }
    
}
