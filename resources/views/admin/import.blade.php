@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">   
            <div class="card">
                <div class="card-header">IMPORTAR CLIENTES</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong> 
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    
                    @endif

                    @if (session('invalidRecords'))

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <ul>
                                @foreach (session('invalidRecords') as $record)
                                    <li>Error con el registro : {{ json_encode($record['nombre'] . ' ' . $record['apellidoPaterno'] . ' ' . $record['apellidoMaterno'].' folio: '.$record['folio'].' campaign: '.$record['idCampania']. ' Direccion con errores'
                                        )
                                     }}</li>
                                @endforeach
                            </ul>
                        </div>              
                    @endif

                     <form action="{{ url('/import-csv') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                        <input type="file" name="csv_file">
                        </div>
                        <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Importar CSV</button>
                        </div>
                    </form>
                  
                </div>
            </div>

          
        </div>
    </div>

</div>
@endsection
