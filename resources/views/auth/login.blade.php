@extends('app.app')
@section('content')
<div class="row justify-content-center m-t-30">
    <div class="col col-lg-4">
        @if(session('errorLogin'))
            <div class="alert alert-danger">
                <p>{{ session('errorLogin') }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h1 class="h3">Ingreso</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Usuario</label>
                        <input type="text" name="name" id="name" placeholder="Nombre de usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-lg btn-block">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection