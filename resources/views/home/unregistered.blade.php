{{-- home.unregistered --}} 

@extends('layout')

@section('content')
  @php
    $title = __('messages.redirection'); 
  @endphp

  @include('title')

  <div class="container">
    <p>{{ __('messages.hi') }}</p>
    <p>{{ __('messages.unregisterd-user') }}</p>
    <p>{{ __('messages.thanks') }}</p>
  </div>
@endsection