<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class FetchController extends Controller
{
    public function peoples()
    {
        $response = Http::get('https://randomuser.me/api/?nat=US&results=100');
        $peoples = $response->json();

        foreach ($peoples['results'] as $people) {
            $data = [
                "first_name" => $people['name']['first'],
                "last_name" => $people['name']['last'],
                "last_name" => $people['name']['last'],
                "dob" => Carbon::parse($people['dob']['date']),
                "gender" => $people['gender'],
                "street" => $people['location']['street']['number'] . ' ' . $people['location']['street']['name'],
                "city" => $people['location']['city'],
                "state" => $people['location']['state'],
                "country" => $people['location']['country'],
                "postal_code" => $people['location']['postcode'],
                "phone" => $people['phone'],
                "email" => $people['email'],
                "updated_at" => now(),
                "created_at" => $people['registered']['date'],
            ];
            $criteria = [
                "email" => $people['email'],
            ];
            People::updateOrCreate($criteria, $data);
        }

        return response()->json([
            'peoples' => People::orderBy('updated_at', 'desc')->get(),
            'message' => 'Data has been successfully retrieved'
        ]);
    }
}
