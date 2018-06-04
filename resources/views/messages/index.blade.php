@extends('layouts.app')

@section('content')

    <h1>メッセージ一覧</h1>
    
    @if (count($messages) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タイトル</th>
                    <th>メッセージ</th>
                </tr>
            </thead>
            <tbody id="message-list">
                <!-- 
                @foreach ($messages as $message)
                   <tr>
                        <td>{!! link_to_route('messages.show', $message->id, ['id' => $message->id]) !!}</td>
                        <td>{{ $message->title }}</td>
                        <td>{{ $message->content }}</td>
                    </tr>
                @endforeach-->
            </tbody>
        </table>
    
    @endif
    
     {!! link_to_route('messages.create', '新規メッセージの投稿', null, ['class' => 'btn btn-primary']) !!}


@endsection

@section('script')
<script>
/*global $*/
    
    var onFetchComplete = function (messages) {
        
        // jQueryバージョン
        $.each(messages, function(i, message){

            
            // id,title,contentを１つずつとっていくバージョン
            var row = $("<tr>");
            var table = $("#message-list");
            table.append(row);
            
            var coulmn = $("<td>");
            coulmn.text(message.id);
            // <tr>の下に<td>を追加する
            row.append(coulmn);
            
            var coulmn = $("<td>");
            coulmn.text(message.title);
            row.append(coulmn);
            
            var coulmn = $("<td>");
            coulmn.text(message.content);
            row.append(coulmn);
            
            
            
            // forof使ったバージョン
            // var row = $("<tr>");
            // var table = $("#message-list");
            // table.append(row);
            
            // // 全部のキーを取り出す
            // for(var key of Object.keys(message)){
            //     var coulmn = $("<td>");
            //     coulmn.text(message[key]);
            //     // <tr>の下に<td>を追加する
            //     row.append(coulmn);
            // }
            
            // forinバージョン（一応上手くいくけど非推奨）
            //   for(var key in message){
            //     var coulmn = $("<td>");
            //     coulmn.text(message[key]);
            //     // <tr>の下に<td>を追加する
            //     row.append(coulmn);
            // }
            
        });
        
        
        
        // jsバージョン
            // messages.forEach(function(message){ 
            //     var row = document.createElement('tr');
            //     var table = document.getElementById('message-list')
            //     table.appendChild(row)
                
            //     // 美しくないけど一個ずつ取り出してみた
            //     // idをtd内に追加
            //     var column = document.createElement('td');
            //     column.textContent = message.id;
            //     row.appendChild(column)
            //     var column = document.createElement('td');
            //     column.textContent = message.title;
            //     row.appendChild(column)
            //     var column = document.createElement('td');
            //     column.textContent = message.content;
            //     row.appendChild(column)
                 
                 
            //     // messageのキーを一つずつ取り出す
            //     // これだと、created_atなども表示されてしまう
            //     // Object.keys(message).forEach(function (key){
            //     //     console.log(key);
            //     //     var column = document.createElement('td');
            //     //     column.textContent = message[key];
            //     //     row.appendChild(column)
            //     // });
                
            // });
            
        }


$(function(){
        $.ajax({
            // リクエストメソッド(GET,POST,PUT,DELETEなど)
            type: 'GET',
            // リクエストURL
            url: '/api/messages',
            // タイムアウト(ミリ秒)
            timeout: 10000,
            // キャッシュするかどうか
            cache: true,
            // サーバに送信するデータ(name: value)
            data: {
                'param1': 'ほげ',
                 'foo': 'データ'
            },
            // レスポンスを受け取る際のMIMEタイプ(html,json,jsonp,text,xml,script)
            // レスポンスが適切なContentTypeを返していれば自動判別します。
            dataType: 'json',
            // Ajax通信前処理
            beforeSend: function(jqXHR) {
            // falseを返すと処理を中断
                 return true;
            },
                // コールバックにthisで参照させる要素(DOMなど)
                // context: domobject
              }).done(function(response, textStatus, jqXHR) {
                // 成功時処理
                //レスポンスデータはパースされた上でresponseに渡される
                console.log(response.messages);
                onFetchComplete(response.messages)
              }).fail(function(jqXHR, textStatus, errorThrown ) {
                // 失敗時処理
                console.log(textStatus)
              }).always(function(data_or_jqXHR, textStatus, jqXHR_or_errorThrown) {
                // doneまたはfail実行後の共通処理
                console.log('always')
              });

});
        // Ajax
        // sync = 同期
        // async = 非同期
        // setTimeout, setInterval, XMLHttpRequest

        // // 1. リクエスト送信
        // var xhr = new XMLHttpRequest();
        // // 接続を確立
        // // リクエストの方法など
        // // /apiに情報をクレーーーーって言ってる
        // xhr.open('GET', '/api');
        
        // console.log('11111')
        // var result = xhr.send();
        // console.log('22222')
        
        // xhr.onreadystatechange = function() {
        //     console.log('33333')
        //     // 4は準備が完了した状態。statusがOKだったら
        //     if(xhr.readyState === 4 && xhr.status === 200) {
        //         console.log(JSON.parse(xhr.response));
        //         // 2. DOMを更新
        //         // Jsonをparseして、onFetchCompleteメソッドに受け渡す
        //         onFetchComplete(JSON.parse(xhr.response))
        //     }
        // }
        // console.log('44444')
    
</script>
@endsection