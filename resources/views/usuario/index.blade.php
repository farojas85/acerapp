@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><i class="fas fa-user"></i> Usuarios</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
            <li class="breadcrumb-item active">Usuario</li>
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
                            Listado de Usuarios
                            <button type="button" class="btn bg-info btn-sm btn-nuevo" >
                                <i class="fas fa-plus"></i> Nuevo Usuario
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
                                                <th>DNI</th>
                                                <th>Nombre Usuario</th>
                                                <th>Nombres y Apellidos</th>
                                                <th>Moto</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $usuario)
                                            <tr>
                                                <td>{{ $loop->iteration + $users->firstItem() - 1  }}</td>
                                                <td>{{ $usuario->dni_user }}</td>
                                                <td>{{ $usuario->name }}</td>
                                                <td>{{ $usuario->nombres." ".$usuario->apellido_paterno." ".$usuario->apellido_materno }}</td>
                                                <td>
                                                    @if($usuario->moto_user == 1)
                                                    <span class="badge bg-success"> Tiene</span>
                                                    @else
                                                    <span class="badge bg-danger"> No tiene</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm btn-editar"
                                                        onclick="editar({{ $usuario->id }})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="{{ route('usuario.destroy',$usuario->id) }}"
                                                        title="Eliminar Usuario" class="btn btn-danger btn-sm destroy-usuario" >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr >
                                                <td colspan="6" class="text-center text-danger">--DATOS NO REGISTRADOS - TABLA VACÍA--</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <nav>
                                    @if ($users->lastPage() > 0)
                                    <ul class="pagination">
                                        <li class="page-item {{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
                                            <a href="{{ $users->url(1) }}" class="page-link">Anterior</a>
                                        </li>
                                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                                            <li class="page-item {{ ($users->currentPage() == $i) ? ' active' : '' }}">
                                                <a href="{{ $users->url($i) }}" class="page-link">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
                                            <a href="{{ $users->url($users->currentPage()+1) }}" class="page-link">Siguiente</a>
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
    <script src="{{asset('js/sistema/usuario.js')}}"></script>
@endsection
