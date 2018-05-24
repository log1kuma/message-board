@extends('layouts.app')

@section('content')

    <h1>id = {{ $message->id }} のメッセージ詳細ページ</h1>
    <h3>タイトル : {{ $message->title }}</h3>
    <p>メッセージ : {{ $message->content }}</p>
    
    {!! link_to_route('messages.edit', 'このメッセージを編集', ['id' => $message->id]) !!}
    
    {!! Form::model($message, ['route' => ['messages.destroy', $message->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除') !!}
    {!! Form::close() !!}

@endsection