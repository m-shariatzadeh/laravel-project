@extends('layouts.master')

@section('title','file download')

@section('content')
    <a href="{{ route('download',['file.jpg']) }}">download</a>
@endsection
