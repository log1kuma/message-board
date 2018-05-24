<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();

        //ここはルート名ではなくファイル名
        return view('messages.index', [
                 'messages' => $messages,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $message = new Message;
        
        return view('messages.create', [
                'message' => $message,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $this->validate($request, [
            'title' => 'required|max:191',
            'content' => 'required|max:191',   
        ]);
        
        /*
        $messages = [
          'required' => ':attribute は必須です。'  
        ];
        
        $this->validate($request, [
            'content' => 'required|max:191',   
        ], $messages);
        */
        
        // $requestは$_POST的な感じ
        $message = new Message;
        $message->title = $request->title;
        $message->content = $request->content;
        $message->save();
        
        //dump($request->method());
        
        //$messages = Message::all();
        
        return redirect('/');
        /*
        return view('messages.index', [
            'messages' => $messages,
        ]);
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        
        return view('messages.show', [
                'message' => $message,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);
        
        return view('messages.edit', [
            'message' => $message,    
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|max:191',
            'content' => 'required|max:191',    
        ]);
        
        // $request->all();で投稿された値が見れる
        $message = Message::find($id);
        $message->title = $request->title;
        $message->content = $request->content;
        $message->save();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        
        return redirect('/');
    }
}
