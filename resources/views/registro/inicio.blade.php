@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Entrega de Raci&oacute;n</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
            <li class="breadcrumb-item active">Registro</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row" v-show="nuevo_prestamo=='nada'">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Listado de Registro
                            <button type="button" class="btn bg-info btn-sm btn-nuevo" >
                                <i class="fas fa-plus"></i> Nuevo Entrega Raci&oacute;n
                            </button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered table-hover">
                                        <thead class="bg-navy">
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Alumno</th>
                                                <th>Detalle/Raci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($registros as $registro)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registro->FECHA_REG }}</td>
                                                <td>{{ $registro->HORA_REG }}</td>
                                                <td>{{  $registro->alumno->NOM_A." ".$registro->alumno->APP_A.' '.$registro->alumno->APM_A}}</td>
                                                <td>
                                                    @foreach ($registro->registro_detalles as $detalle)
                                                    {{ $detalle->PROD_DETREG }}
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-danger text-center">--DATOS NO REGISTRADOS --</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <nav>
                                    @if ($registros->lastPage() > 1)
                                    <ul class="pagination">
                                        <li class="page-item {{ ($registros->currentPage() == 1) ? ' disabled' : '' }}">
                                            <a href="{{ $registros->url(1) }}" class="page-link">Anterior</a>
                                        </li>
                                        @for ($i = 1; $i <= $registros->lastPage(); $i++)
                                            <li class="page-item {{ ($registros->currentPage() == $i) ? ' active' : '' }}">
                                                <a href="{{ $registros->url($i) }}" class="page-link">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ ($registros->currentPage() == $registros->lastPage()) ? ' disabled' : '' }}">
                                            <a href="{{ $registros->url($registros->currentPage()+1) }}" class="page-link">Siguiente</a>
                                        </li>
                                    </ul>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{asset('js/sistema/registro.js')}}"></script>
@endsection
