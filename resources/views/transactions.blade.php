<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


</x-app-layout>
<div class="">
    <div class="px-3" style="justify-content:center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Transaction Type</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $user = DB::table('users')->leftJoin('transactions','users.id','=','transactions.user_id')->where('transaction_type',1)->where('users.id',auth()->user()->id)->get();
                    // @dd($user);
                @endphp
                @foreach($user as $data)
                {{-- @dd($data->user()); --}}

                <tr>
                    <th scope="row">1</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>Deposit</td>
                    <td>{{$data->amount}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>

    </div>
</div>
