<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'    => 'required|string|unique:clients,id',
            'name'  => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
        ]);

        $client = Client::create($request->all());
        return response()->json($client, 201);
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return response()->json($client);
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return response()->json(['message' => 'Client deleted successfully']);
    }
}
