@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-4">
      @if ($viewData["product"]["image"])
        <img src="{{ asset($viewData["product"]["image"]) }}" class="img-fluid rounded-start" alt="{{ $viewData["product"]["name"] }}">
      @else
        <img src="{{ asset('/img/safe.jpg') }}" class="img-fluid rounded-start" alt="Placeholder Image">
      @endif
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">
          {{ $viewData["product"]["name"] }} ({{ $viewData["product"]["price"] }} €)
        </h5>
        <p class="card-text">{{ $viewData["product"]["description"] }}</p>
        <p class="card-text"><small class="text-muted">Add to Cart</small></p>
      </div>
    </div>
  </div>
</div>
@endsection
