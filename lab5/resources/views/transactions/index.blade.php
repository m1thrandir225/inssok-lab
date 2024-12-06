@extends('transactions.layout')

@section('title', 'Transactions List')

@section('content')
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-3 text-left">ID</th>
                <th class="px-4 py-3 text-left">Employee Name</th>
                <th class="px-4 py-3 text-left">Sender Name</th>
                <th class="px-4 py-3 text-left">Amount</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <tr class="border-b">
                    <td class="px-4 py-3">{{ $transaction->id }}</td>
                    <td class="px-4 py-3">{{ $transaction->employee_name }}</td>
                    <td class="px-4 py-3">{{ $transaction->sender_name }}</td>
                    <td class="px-4 py-3">${{ number_format($transaction->amount, 2) }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('transactions.show', $transaction) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                        <a href="{{ route('transactions.edit', $transaction) }}" class="text-green-500 hover:text-green-700 mr-2">Edit</a>
                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $transactions->links() }}
@endsection
