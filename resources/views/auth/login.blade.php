@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-dark font-weight-bold">{{ __('Login') }}</div>

                <div class="card-body">
                    <login-component></login-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
