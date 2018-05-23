@extends('layouts.app')

@section('content')

    <h1>id: {{ $message->id }} のメッセージ編集ページ</h1>
    
    {!! Form::model($message, ['route' => ['messages.update', $message->id], 'method' => 'put']) !!}

        {!! Form::label('content', 'メッセージ:') !!}
        {!! Form::text('content') !!}
        
        {!! Form::submit('更新') !!}
        
    {!! Form::close() !!}
        
@endsection