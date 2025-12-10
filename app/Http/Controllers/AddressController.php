<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AddressResource::collection(Address::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'street' => ['required', 'string'],
            'cep'  => ['required', 'string'],
        ]);

        $address = Address::create($data);

        return response()->json($address, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $data = $request->validate([
            'street' => ['sometimes', 'required', 'string'],
            'cep'  => ['sometimes', 'required', 'string'],
        ]);

        $address->update($data);

        return response()->json($address, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json(null, 204);
    }
}
