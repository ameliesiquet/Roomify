<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\CustomVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Notifications\CustomResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'firstname',
        'lastname',
        'username',
        'profile_photo_path',
        'total_budget',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'total_budget' => 'decimal:2',
        ];
    }
 /*   public function getAuthIdentifierName(): string
    {
        return 'username';
    }*/

    public function sendEmailVerificationNotification(): void
    {
        if ($this->email_verified_at === null) {
            $this->notify(new CustomVerifyEmail());
        }
    }
    public function sendPasswordResetNotification($token): void
    {
        $url = url(route('password.reset', ['token' => $token, 'email' => $this->email], false));

        $this->notify(new CustomResetPassword($token));
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

}
