<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

enum Status: string
{
    case Success = "{\"message\": \"Success.\"}";
    case Error = "{\"message\": \"An error occurred.\"}";
}

class AddressController extends Controller
{

    public function get(int $user_id)
    {
        $addresses = Address::get_by_user_id($user_id);
        return response()->json($addresses);
    }

    public function post(Request $request)
    {
        [$address, $inputs] = $this->request_to_address_and_array($request);
        assert($inputs["userId"] != null, "A userId is required to create an address");
        User::create_address($address, $inputs["userId"]);
        return json_encode(Status::Success);
    }

    public function put(Request $request)
    {
        [$address, $inputs] = $this->request_to_address_and_array($request);
        assert($inputs["id"] != null, "An address id is required to manipulate an address");
        assert($inputs["userId"] != null, "A userId is required to manipulate an address");
        $address->set_id($inputs["id"]);
        User::update_address($address, $inputs["userId"]);
        return json_encode(Status::Success);
    }

    public function delete(Request $request)
    {
        [$_, $inputs] = $this->request_to_address_and_array($request);
        assert($inputs["id"] != null, "An address id is required to manipulate an address");
        User::delete_address($inputs["id"]);
        return json_encode(Status::Success);
    }

    /**
     * @returns (parsed out) [Address, inputs] from the incomming request
     */
    private function request_to_address_and_array(Request $request): array
    {
        $inputs = json_decode($request->getContent(), true);
        $address = new Address(
            $inputs["addressStreet"],
            $inputs["addressStreetExtra"],
            $inputs["addressCity"],
            $inputs["addressZip"],
            $inputs["addressCountry"],
            $inputs["addressState"],
            $inputs["label"]
        );
        return [
            $address,
            $inputs
        ];
    }
}
