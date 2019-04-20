{{-- home.unregistered --}} 

@extends('layout')

@section('content')
  @php
    $title = "Página Principal"; 
  @endphp

  @include('title')

  <div class="container">
    <p>Hola</p>
    <p>Para usar Kodelia debes registrate</p>
    <p>Gracias</p>
  </div>
@endsection