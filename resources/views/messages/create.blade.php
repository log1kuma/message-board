@extends('layouts.app')

@section('content')

    <h1>メッセージ新規作成ページ</h1>

       <div class="row">
        <div class="col-xs-6">
            {!! Form::model($message, ['route' => 'messages.store', 'id' => 'sendForm']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'タイトル:', ['class' => 'la']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control form-danger', 'id' => 'title']) !!}
                    <span class="help-block"></span>
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'メッセージ:', ['class' => 'la']) !!}
                    {!! Form::text('content', null, ['class' => 'form-control form-danger', 'id' => 'content']) !!}
                    <span class="help-block"></span>
                    
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary submit']) !!}
                <img id="load_img" src="https://thumbs.gfycat.com/SkinnySeveralAsianlion-size_restricted.gif" width=30 height=30>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('script')
<script>
/*global $*/

    // 成功したらやる処理
    function onFetchComplete(){
        console.log("わーい");
        // フォームの中をクリアする
        $("#title").val('');
        $("#content").val('');
    }

    
    // ready()
    $(function(){
        
        // ロード画像は最初隠しておく
        var img = $('#load_img')
        img.hide();
        
        // sendFormのsubmitボタンが押されたら
        $("#sendForm").submit(function(event){

        event.preventDefault();
        var title = $("#title").val();
        console.log(title);
        var content = $("#content").val();
        console.log(content);

        // ２重送信防止処理
        // 送信ボタンを押せないようにする
        $('.submit').prop('disabled', true);
        var btn = $('.submit');
        
        $.ajax({
            // リクエストメソッド(GET,POST,PUT,DELETEなど)
            type: 'POST',
            // リクエストURL
            url: '/api/messages',
            // タイムアウト(ミリ秒)
            timeout: 10000,
            // キャッシュするかどうか
            cache: true,
            // サーバに送信するデータ(name: value)
            data: {
                'title': title,
                'content': content
            },
            // レスポンスを受け取る際のMIMEタイプ(html,json,jsonp,text,xml,script)
            // レスポンスが適切なContentTypeを返していれば自動判別します。
            dataType: 'json',
            // Ajax通信前処理
            beforeSend: function(jqXHR) {
            // falseを返すと処理を中断
                console.log("beforeSend");
                
                // 3秒後に、ボタンを押せるようにする
                setTimeout(function(){
                    btn.prop('disabled', false);
                }, 3000)

                // 送信ボタンがおされたら、imgをshowする
                img.show();
                
                $('.form-group').removeClass('has-error');
                $('.form-group').children('.help-block').hide();
                return true;
            },
                // コールバックにthisで参照させる要素(DOMなど)
                // context: domobject
              }).done(function(response, textStatus, jqXHR) {
                // 成功時処理
                //レスポンスデータはパースされた上でresponseに渡される
                console.log("done");
                console.log(response.return);
                console.log(response.message);
                onFetchComplete(response.return);
              }).fail(function(jqXHR, textStatus, errorThrown ) {
                // 失敗時処理
                console.log("errorだよ");
                console.log(jqXHR.responseJSON);
                if(jqXHR.status === 422){
                    var errors = jqXHR.responseJSON.errors;
                    
                    for(var key in errors){
                        var error_id = '#' + key;
                        // var span = $('<span>');
                        // error_idの親クラスの.form-groupにhas-errorを追加する
                        $(error_id).parent('.form-group').addClass('has-error');
                        $(error_id).next('.help-block').show();
                        $(error_id).next('.help-block').text(errors[key]);
                    }
                    
                    // 422エラーなら、すぐにボタンを押せるようにする
                    btn.prop('disabled', false);
                    
                }else{
                    // 422以外
                    $('#sendForm').append('<p>失敗しました</p>');
                }
                
              }).always(function(data_or_jqXHR, textStatus, jqXHR_or_errorThrown) {
                console.log('always');
                // 処理が終わったら、imgを隠す
                img.hide();
              });
              
              
        });

});
</script>

@endsection