<?php

namespace App\Http\Controllers\Admin;

use App\News;
use Illuminate\Http\Request;
use App\Events\NewsUserEvent;
use App\Events\NewsWriterEvent;
use App\Events\NewsEditorEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
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

        $newsCollection = News::orderBy('created_at','DESC')->get();

        return view('admin.news.index',compact('newsCollection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=> 'required',
            'newsItem'=> 'required',
            'recipient'=> 'required',
            ]);

        News::create($request->merge(['admin_id'=>auth()->id()])->all());
              
        if ($request->recipient == 'clients') {
            event(new NewsUserEvent($data));
        }
        else if ($request->recipient == 'writers') {
            event(new NewsWriterEvent($data));
        }
        else if ($request->recipient == 'editors') {
            event(new NewsEditorEvent($data));
        }
        else if ($request->recipient == 'all') {
            event(new NewsEditorEvent($data));
            event(new NewsWriterEvent($data));
            event(new NewsUserEvent($data));
        }
        return back()->with('success', 'News sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
