<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Client};
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientAdminController extends Controller
{
    public $clients;

    public function __construct(Client $clients)
    {
        $this->clients     = $clients;
    }

    public function index(Request $request)
    {
        $clients = $this->clients->when($request->search, function($query, $search) {
            $query->where('name', 'LIKE', '%'.$search.'%');
        })->paginate(15);
        
        return Inertia::render('Admin/Clients/Index', [
            'clients' => $clients,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Clients/Create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->clients->create($data);

        return redirect()->route('admin.clients.index');
    }

    public function edit(Request $request)
    {
        $client    = $this->clients->where('id', $request->route('clientAdmin'))->firstOrFail();
        
        return Inertia::render('Admin/Clients/Edit', ['client' => $client]);
    }

    public function update(Request $request)
    {
        $client    = $this->clients->where('id', $request->route('clientAdmin'))->firstOrFail();
        
        $client->update($request->all());
        return redirect()->route('admin.clients.index');
    }

    public function destroy(Request $request)
    {
        $client    = $this->clients->where('id', $request->route('clientAdmin'))->firstOrFail();
        $client->delete();
        return redirect()->route('admin.clients.index');
    }
}
