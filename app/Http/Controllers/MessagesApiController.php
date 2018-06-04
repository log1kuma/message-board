<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;

class MessagesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();

        // JSONファイルを返す
        return response()->json([
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
        
        // $rules = [
        //     'title' => 'required|max:191',
        //     'content' => 'required|max:191', 
        // ];
        
        // $validation = Validator::make($request,$rules,$messages);
         
        
        $request->validate([
            'title' => 'required|max:191',
            'content' => 'required|max:191',   
        ]);
        
        
        $messages = [
          'required' => ':attribute は必須です。'  
        ];
        

        // dd($request);
        
        
        
        // $requestは$_POST的な感じ
        $message = new Message;
        $message->title = $request->title;
        $message->content = $request->content;
        $message->save();
        
        
        return response()->json([
            'return' => '成功しました',
            'message' => $request->content,
        ]);

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
