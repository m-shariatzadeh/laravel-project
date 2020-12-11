@extends('layouts.master')

@section('title','post edit page')

@section('content')

    <div class="row mt-5 ml-0 mr-0 text-right">
        <div class="col-8 offset-2" style="direction: rtl !important;">
            @can('update',$post)
                {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'patch']) !!}
                <div class="form-group">
                    {!! Form::label('caption', 'عنوان', ['class' => 'control-label']) !!}
                    {!! Form::text('caption', $post->title, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'توضیحات', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', $post->body, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('بروزرسانی', ['class' => 'btn btn-warning btn-block']) !!}
                </div>
            {!! Form::close() !!}
            {!! Form::model($post, ['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
            	{!! Form::submit('حذف', ['class' => 'btn btn-danger btn-block']) !!}
            {!! Form::close() !!}
            @endcan

        </div>
    </div>
{{--    <form action="{{ route('posts.update',$post->id) }}" method="post">--}}
{{--        @csrf--}}
{{--        @method('patch')--}}
{{--        <input type="text" name="title" placeholder="عنوان" value="{{ $post->title }}">--}}
{{--        <br><br>--}}
{{--        <textarea type="text" name="description" placeholder="توضیحات">{{ $post->body }}</textarea>--}}
{{--        <br>--}}
{{--        <button type="submit" name="btn_submit">update</button>--}}
{{--    </form>--}}

{{--    <form action="{{ route('posts.destroy',$post->id) }}" method="post">--}}
{{--        @csrf--}}
{{--        @method('delete')--}}
{{--        <button type="submit" name="btn_delete">حذف</button>--}}
{{--    </form>--}}
@endsection
