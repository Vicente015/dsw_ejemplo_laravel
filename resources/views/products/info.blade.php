<!-- Usamos, como plantilla, la vista layouts.app (/resources/views/layouts/app.blade.php) -->
@extends('layouts.app')

<!-- Inyectamos el texto que contiene el título en el yield "title" -->
@section("title", $viewData["title"])

<!-- Inyectamos el texto con el contenido de la página en el yield "content" -->
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset("/img/{$viewData['producto']['imagen']}") }}" alt="{{ $viewData["producto"]["nombre"] }}" class="img-fluid">
            </div>

            <div class="col-md-6">
                <h2>{{ $viewData["producto"]["nombre"] }}</h2>
                <p>{{ $viewData["producto"]["descripcion"] }}</p>
                <p>Precio: ${{ $viewData["producto"]["precio"] }}</p>
            </div>
        </div>
    </div>

@endsection
