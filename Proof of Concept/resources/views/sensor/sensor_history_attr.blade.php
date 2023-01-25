@extends('layout')
@section('content')

    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col">
                <h2>{{ $type }}, {{ $id }}, {{ $attr }}</h2>
            </div>
            <div class="col text-right">
                <a class="btn btn-outline-primary" href="{{ route('download', ['type' => $type, 'id' => $id, 'attr' => $attr]) }}" role="button">CSV download</a>
            </div>
        </div>


        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Waarde</th>
                <th scope="col">Ontvangen tijd</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr>
                    <td>{{ $value['attrValue'] }}</td>
                    <td>{{ $value['recvTime'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
