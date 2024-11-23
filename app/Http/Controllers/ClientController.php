<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreClientRequest;
use App\Http\Request\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

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
        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        return redirect()->route('clients.index');
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
            'status' => $request->status,
        ]);

        return redirect()->route('clients.index');
    }
}
