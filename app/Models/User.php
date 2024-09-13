<?php

namespace App\Models;

use App\Models\Address as Address;
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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function get_addresses($user_id)
    {
        return Address::get_by_user_id($user_id);
    }

    public static function create_address(Address $address, int $user_id): void
    {
        $address->insert($user_id);
    }

    public static function update_address(Address $address, int $user_id): void
    {
        $address->update($user_id);
    }

    public static function delete_address(int $address_id): void
    {
        Address::delete($address_id);
    }
}
