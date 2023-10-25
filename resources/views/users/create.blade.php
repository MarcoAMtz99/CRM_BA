@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear Usuario</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña (mínimo 8 caracteres)</label>
                            <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                        </div>

                        <div class="form-group">
                            <label for="employee_number_id">Número de Empleado</label>
                            <input type="number" class="form-control" id="employee_number_id" name="employee_number_id" required>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection