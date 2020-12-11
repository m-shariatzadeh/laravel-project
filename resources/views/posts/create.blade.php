@extends('layouts.master')

@section('title','post create page')

@section('content')

    @section('css')
        <style>
            ul{
                list-style: none;
            }
        </style>
    @endsection

    <div class="row mt-5 ml-0 mr-0 text-right">
        <div class="col-8 offset-2" style="direction: rtl !important;">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['route' => 'posts.store', 'method' => 'post', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('caption', 'عنوان', ['class' => 'control-label']) !!}
                    {!! Form::text('caption', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'توضیحات', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group mb-4">
                    {!! Form::label('image', 'عکس', ['class' => 'control-label']) !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('ثبت', ['class' => 'btn btn-success btn-block']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

{{--    <form action="/posts" method="post">--}}
{{--        @csrf--}}
{{--        <input type="text" name="title" placeholder="عنوان">--}}
{{--        <br><br>--}}
{{--        <input type="text" name="description" placeholder="توضیحات">--}}
{{--        <br>--}}
{{--        <button type="submit" name="btn_submit">send</button>--}}
{{--    </form>--}}
@endsection
