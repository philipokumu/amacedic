<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Editor;
use App\SubjectArea;
use App\Http\Requests\EditorRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the Editors
     *
     * @param  \App\Editor  $model
     * @return \Illuminate\View\View
     */
    public function index(Editor $model)
    {
        $owner = 'editor';
        return view('admin.profile.editor.index', ['profiles' => $model->paginate(15)], compact('owner'));
    }

    /**
     * Show the form for creating a new Editor
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.profile.editor.create');
    }

    /**
     * Store a newly created Editor in storage
     *
     * @param  \App\Http\Requests\EditorRequest  $request
     * @param  \App\Editor  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Editor $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('admin.editor.index')->with('success','Editor successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Editor  $editor
     * @return \Illuminate\Http\Response
     */
    public function show(Editor $editor)
    {
        $profile = $editor;

        $owner = 'editor';

        $subjects = SubjectArea::where(['account_id'=>$profile->id,'accountType'=>'editor'])->pluck('subjectArea');

        return view('admin.profile.editor.show', compact('owner','subjects','profile'));
    }

    /**
     * Show the form for editing the specified Editor
     *
     * @param  \App\Editor  $editor
     * @return \Illuminate\View\View
     */
    public function edit(Editor $editor)
    {
        $subjects = SubjectArea::where(['account_id'=>$editor->id,'accountType'=>'editor'])->pluck('subjectArea');

        $profile = $editor;

        $owner = 'editor';

        return view('admin.profile.editor.edit', compact('subjects','profile','owner'));
    }

    /**
     * Update the specified Editor in storage
     *
     * @param  \App\Http\Requests\EditorRequest  $request
     * @param  \App\Editor  $editor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditorRequest $request, Editor $editor)
    {
        if ($request->has('profilePhoto')) {

            $file = $request->profilePhoto;
    
            $fileExtension = $file->getClientOriginalExtension();
    
            $fileOldName = $editor->profilePhoto;
            $fileNewName = 'editor'.$editor->id.".".$fileExtension;
    
            if ($fileOldName!=NULL) {
    
                unlink(public_path("storage\\profilephotos")."\\".$fileOldName);
    
            }
    
                $file->storeAs('profilephotos', $fileNewName,'public');
    
                $editor->update([
                    'profilePhoto'=>$fileNewName,
                    'name'=>$request->name,
                    'status'=>$request->status,
                    'nickname'=>$request->nickname,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'phone'=>$request->phone,
        
                ]);
        }
        else {
            $editor->update([
                'name'=>$request->name,
                'status'=>$request->status,
                'nickname'=>$request->nickname,
                'email'=>$request->email,
                'country'=>$request->country,
                'phone'=>$request->phone,
            ]);
        }

        return redirect()->back()->with('success','Your infomation is successfully updated.');
    }

    /**
     * Remove the specified Editor from storage
     *
     * @param  \App\Editor  $editor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Editor  $editor)
    {
        $editor->delete();

        return redirect()->route('admin.editor.index')->with('success','Editor successfully deleted.');
    }

    public function password(PasswordRequest $request, Editor $editor)
    {
        $editor->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('success','Password successfully updated.');
    }

    public function education(Request $request, Editor $editor)
    {
        $education = Validator::make($request->all(), [
            'educationLevel'=>'required',
            'bio'=>'required|min:3',
            'subjectArea'=>'required',
        ]);

        if ($education->fails()) {
            return back() ->withErrors($education)
                          ->withInput(['tab' => 'education']);
        }

        $editor->update($request->all());

        $subjectAreas = $request->subjectArea;

        SubjectArea::where(['account_id'=>auth()->id(),'accountType'=>'Editor'])->delete();

        foreach ($subjectAreas as $subject) {
            SubjectArea::create([
                'account_id'=>$editor->id,
                'accountType'=>'Editor',
                'subjectArea'=>$subject,
            ]);
        }

        return redirect()->back()->with('success','Education successfully updated.')
                                ->withInput(['tab' => 'education']);
    }

    public function payment(Request $request, Editor $editor)
    {
        $paymentDetails = Validator::make($request->all(), [
            'accountType'=>'required',
            'bankName'=>'bail|required_if:accountType,bank',
            'accountName'=>'required|min:3',
            'accountNumber'=>'required|min:10',
        ]);

        if ($paymentDetails->fails()) {
            return back() ->withErrors($paymentDetails)
                          ->withInput(['tab' => 'payment']);
        }

        if ($request->accountType=='bank') {
            $editor->update([
                'accountType'=>$request->accountType,
                'bankName'=>$request->bankName,
                'accountName'=>$request->accountName,
                'accountNumber'=>$request->accountNumber, 
            ]);
        }
        else {
            $editor->update([
                'accountType'=>$request->accountType,
                'accountName'=>$request->accountName,
                'accountNumber'=>$request->accountNumber, 
            ]);
        }

        
        return redirect()->back()->with('success','Payment details successfully updated.')
                                ->withInput(['tab' => 'payment']);
    }
}
