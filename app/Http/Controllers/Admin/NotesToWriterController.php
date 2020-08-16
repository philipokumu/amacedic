<?php

namespace App\Http\Controllers\Admin;

use App\EditorToWriterNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NotesToWriterController extends Controller
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
        $editorNotes = EditorToWriterNote::orderBy('created_at','DESC')->get();

        return view('admin.notestowriters.index',compact('editorNotes'));
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
    public function store(Request $request, EditorToWriterNote $editorToWriterNote)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EditorToWriterNote  $editorToWriterNote
     * @return \Illuminate\Http\Response
     */
    public function show(EditorToWriterNote $editorToWriterNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EditorToWriterNote  $editorToWriterNote
     * @return \Illuminate\Http\Response
     */
    public function edit(EditorToWriterNote $editorToWriterNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EditorToWriterNote  $editorToWriterNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        EditorToWriterNote::where(['hasAdminRead'=>'no'])->update(['hasAdminRead'=>'yes']);

        
        return redirect(route('admin.notes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EditorToWriterNote  $editorToWriterNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(EditorToWriterNote $note)
    {
        $note->delete();

        return back()->with('success','editor note deleted');
    }
}
