@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @php
            $id = request()->route('id');
            @endphp 
            <detail-component :id="{{ $id }}" :user="{{ Auth::user()->name }}"></detail-component>
        </div>
    </div>
</div>
@endsection
