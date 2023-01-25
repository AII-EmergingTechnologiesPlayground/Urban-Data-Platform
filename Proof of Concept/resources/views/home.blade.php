@extends('layout')
@section('content')
    <div class="container d-flex align-items-center" style="min-height: 100vh">
        <div class="box w-100">
            <h2 class="w-100 text-center">Welcome to UDP</h2>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Zoek criteria" aria-describedby="basic-addon2" disabled>
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button">Zoek</button>
                </div>
            </div>
        </div>
    </div>
@stop
