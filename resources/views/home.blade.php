@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
           @include('components.dumps')
            @include('components.files')
            @include('components.export')


        </div>
    </div>
@endsection
