@extends('transactions.layout')

@section('title', 'Edit Transaction')

@section('content')
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Transaction</h2>

        <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="employee_name" class="block text-sm font-medium text-gray-700">Employee Name</label>
                <input type="text" name="employee_name" id="employee_name"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                       value="{{ old('employee_name', $transaction->employee_name) }}" required>
                @error('employee_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sender_name" class="block text-sm font-medium text-gray-700">Sender Name</label>
                <input type="text" name="sender_name" id="sender_name"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                       value="{{ old('sender_name', $transaction->sender_name) }}" required>
                @error('sender_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sender_transaction_number" class="block text-sm font-medium text-gray-700">Sender Transaction Number</label>
                <input type="text" name="sender_transaction_number" id="sender_transaction_number"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                       value="{{ old('sender_transaction_number', $transaction->sender_transaction_number) }}" required>
                @error('sender_transaction_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="receiver_transaction_number" class="block text-sm font-medium text-gray-700">Receiver Transaction Number</label>
                <input type="text" name="receiver_transaction_number" id="receiver_transaction_number"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                       value="{{ old('receiver_transaction_number', $transaction->receiver_transaction_number) }}" required>
                @error('receiver_transaction_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" id="amount" step="0.01"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                       value="{{ old('amount', $transaction->amount) }}" required>
                @error('amount')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('transactions.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    Update Transaction
                </button>
            </div>
        </form>
    </div>
@endsection
