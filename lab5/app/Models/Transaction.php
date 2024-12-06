<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        "employee_name",
        "sender_name",
        "sender_transaction_number",
        "receiver_transaction_number",
        "amount"
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "created_at" => "datetime",
            "updated_at" => "datetime",
        ];
    }
}
