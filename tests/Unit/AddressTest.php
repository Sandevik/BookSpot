<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase {

    use RefreshDatabase;

    public function test_get() {
        $actual_json = '[{"id": 1,"address_street": "TEST2","address_street_extra": "TEST3","address_city": "Mannheim","address_zip": "12345","address_country": "Germany","address_state": "Mannheim","label": "Secondary address","created_at": null,"updated_at": null},{"id": 1,"address_street": "TEST","address_street_extra": "TEST4","address_city": "Stockholm","address_zip": "12345","address_country": "Sweden","address_state": "Stockholm","label": "Primary address","created_at": null,"updated_at": null},{"id": 1,"address_street": "TEST5","address_street_extra": "TEST4","address_city": "Stockholm","address_zip": "12345","address_country": "Sweden","address_state": "Stockholm","label": "third address","created_at": null,"updated_at": null},{"id": 1,"address_street": "TEST5","address_street_extra": "TEST4","address_city": "Stockholm","address_zip": "12345","address_country": "Sweden","address_state": "Stockholm","label": "third address","created_at": null,"updated_at": null}]';
        
        $addresses = User::get_addresses(1);
        
        $this->assertJson($actual_json, json_encode($addresses));
        
    }
    
    public function test_create() {

        $addresses = User::get_addresses(1);
        $address_count_before = count($addresses);
        User::create_address(new Address("TestCase", null, null, null, null, null, "Some Label"), 1);
        $address_count_after = count(json_decode(User::get_addresses(1)));

        $this->assertTrue($address_count_after > $address_count_before && $address_count_before + 1 == $address_count_after, "Count has not changed");
    }
    
    public function test_update() {



        
        $this->assertTrue(true);
        
    }
    
    public function test_delete() {
        $this->assertTrue(true);

    }


}