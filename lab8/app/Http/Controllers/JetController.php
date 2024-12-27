<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJetRequest;
use App\Http\Requests\UpdateJetRequest;
use App\Http\Resources\JetResource;
use App\Models\Jet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class JetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $searchQuery = $request->input('search');

        $jets = Jet::query()
            ->where('name', 'like', '%'.$searchQuery.'%')
            ->orWhere('model', 'like', '%'.$searchQuery.'%')
            ->paginate();

        return JetResource::collection($jets);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJetRequest $request)
    {
        //
        $jet = Jet::query()
            ->create($request->validated());

        return JetResource::make($jet);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jet $jet)
    {
        //
        $jet->loadMissing('reviews');

        return JetResource::make($jet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJetRequest $request, Jet $jet)
    {
        //
        $jet->update($request->validated());
        return JetResource::make($jet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jet $jet)
    {
        //
        $jet->delete();
        return JsonResource::make([
            'message' => 'Successfully deleted Jet',
        ]);
    }
}
