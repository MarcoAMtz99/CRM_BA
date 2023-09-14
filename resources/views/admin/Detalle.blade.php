@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @php
            $id = request()->route('id');

            $export = Auth::user()->name == 'Admin' ? true:false;
            @endphp 
            <detail-component :id="{{ $id }}" :user="{{ $export }}"></detail-component>
        </div>
    </div>
</div>
@endsection
