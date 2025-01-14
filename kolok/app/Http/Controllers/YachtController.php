<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreYachtRequest as RequestsStoreYachtRequest;
use App\Http\Requests\UpdateYachtRequest as RequestsUpdateYachtRequest;
use App\Http\Resources\YachtResource;
use App\Models\Yacht;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class YachtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        //
        $searchQuery = $request->input('search');
        $yachts = Yacht::query()
            ->where('name', 'like', "%$searchQuery%")
            ->orWhere('type', 'like', "%$searchQuery%")
            ->paginate();

        return YachtResource::collection($yachts);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsStoreYachtRequest $request)
    {
        //
        $yacht = Yacht::query()->create($request->validated());

        return YachtResource::make($yacht);
    }

    /**
     * Display the specified resource.
     */
    public function show(Yacht $yacht)
    {
        //
        return YachtResource::make($yacht);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsUpdateYachtRequest $request, Yacht $yacht)
    {
        //
        $yacht->update($request->validated());

        return YachtResource::make($yacht);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Yacht $yacht)
    {
        //
        $yacht->delete();

        return JsonResource::make([
            'message' => 'Yacht deleted successfully',
        ]);
    }
}
