@extends('layouts.master')

@section('title','show post page')

@section('content')
    <section style="text-align: right">
        <h1>{{ $post->title }}</h1>
        <h3>{{ $post->body }}</h3>
        <a href="{{ route('posts.edit',$post->id) }}">ویرایش</a>
    </section>
@endsection
