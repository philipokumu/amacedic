<?php

namespace App\Http\Controllers\Editor;

use App\Message;
use App\Order;
use Illuminate\Http\Request;
use App\Events\MessageWriterEvent;
use App\Events\MessageAdminEvent;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:editor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where(['editor_id'=>auth()->id()])->get('id');
        $messages = Message::wherein('order_id', $orders)->where(function ($query) {
            $query->where('messageSender','editor')
                ->orWhere('recipient', '=', 'editor');
        })->orderBy('created_at','DESC')->get();

        return view('editor.order.messages.index',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $data = Validator::make($request->all(), [
            'orderMessage'=> 'required',
            'recipient'=> 'required',
            ]);

            if ($data->fails()) {
                return back() ->withErrors($data)
                              ->withInput(['tab' => 'messages']);
            }
        
        if ($request->recipient == 'support') {
            $message = Message::create([
                'messageSender' => 'editor',
                'recipient' => $request->recipient,
                'message' => $request->orderMessage,
                'order_id'=>$order->id,
                ]);

            event(new MessageAdminEvent($message));
            return back()->with('success', 'Message sent')->withInput(['tab' => 'messages']);   
        }
        else if ($request->recipient == 'writer') {
            $message = Message::create([
                'messageSender' => 'editor',
                'recipient' => $request->recipient,
                'message' => $request->orderMessage,
                'order_id'=>$order->id,
                'hasWriterRead'=>'no'
                ]);

            event(new MessageWriterEvent($message));
            return back()->with('success', 'Message sent')->withInput(['tab' => 'messages']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Message::where('hasEditorRead','no')->update(['hasEditorRead'=>'yes']);

        return redirect(route('editor.message.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
