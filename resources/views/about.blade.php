@extends('layouts.main')

@section('content')
    <h1>ABOUT page</h1>

    <div>
        Contact : {{ $name }} 
    </div>
    <div> {{$info['addr']}} ({{ $info['mail']}}) </div>
@endsection