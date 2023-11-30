@extends('layouts.app')

@section('content')
<div class="container">
    <history-component :users="{{ $usersLinks }}" :count="{{ $count }}"></history-component>
</div>
@endsection