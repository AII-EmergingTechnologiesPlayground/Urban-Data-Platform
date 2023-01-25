@extends('layout')
@section('content')
    <div class="container mt-3">
        <h1 class="w-100 text-center py-3">{{ $type }}</h1>
        <div class="row">
            <div class="col bg-secondary text-white">
                <h1>Filters</h1>
            </div>
            <div class="col-9">

                @foreach($data as $sensor)
                    <div class="w-100 p-2 shadow-sm p-3 mb-5 bg-white rounded" style="background-color: white">
                        <h3>Sensor: {{ $sensor['id'] }} </h3>

                        <h4 class="mt-3">Beschikbare attributen</h4>
                        <ul>
                            @foreach($sensor as $key => $attr)
                                @if ( !in_array($key, ['id','type'], true ) )
                                    <a href="{{ route('sensor.history', ['type' => $sensor['type'], 'id' => $sensor['id'], 'attr' => $key]) }}">
                                        <li>{{ $key }}</li>
                                    </a>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
