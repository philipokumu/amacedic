<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use App\Order;
use Illuminate\Http\Request;
use App\Events\MessageUserEvent;
use App\Events\MessageWriterEvent;
use App\Events\MessageEditorEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $messages = Message::orderBy('created_at','DESC')->get();

        return view('admin.order.messages.index',compact('messages'));
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

        if ($request->recipient == 'client') {
            $message = Message::create([
                'messageSender' => 'support',
                'recipient' => $request->recipient,
                'message' => $request->orderMessage,
                'hasAdminRead' => 'yes',
                'hasClientRead' => 'no',
                'order_id'=>$order->id
                ]);

            event(new MessageUserEvent($message));
            return back()->with('success', 'Message sent')->withInput(['tab' => 'messages']);
        }
        else if ($request->recipient == 'writer') {
            $message = Message::create([
                'messageSender' => 'support',
                'recipient' => $request->recipient,
                'message' => $request->orderMessage,
                'hasAdminRead' => 'yes',
                'hasWriterRead' => 'no',
                'order_id'=>$order->id
                ]);

            event(new MessageWriterEvent($message));
            return back()->with('success', 'Message sent')->withInput(['tab' => 'messages']);
        }
        else if ($request->recipient == 'editor') {
            $message = Message::create([
                'messageSender' => 'support',
                'recipient' => $request->recipient,
                'message' => $request->orderMessage,
                'hasAdminRead' => 'yes',
                'hasEditorRead' => 'no',
                'order_id'=>$order->id
                ]);
                
            event(new MessageEditorEvent($message));
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
        Message::where('hasAdminRead','no')->update(['hasAdminRead'=>'yes']);

        return redirect(route('admin.message.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return back()->with('success','message deleted');
    }
}
