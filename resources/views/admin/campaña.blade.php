@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">  
        @php
        $id = request()->route('id');
        @endphp 
            <campaign-component :id="{{ $id }}"></campaign-component>
        </div>
    </div>
</div>
@endsection
