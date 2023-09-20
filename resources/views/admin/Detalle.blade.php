@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @php
            $id = request()->route('id');
            @endphp 
            <h2>{{$employeeNumber}}</h2>
            <detail-component :id="{{ $id }}"  :employeeNumber="{{$employeeNumber}}"></detail-component>
        </div>
    </div>
</div>
@endsection
