<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository) 
    {
        $this->clientRepository = $clientRepository;
    }
    public function store(ClientRequest $request)
    {
        $client = new CLient($request->validated());
        $this->clientRepository->save($client);
        return response()->json($client, Response::HTTP_CREATED);
    }
    
    public function update(Request $request, Client $client)
    {
        //
    }

    public function destroy(Client $client)
    {
        //
    }
}
