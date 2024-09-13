<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Address
{
    use HasFactory, Notifiable;

    protected $id;
    protected $address_street;
    protected $address_street_extra;
    protected $address_city;
    protected $address_zip;
    protected $address_country;
    protected $address_state;
    protected $label;

    public function __construct(?string $address_street, ?string $address_street_extra, ?string $address_city, ?string $address_zip, ?string $address_country, ?string $address_state, ?string $label)
    {
        // Här skulle jag implementera uuid eller något mycket säkrare för id
        $this->id = rand();
        $this->address_street = $address_street;
        $this->address_street_extra = $address_street_extra;
        $this->address_city = $address_city;
        $this->address_zip = $address_zip;
        $this->address_country = $address_country;
        $this->address_state = $address_state;
        $this->label = $label;
        return $this;
    }

    public function set_id(int $id): void
    {
        $this->id = $id;
    }

    public static function delete(int $address_id)
    {
        return DB::table("addresses")
            ->delete($address_id);
    }

    public function insert($user_id)
    {

        try {
            DB::table("user_addresses")->insert([
                "user_id" => $user_id,
                "address_id" => $this->id
            ]);

            DB::table("addresses")->insert([
                "id" => $this->id,
                "address_street" => $this->address_street,
                "address_street_extra" => $this->address_street_extra,
                "address_city" => $this->address_city,
                "address_zip" => $this->address_zip,
                "address_country" => $this->address_country,
                "address_state" => $this->address_state,
                "label" => $this->label,
            ]);
        } catch (Exception $err) {
            return $err;
        }
    }
    public function update($user_id)
    {

        try {
            DB::table("addresses")
                ->join("user_addresses", "user_addresses.address_id", "=", "addresses.id")
                ->where("user_addresses.user_id", "=", $user_id)
                ->where("addresses.id", "=", $this->id)
                ->update([
                    "address_street" => $this->address_street,
                    "address_street_extra" => $this->address_street_extra,
                    "address_city" => $this->address_city,
                    "address_zip" => $this->address_zip,
                    "address_country" => $this->address_country,
                    "address_state" => $this->address_state,
                    "label" => $this->label,
                ]);
        } catch (Exception $err) {
            return $err;
        }
    }

    public static function get_by_user_id(int $user_id)
    {
        return DB::table("users")
            ->join("user_addresses", "users.id", "=", "user_addresses.user_id")
            ->join("addresses", "user_addresses.address_id", "=", "addresses.id")
            ->select("addresses.*", "users.id")
            ->where("users.id", "=", $user_id)
            ->get();
    }
}
