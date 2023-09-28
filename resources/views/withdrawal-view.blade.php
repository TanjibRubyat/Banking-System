<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


</x-app-layout>
<div class="">
    <div class="px-3" style="justify-content:center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (\Session::has('msg'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('msg') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('create-withdrawal') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="amount"
                                class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="double"
                                    class="form-control @error('amount') is-invalid @enderror" name="amount"
                                    value="{{ old('amount') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Withdraw
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>

    </div>
</div>
