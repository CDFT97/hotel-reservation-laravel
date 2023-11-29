<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository) 
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        $clients = $this->clientRepository->all();
        return response()->json($clients, Response::HTTP_OK);
    }
    public function store(ClientRequest $request)
    {
        $client = new CLient($request->validated());
        $this->clientRepository->save($client);
        return response()->json($client, Response::HTTP_CREATED);
    }
    
    public function update(ClientRequest $request, Client $client)
    {
        $client->fill($request->validated());
        $this->clientRepository->save($client);
        return response()->json($client, Response::HTTP_OK);
    }

    public function destroy(Client $client)
    {
        try {
            $this->clientRepository->destroy($client);
            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => $th->getMessage(),], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
