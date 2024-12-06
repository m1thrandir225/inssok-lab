@extends('transactions.layout')

@section('title', 'Transaction Details')

@section('content')
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Transaction Details</h2>

        <div class="space-y-4">
            <div>
                <span class="font-medium text-gray-700">Employee Name:</span>
                <p class="text-gray-900">{{ $transaction->employee_name }}</p>
            </div>

            <div>
                <span class="font-medium text-gray-700">Sender Name:</span>
                <p class="text-gray-900">{{ $transaction->sender_name }}</p>
            </div>

            <div>
                <span class="font-medium text-gray-700">Sender Transaction Number:</span>
                <p class="text-gray-900">{{ $transaction->sender_transaction_number }}</p>
            </div>

            <div>
                <span class="font-medium text-gray-700">Receiver Transaction Number:</span>
                <p class="text-gray-900">{{ $transaction->receiver_transaction_number }}</p>
            </div>

            <div>
                <span class="font-medium text-gray-700">Amount:</span>
                <p class="text-gray-900">${{ number_format($transaction->amount, 2) }}</p>
            </div>

            <div>
                <span class="font-medium text-gray-700">Created At:</span>
                <p class="text-gray-900">{{ $transaction->created_at->format('Y-m-d H:i:s') }}</p>
            </div>

            <div>
                <span class="font-medium text-gray-700">Updated At:</span>
                <p class="text-gray-900">{{ $transaction->updated_at->format('Y-m-d H:i:s') }}</p>
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('transactions.edit', $transaction) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    Edit Transaction
                </a>
                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                        Delete Transaction
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
