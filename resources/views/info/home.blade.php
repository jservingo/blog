{{-- File: info\home.blade.php --}} 

@extends('layout')

@section('content')
    <section class="posts container">
        @if (isset($title))
            <h3>{{ $title }}</h3>
        @endif
        @foreach($posts as $post)
        <article class="post">
            @include($post->viewType('home'))    
            <div class="content-post">
                @include('posts.header')
                <h1>{{ $post->title }}</h1>
                <div class="divider"></div>
                <p>{{ $post->excerpt }}</p>
                <footer class="container-flex space-between">
                    <div class="read-more">
                        <a href="{{ route('post.show',$post,\Illuminate\Support\Str::slug($post->title)]) }}" class="text-uppercase c-green">Leer más</a>
                    </div>
                    @include('posts.tags')
                </footer>
            </div>
        </article>
        @endforeach

    </section><!-- fin del div.posts.container -->

    {{ $posts->render("pagination::default") }}

@endsection

@push('styles')
  <link rel="stylesheet" href="/css/framework_post_show.css">
@endpush