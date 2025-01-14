<?php

namespace App\Actions;

use App\Enums\ReservationStatusEnum;
use App\Models\Reservation;

class ConfirmReservationAction
{
    public function execute(Reservation $reservation): void
    {
        $reservation->update([
            'status' => ReservationStatusEnum::CONFIRMED,
        ]);
    }
}
