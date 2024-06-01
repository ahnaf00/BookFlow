<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'role'
    ];

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

    /**
     * Get the full name of the users
     *
     * @return Attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::get(
            fn (): string => $this->first_name . " " . $this->last_name
        );
    }

    /**
     * Check if the users is an admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === Role::ADMIN->toString();
    }

    /**
     * Check if the users is a general users
     *
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->role === Role::USER->toString();
    }
}
