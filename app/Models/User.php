<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordAdminNotification;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordAdminNotification($token));
    }

    public function getUserProfileAttribute()
    {
        if ('' != $this->profile_picture) {
            return asset('storage/userprofile/'.$this->profile_picture);
        } else {
            return asset('assets/images/user/default-user.jpg');
        }
    }

    public static function typeRoleList()
    {
        return [
            'super_admin' => 'Super Admin',
            'admin' => 'Administrator',
            'user' => 'End User'
        ];
    }

    public function getHumanRoleAttribute()
    {
        return static::typeRoleList()[$this->role];
    }

    public static function allowedRole()
    {
        return array_keys(static::typeRoleList());
    }

    public function permohonan_surat()
    {
        return $this->hasMany(PermohonanSurat::class, 'user_id');
    }

    public function history_permohonan_surat()
    {
        return $this->hasMany(HistoryPermohonanSurat::class, 'user_id');
    }
}
