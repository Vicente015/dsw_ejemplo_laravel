@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
  @foreach ($viewData["products"] as $product)
  <div class="col-md-4 col-lg-3 mb-2">
    <div class="card">
      @if ($product["image"])
        <img src="{{ asset($product["image"]) }}" class="img-fluid rounded-start" alt="{{ $product["name"] }}">
      @else
        <img src="{{ asset('/img/safe.jpg') }}" class="img-fluid rounded-start" alt="Placeholder Image">
      @endif
      <div class="card-body text-center">
        <a href="{{ route('product.show', ['id'=> $product["id"]]) }}"
          class="btn bg-primary text-white">{{ $product["name"] }}</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
