<!-- Usamos, como plantilla, la vista layouts.app (/resources/views/layouts/app.blade.php) -->
@extends('layouts.app')

<!-- Inyectamos el texto que contiene el título en el yield "title" -->
@section("title", $viewData["title"])

<!-- Inyectamos el texto con el contenido de la página en el yield "content" -->
@section('content')

    <div class="row">
        @foreach ($viewData["productos"] as $producto)
          <div class="col-md-6 col-lg-4 mb-2">
            <img src="{{ asset("/img/{$producto['image']}") }}" class="img-fluid rounded">
            <a class="btn btn-primary" href={{route("products.info", ['key' => $producto['id']])}} role="button">{{$producto['nombre']}}</a>
        </div>
        @endforeach
    </div>

@endsection
