@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tablero de Inicio</div>

                <div class="panel-body">
                    <h4 class="media-heading">
                        <div class="alert alert-success" role="alert">Ya te encuentras Logueado</div>
                    </h4>
                    <div class="jumbotron">
                      <h1>Bienvenido a Crypto</h1>
                      <p>Esto es una plataforma de pruebas, que tiene como objetivo probar diferentes formas de autenticarse de una manera eficiente y segura.</p>
                      <p><a class="btn btn-primary btn-lg" href="#webcamera" data-toggle="modal" data-target="#webcamera"><i class="fa fa-qrcode"></i>&nbsp;&nbsp;Escanear QR</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('popUpForms.form')
@endsection
