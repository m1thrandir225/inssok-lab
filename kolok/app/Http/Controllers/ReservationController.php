<?php

namespace App\Http\Controllers;

use App\Actions\CancelReservationAction as ActionsCancelReservationAction;
use App\Actions\ConfirmReservationAction as ActionsConfirmReservationAction;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource as ResourcesReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('status');

        $reservations = Reservation::query()
            ->where('status', 'like', "%$searchQuery%")
            ->paginate();
        return ResourcesReservationResource::collection($reservations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        //
        $reservation = Reservation::query()
            ->create($request->validated());
        return ResourcesReservationResource::make($reservation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
        return ResourcesReservationResource::make($reservation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
        $reservation->update($request->validate());

        return ResourcesReservationResource::make($reservation);
    }

    public function cancelReservation(Reservation $reservation)
    {
        (new ActionsCancelReservationAction)->execute($reservation);

        return ResourcesReservationResource::make($reservation);
    }

    public function confirmReservation(Reservation $reservation)
    {
        (new ActionsConfirmReservationAction)->execute($reservation);

        return ResourcesReservationResource::make($reservation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
        $reservation->delete();
        return JsonResource::make([
            'message' => 'Review deleted successfully'
        ]);
    }
}
