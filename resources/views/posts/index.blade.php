@extends('layouts.master')

@section('title','index page')

@section('content')

    <section style="text-align: right">
        @foreach($posts as $post)

            <h3><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }} : {{ $post->user->name }}</a></h3>
        {{--accessor--}}
            <img src="{{ $post->image }}" style="width: 80px">
        @endforeach
    </section>

@endsection
