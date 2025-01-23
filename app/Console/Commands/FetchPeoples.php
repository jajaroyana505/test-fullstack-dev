<?php

namespace App\Console\Commands;

use App\Models\People;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchPeoples extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-peoples';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
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
                "email" => $people['email'], // Menggunakan email sebagai kriteria unik
            ];
            People::updateOrCreate($criteria, $data);
        }

        $this->info('Movies fetched and saved successfully.');
    }
}
