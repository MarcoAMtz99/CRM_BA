@extends('layouts.app')

@section('content')
<div class="container">
    <users-component :users="{{ $users }}"></users-component>
</div>
@endsection