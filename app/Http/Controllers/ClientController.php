<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreClientRequest;
use App\Http\Request\UpdateClientRequest;
use App\Mail\RegisterUserMail;
use App\Models\Client;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::query();
        if($request->has('name') && $request->name !='') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if($request->has('status') && $request->status) {
            $query->whereIn('status', $request->status);
        }
        $clients = $query->paginate(10);

        $statuses = Client::STATUSES;

        return view('clients.index', compact('clients', 'statuses'));
    }

    public function create()
    {
        $statuses = Client::STATUSES;

        return view('clients.create', compact('statuses'));
    }

    public function store(StoreClientRequest $request)
    {
        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'status' => $request->status,
        ]);
        Mail::to($client->email)->queue(new RegisterUserMail($client));

        return redirect()->route('clients.index');
    }

    public function show(Client $client, WeatherService $weatherService)
    {
        $weather = null;
        if ($client->city) {
            $weather = $weatherService->getWeather($client->city);
        }
        $statuses = Client::STATUSES;

        return view('clients.show', compact('client', 'statuses', 'weather'));
    }

    public function edit(Client $client)
    {
        $statuses = Client::STATUSES;

        return view('clients.edit', compact('client', 'statuses'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'status' => $request->status,
        ]);

        return redirect()->route('clients.index');
    }
}
