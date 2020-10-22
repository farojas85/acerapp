@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><i class="fas fa-users"></i> Alumnos</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/registro">Inicio</a></li>
            <li class="breadcrumb-item active">Alumno</li>
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
                            Listado de Alumnos&nbsp;
                            <button type="button" class="btn bg-info btn-sm btn-nuevo" >
                                <i class="fas fa-plus"></i> Nuevo Alumno
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
                                                <th>C&oacute;digo</th>
                                                <th>DNI Alumno</th>
                                                <th>Nombres y Apellidos</th>
                                                <th>Clave</th>
                                                <th>Celular</th>
                                                <th>Escuela</th>
                                                <th>Distrito</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($alumnos as $alumno)
                                            <tr>
                                                <td>{{ $loop->iteration + $alumnos->firstItem() -1 }}</td>
                                                <td>{{ $alumno->CODE_A }}</td>
                                                <td>{{ $alumno->DNI_A }}</td>
                                                <td>{{ $alumno->NOM_A." ".$alumno->APP_A." ".$alumno->APM_A }}</td>
                                                <td>{{ $alumno->PSW_A }}</td>
                                                <td>{{ $alumno->CEL_A }}</td>
                                                <td>{{ $alumno->ESC_A }}</td>
                                                <td>{{ $alumno->DIS_A }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm btn-editar"
                                                        onclick="editar({{ $alumno->COD_A }})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="{{ route('alumno.destroy',$alumno->COD_A) }}"
                                                        title="Eliminar Alumno" class="btn btn-danger btn-sm destroy-alumno" >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr >
                                                <td colspan="7" class="text-center text-danger">--DATOS NO REGISTRADOS - TABLA VACÍA--</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <nav>
                                    @if ($alumnos->lastPage() > 0)
                                    <ul class="pagination">
                                        <li class="page-item {{ ($alumnos->currentPage() == 1) ? ' disabled' : '' }}">
                                            <a href="{{ $alumnos->url(1) }}" class="page-link">Anterior</a>
                                        </li>
                                        @for ($i = 1; $i <= $alumnos->lastPage(); $i++)
                                            <li class="page-item {{ ($alumnos->currentPage() == $i) ? ' active' : '' }}">
                                                <a href="{{ $alumnos->url($i) }}" class="page-link">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ ($alumnos->currentPage() == $alumnos->lastPage()) ? ' disabled' : '' }}">
                                            <a href="{{ $alumnos->url($alumnos->currentPage()+1) }}" class="page-link">Siguiente</a>
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
    <script src="{{asset('js/sistema/alumno.js')}}"></script>
@endsection
