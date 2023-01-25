@extends('layout')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col bg-secondary text-white">
                <h1>Filters</h1>
            </div>
            <div class="col-9">

                @foreach($data as $dataset)
                    <div class="w-100 p-2 shadow-sm p-3 mb-5 bg-white rounded" style="background-color: white">
                        <h3>{{ $dataset['type'] }} dataset</h3>
                        <p>Beschikbare set(s): {{ $dataset['count'] }}</p>
                        <h4 class="mt-3">Beschikbare attributen</h4>
                        <ul>
                            @foreach($dataset['attrs'] as $key => $attr)
                                <li>{{ $key }}</li>
                            @endforeach
                        </ul>
                        <div class="text-right">
                            <a class="btn btn-outline-primary" href="{{ route('single.dataset', ['type' => $dataset['type']]) }}" role="button">Ga naar dataset</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
